<?php
/**
 * Template Name: Flexible Landing Page
 * Description: Flexible Content Builder
 */

get_header();

/* -----------------------------------------------------------
 * Utility – always return a media *array* (url, mime_type, ID)
 * ----------------------------------------------------------- */
if ( ! function_exists( 'chi_media_array' ) ) {
	function chi_media_array( $field ) {
		if ( ! $field ) return false;

		// Already an array from ACF
		if ( is_array( $field ) && isset( $field['url'] ) ) {
			return $field;
		}

		// Attachment ID
		if ( is_numeric( $field ) ) {
			$id = (int) $field;
			return [
				'url'       => wp_get_attachment_url( $id ),
				'mime_type' => get_post_mime_type( $id ),
				'ID'        => $id,
			];
		}

		// Raw URL string
		if ( is_string( $field ) && filter_var( $field, FILTER_VALIDATE_URL ) ) {
			return [
				'url'       => esc_url_raw( $field ),
				'mime_type' => wp_check_filetype( $field )['type'] ?? '',
				'ID'        => 0,
			];
		}
		return false;
	}
}

if ( have_rows( 'page_sections' ) ) :
	while ( have_rows( 'page_sections' ) ) : the_row();

        /* =======================================================
        *  LAYOUT 1 – HERO / BILLBOARD
        * =====================================================*/
        if ( get_row_layout() === 'hero_billboard' ) :

            /* ---- pull grouped Background Controls ---- */
            $bg         = get_sub_field( 'background_controls' ) ?: [];
            $bg_video = chi_media_array( $bg['bg_video'] ?? '' );   // ← add this line
            
            $bg_type    = $bg['bg_type']            ?? '';
            $solid      = $bg['bg_solid_color']     ?? '';
            $g_start    = $bg['bg_grad_start']      ?? '';
            $g_end      = $bg['bg_grad_end']        ?? '';
            $bg_img     = chi_media_array( $bg['bg_image']  ?? '' );
            $bg_pos     = $bg['bg_image_position']  ?? '';
            $bg_video   = chi_media_array( $bg['bg_video']  ?? '' );
            $overlay    = $bg['overlay_color']      ?? '';
            $opacity    = ( $bg['overlay_opacity']  ?? 0 ) / 100;
            $text_color = $bg['text_color']         ?? '';
            

            /* ---- content fields ---- */
            $heading = get_sub_field( 'heading' );
            $sub     = get_sub_field( 'subheading' );
            $cta     = get_sub_field( 'cta_link' );
            $badge   = get_sub_field( 'badge' );

            /* ---- build inline style / classes ---- */
            $style = '';
            $class = 'hero-billboard';

            if ( $text_color ) $style .= "--text-color:$text_color;";
            if ( $overlay   ) $style .= "--overlay-color:$overlay;--overlay-opacity:$opacity;";

            switch ( $bg_type ) {
                case 'solid':
                    if ( $solid ) $style .= "background-color:$solid;";
                break;

                case 'gradient':
                    if ( $g_start && $g_end )
                        $style .= "background-image:linear-gradient(135deg,$g_start 0%,$g_end 100%);";
                break;

                case 'image':
                    if ( $bg_img ) {
                        $style .= "background-image:url('{$bg_img['url']}');background-position:" .
                                ( $bg_pos ?: 'center center' ) . ';';
                        $class .= ' bg-cover';
                    }
                break;

                case 'video':
                    if ( $bg_video ) $class .= ' has-video-bg';
                break;
            }
            ?>
            <section class="<?php echo esc_attr( $class ); ?>"
                    style="<?php echo esc_attr( $style ); ?>">

                <?php if ( $bg_type === 'video' && $bg_video ) : ?>
                    <video class="hero-billboard__video"
                        autoplay muted loop playsinline preload="auto">
                        <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
                                type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
                    </video>
                <?php endif; ?>

                <?php if ( $overlay ) : ?>
                    <span class="hero-billboard__overlay" aria-hidden="true"></span>
                <?php endif; ?>

                <div class="hero-billboard__inner">
                    <?php if ( $badge ) : ?>
                        <span class="hero-billboard__badge"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>

                    <?php if ( $heading ) : ?>
                        <h1><?php echo esc_html( $heading ); ?></h1>
                    <?php endif; ?>

                    <?php if ( $sub ) : ?>
                        <p class="lead"><?php echo esc_html( $sub ); ?></p>
                    <?php endif; ?>

                    <?php if ( $cta ) :
                        echo '<a target="_blank" class="btn infinity-btn" href="' . esc_url( $cta['url'] ) . '">' .
                            esc_html( $cta['title'] ) .
                            '</a>';
                    endif; ?>
                </div>
            </section>
            <?php
        /* =======================================================
        *  LAYOUT 2 – 50/50  IMAGE LEFT / TEXT RIGHT
        * =====================================================*/
        elseif ( get_row_layout() === 'image_left_text_right' ) :

            $bg         = get_sub_field( 'background_controls' ) ?: [];
            $bg_video = chi_media_array( $bg['bg_video'] ?? '' );   // ← add this line

            $bg_type    = $bg['bg_type']            ?? '';
            $solid      = $bg['bg_solid_color']     ?? '';
            $g_start    = $bg['bg_grad_start']      ?? '';
            $g_end      = $bg['bg_grad_end']        ?? '';
            $bg_img     = chi_media_array( $bg['bg_image']  ?? '' );
            $bg_pos     = $bg['bg_image_position']  ?? '';
            $overlay    = $bg['overlay_color']      ?? '';
            $opacity    = ( $bg['overlay_opacity']  ?? 0 ) / 100;
            $text_color = $bg['text_color']         ?? '';

            $image   = chi_media_array( get_sub_field( 'left_image' ) );
            $img_pos = get_sub_field( 'left_img_pos' ) ?: 'center center';
            $heading = get_sub_field( 'heading' );
            $copy    = get_sub_field( 'content' );
            $cta     = get_sub_field( 'cta_link' );
            $valign  = get_sub_field( 'vert_align' ) ?: 'center';

            /* ---- style / classes ---- */
            $style  = '';
            $class  = 'feature-split feature-split--image-left valign-' . esc_attr( $valign );

            if ( $text_color ) $style .= "--text-color:$text_color;";
            if ( $overlay   ) $style .= "--overlay-color:$overlay;--overlay-opacity:$opacity;";

            switch ( $bg_type ) {
            case 'solid':
                if ( $solid ) $style .= "background-color:$solid;";
            break;

            case 'gradient':
                if ( $g_start && $g_end )
                $style .= "background-image:linear-gradient(135deg,$g_start,$g_end);";
            break;

            case 'image':
                if ( $bg_img ) {
                $style .= "background-image:url('{$bg_img['url']}');background-position:$bg_pos;";
                $class .= ' bg-cover';
                }
            break;

            case 'video':
                if ( $bg_video ) $class .= ' has-video-bg';
            break;
            }
            ?>

            <div class="container-fw <?php echo esc_attr( $class ); ?>"
                style="<?php echo esc_attr( $style ); ?>">

            <?php if ( $bg_type === 'video' && $bg_video ) : ?>
                <video class="feature-split__video" autoplay muted loop playsinline preload="auto">
                <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
                        type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
                </video>
            <?php endif; ?>

            <?php if ( $overlay ) : ?>
                <span class="feature-split__overlay" aria-hidden="true"></span>
            <?php endif; ?>

            <div class="container p60">
                <section class="row <?php echo 'valign-' . esc_attr( $valign ); ?>">
                <div class="col-sm-12 col-md-6 feature-split__media">
                    <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>"
                        alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
                        style="object-position:<?php echo esc_attr( $img_pos ); ?>;">
                    <?php endif; ?>
                </div>

                <div class="col-sm-12 col-md-6 feature-split__content">
                    <?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
                    <?php if ( $copy )    : echo wp_kses_post( $copy ); endif; ?>
                    <?php if ( $cta ) :
                    echo '<a class="btn infinity-btn" href="' . esc_url( $cta['url'] ) . '">' .
                        esc_html( $cta['title'] ) . '</a>';
                    endif; ?>
                </div>
                </section>
            </div>
            </div>

            <?php
        endif; // end layout checks

        /* =======================================================
        *  LAYOUT 3 – 50/50  TEXT LEFT / IMAGE RIGHT
        * =====================================================*/
        if ( get_row_layout() === 'text_left_image_right' ) :

            $bg         = get_sub_field( 'background_controls' ) ?: [];

            $bg_type    = $bg['bg_type']            ?? '';
            $solid      = $bg['bg_solid_color']     ?? '';
            $g_start    = $bg['bg_grad_start']      ?? '';
            $g_end      = $bg['bg_grad_end']        ?? '';
            $bg_img     = chi_media_array( $bg['bg_image']  ?? '' );
            $bg_pos     = $bg['bg_image_position']  ?? '';
            $bg_video   = chi_media_array( $bg['bg_video'] ?? '' );
            $overlay    = $bg['overlay_color'] ?? '';
            $opacity    = ( $bg['overlay_opacity'] ?? 0 ) / 100;
            $text_color = $bg['text_color']         ?? '';

            $image   = chi_media_array( get_sub_field( 'right_image' ) );
            $img_pos = get_sub_field( 'right_img_pos' ) ?: 'center center';
            $heading = get_sub_field( 'heading' );
            $copy    = get_sub_field( 'content' );
            $cta     = get_sub_field( 'cta_link' );
            $valign  = get_sub_field( 'vert_align' ) ?: 'center';

            /* ---- style / classes ---- */
            $style  = '';
            $class  = 'feature-split feature-split--image-right valign-' . esc_attr( $valign );

            if ( $text_color ) $style .= "--text-color:$text_color;";
            if ( $overlay   ) $style .= "--overlay-color:$overlay;--overlay-opacity:$opacity;";

            switch ( $bg_type ) {
                case 'solid':
                    if ( $solid ) $style .= "background-color:$solid;";
                break;

                case 'gradient':
                    if ( $g_start && $g_end )
                        $style .= "background-image:linear-gradient(135deg,$g_start,$g_end);";
                break;

                case 'image':
                    if ( $bg_img ) {
                        $style .= "background-image:url('{$bg_img['url']}');background-position:$bg_pos;";
                        $class .= ' bg-cover';
                    }
                break;
                
                case 'video':
                    if ( $bg_video ) $class .= ' has-video-bg';
                break;
            }
            ?>

            <div class="container-fw <?php echo esc_attr( $class ); ?>"
                style="<?php echo esc_attr( $style ); ?>">
                <?php if ( $bg_type === 'video' && $bg_video ) : ?>
                <video class="feature-split__video" autoplay muted loop playsinline preload="auto">
                    <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
                            type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
                </video>
                <?php endif; ?>

                <?php if ( $overlay ) : ?>
                    <span class="feature-split__overlay" aria-hidden="true"></span>
                <?php endif; ?>

                <div class="container p60">

                    <section class="row <?php echo 'valign-' . esc_attr( $valign ); ?>">

                        <div class="col-sm-12 col-md-6 feature-split__content">
                            <?php if ( $heading ) : ?>
                                <h2><?php echo esc_html( $heading ); ?></h2>
                            <?php endif; ?>

                            <?php if ( $copy ) : ?>
                                <?php echo wp_kses_post( $copy ); ?>
                            <?php endif; ?>

                            <?php if ( $cta ) :
                                echo '<a class="btn infinity-btn" href="' . esc_url( $cta['url'] ) . '">' .
                                    esc_html( $cta['title'] ) .
                                    '</a>';
                            endif; ?>
                        </div>

                        <div class="col-sm-12 col-md-6 feature-split__media">
                            <?php if ( $image ) : ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>"
                                    alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
                                    style="object-position:<?php echo esc_attr( $img_pos ); ?>;">
                            <?php endif; ?>
                        </div>
                    </section>
                </div><!-- /.container -->
            </div><!-- /.container-fw -->

            <?php
        endif; // end layout checks

        /* =======================================================
        *  LAYOUT 4 – 50/50  TEXT-LEFT / TEXT-RIGHT
        * =====================================================*/
        if ( get_row_layout() === 'wysiwyg_left_wysiwyg_right' ) :

            /* pull Background Controls */
            $bg         = get_sub_field( 'background_controls' ) ?: [];

            $bg_type    = $bg['bg_type']            ?? '';
            $solid      = $bg['bg_solid_color']     ?? '';
            $g_start    = $bg['bg_grad_start']      ?? '';
            $g_end      = $bg['bg_grad_end']        ?? '';
            $bg_img     = chi_media_array( $bg['bg_image']  ?? '' );
            $bg_pos     = $bg['bg_image_position']  ?? '';
            $bg_video   = chi_media_array( $bg['bg_video'] ?? '' );
            $overlay    = $bg['overlay_color']      ?? '';
            $opacity    = ( $bg['overlay_opacity']  ?? 0 ) / 100;
            $text_color = $bg['text_color']         ?? '';

            /* copy fields */
            $left   = get_sub_field( 'copy_left' );
            $right  = get_sub_field( 'copy_right' );
            $valign = get_sub_field( 'vert_align' ) ?: 'center';

            /* ---- style / classes ---- */
            $style = '';
            $class = 'feature-split feature-split--wysiwyg valign-' . esc_attr( $valign );

            if ( $text_color ) $style .= "--text-color:$text_color;";
            if ( $overlay   ) $style .= "--overlay-color:$overlay;--overlay-opacity:$opacity;";

            switch ( $bg_type ) {
                case 'solid':
                    if ( $solid ) $style .= "background-color:$solid;";
                break;

                case 'gradient':
                    if ( $g_start && $g_end )
                        $style .= "background-image:linear-gradient(135deg,$g_start,$g_end);";
                break;

                case 'image':
                    if ( $bg_img ) {
                        $style .= "background-image:url('{$bg_img['url']}');background-position:$bg_pos;";
                        $class .= ' bg-cover';
                    }
                break;

                case 'video':
                    if ( $bg_video ) $class .= ' has-video-bg';
                break;
            }
            ?>
            <div class="container-fw <?php echo esc_attr( $class ); ?>"
                style="<?php echo esc_attr( $style ); ?>">

                <?php if ( $bg_type === 'video' && $bg_video ) : ?>
                    <video class="feature-split__video" autoplay muted loop playsinline preload="auto">
                        <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
                                type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
                    </video>
                <?php endif; ?>

                <?php if ( $overlay ) : ?>
                    <span class="feature-split__overlay" aria-hidden="true"></span>
                <?php endif; ?>

                <div class="container p60">
                    <section class="row <?php echo 'valign-' . esc_attr( $valign ); ?>">
                        <div class="col-sm-12 col-md-6 feature-split__content">
                            <?php echo wp_kses_post( $left ); ?>
                        </div>
                        <div class="col-sm-12 col-md-6 feature-split__content">
                            <?php echo wp_kses_post( $right ); ?>
                        </div>
                    </section>
                </div>
            </div>
        <?php endif; /* end Layout 4 */

	endwhile;
endif;

get_footer();
