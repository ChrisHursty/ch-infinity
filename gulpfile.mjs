// gulpfile.mjs
import gulp from 'gulp';
import sassModule from 'gulp-sass';
import * as sassCompiler from 'sass';
import browserSync from 'browser-sync';
import autoprefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import changed from 'gulp-changed';
import uglify from 'gulp-uglify';
import imagemin from 'gulp-imagemin';
import zip from 'gulp-zip';
import fs from 'fs'; // Node.js module to check/create folders

const { src, dest, watch, series, parallel } = gulp;
const sass = sassModule(sassCompiler);
const browserSyncInstance = browserSync.create();

// Paths configuration
const paths = {
    scss: 'scss/**/*.scss',
    cssDest: 'dist/css',
    js: 'js/**/*.js',
    jsDest: 'dist/js',
    images: 'images/**/*',
    imagesDest: 'dist/images',
    php: '*.php',
};

// Ensure dist folder exists
function ensureDistFolder() {
    if (!fs.existsSync('dist')) {
        fs.mkdirSync('dist');
        console.log('Created /dist folder');
    }
    if (!fs.existsSync('dist/css')) {
        fs.mkdirSync('dist/css');
        console.log('Created /dist/css folder');
    }
    if (!fs.existsSync('dist/js')) {
        fs.mkdirSync('dist/js');
        console.log('Created /dist/js folder');
    }
    if (!fs.existsSync('dist/images')) {
        fs.mkdirSync('dist/images');
        console.log('Created /dist/images folder');
    }
}

// Compile SCSS to CSS, autoprefix, and minify
function compileSass() {
    ensureDistFolder(); // Ensure /dist exists
    console.log('Compiling SCSS...');
    return src(paths.scss)
        .pipe(changed(paths.cssDest))
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({ overrideBrowserslist: ['last 2 versions'] }))
        .pipe(dest(paths.cssDest)) // Non-minified version
        .pipe(cleanCSS({ compatibility: 'ie8' })) // Minify CSS
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest(paths.cssDest)) // Minified version
        .pipe(browserSyncInstance.stream());
}

// Minify JavaScript files
function minifyJs() {
    ensureDistFolder(); // Ensure /dist exists
    console.log('Minifying JS...');
    return src(paths.js)
        .pipe(uglify())
        .on('error', (err) => {
            console.error('JS Minification Error:', err.toString());
            this.emit('end');
        })
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest(paths.jsDest))
        .pipe(browserSyncInstance.stream());
}

// Optimize images
function optimizeImages() {
    ensureDistFolder(); // Ensure /dist exists
    console.log('Optimizing Images...');
    return src(paths.images)
        .pipe(imagemin())
        .pipe(dest(paths.imagesDest));
}

// Zip the project excluding unnecessary files
function zipProject() {
    console.log('Zipping project...');
    return src([
        '**/*',
        '!node_modules/**/*',   // Exclude node_modules
        '!*.zip',               // Exclude previous zips
        'dist/**/*',            // Explicitly include dist folder and its contents
    ], { base: '.' })           // Ensure the correct folder structure is preserved
    .pipe(zip('custom-wp-theme.zip'))
    .pipe(dest('../'));
}

// Serve and watch for file changes
function serve() {
    browserSyncInstance.init({
        proxy: "http://chi.local/", // Update this to match your local development URL
    });

    // Watch SCSS, JS, PHP for changes
    watch(paths.scss, compileSass);
    watch(paths.js, minifyJs);
    watch(paths.php).on('change', browserSyncInstance.reload);
}

// Production build sequence
function buildProd(done) {
    return series(
        parallel(compileSass, minifyJs, optimizeImages), // Run these tasks in parallel
        zipProject // Then zip the project after the previous tasks complete
    )(done);
}

// Task Exports
export default serve;
export const sassTask = compileSass;
export const jsTask = minifyJs;
export const imgTask = optimizeImages;
export const zipTask = zipProject;
export const build = buildProd;
