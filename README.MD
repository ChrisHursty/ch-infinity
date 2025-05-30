CH Infinity
===============

CH Infinity is a versatile, multi-industry WordPress theme designed by Chris Hurst, optimized for both portfolio and business websites. This theme supports modern web development practices with live reload features, customizable content areas, and responsive design.

Prerequisites
-------------

-   WordPress environment (LocalWP, XAMPP, MAMP, etc.)
-   Node.js and npm installed

Installation
------------

1.  **Clone the Repository**:\
    Clone this repository into your WordPress themes directory.

    bash

    Copy code

    `git clone https://github.com/ChrisHursty/ch-infinity`

2.  **Navigate to the Theme Directory**:\
    Change to the theme directory.

3.  **Install Node Modules**:\
    Install the required Node modules.

    bash

    Copy code

    `npm install`

4.  **Install SASS (If needed)**:\
    If you encounter issues, you may need to install SASS.

    bash

    Copy code

    `npm install sass`

5.  **Configure Local for Live Reload**:\
    Open the `gulpfile.mjs` and update the `proxy` value:

    bash

    Copy code

    `browserSyncInstance.init({
        proxy: "your_local_site.local/"
    });`

6.  **Running the Development Environment (`gulp serve`)**:\
    Start the development environment with live reloading.

    bash

    Copy code

    `npx gulp`

    This will initiate a local development server with BrowserSync, watching for changes to your SCSS, JS, and PHP files and automatically reloading the browser.

7.  **Building for Production (`gulp build`)**:\
    To prepare your theme for production:

    bash

    Copy code

    `gulp build`

    This command compiles SASS, minifies CSS and JS files, optimizes images, and packages your theme into a zip file. Be sure to run this before deploying the theme.

Structure
---------

-   `/scss`: SCSS files for styling.
-   `/css`: Compiled CSS files.
-   `/js`: JavaScript files.
-   `functions.php`: WordPress theme functions.
-   `index.php`: Main template file.
-   `templates/`: Template parts and layout files.

Contributing
------------

Contributions to CH Infinity are welcome! Please follow the existing code structure and adhere to the development guidelines.

1.  Fork the repository.
2.  Create a new branch for your feature (`git checkout -b feature/AmazingFeature`).
3.  Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4.  Push to the branch (`git push origin feature/AmazingFeature`).
5.  Open a Pull Request.

License
-------

Distributed under the GNU General Public License v2.0 or later. See `LICENSE` for more information.

Dependencies
------------

-   <a href="https://www.advancedcustomfields.com/pro/" target="_blank" rel="nofollow">Advanced Custom Fields Pro</a>
-   <a href="https://ninjaforms.com/" target="_blank" rel="nofollow">Ninja Forms</a>

Credits
-------

-   <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank" rel="nofollow">Font Awesome</a> integration (v5.15.4)
-   <a href="https://owlcarousel2.github.io/OwlCarousel2/" target="_blank" rel="nofollow">Owl Carousel 2</a>
-   <a href="https://dimsemenov.com/plugins/magnific-popup/" target="_blank" rel="nofollow">Magnific Popup</a>
