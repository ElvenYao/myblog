<?php
/**
 * Canuck Home Page template part - layout option 4
 *
 * This template part is called by template-home.php
 *
 * @package     Canuck WordPress Theme
 * @copyright   Copyright (C) 2017  Kevin Archibald
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Kevin Archibald <www.kevinsspace.ca/contact/>
 */

// Get the options.
$section11_usage = stripslashes( get_theme_mod( 'canuck_section11_media_area_usage', 'image' ) );
$section11_image = get_theme_mod( 'canuck_section11_image', '' );
$section11_title = stripslashes( get_theme_mod( 'canuck_section11_title', '' ) );
$section11_shortcode = stripslashes( get_theme_mod( 'canuck_section11_shortcode', '' ) );
$section11_text = stripslashes( get_theme_mod( 'canuck_section11_text', '' ) );
$section11_include_link = get_theme_mod( 'canuck_section11_include_link', false );
$section11_button_link = get_theme_mod( 'canuck_section11_button_link', '#' );
$section11_button_label = get_theme_mod( 'canuck_section11_button_title', "<i class='fa fa-link'></i> " . __( 'more', 'canuck' ) );
$sec11_bg_image = get_theme_mod( 'canuck_section11_background_image', '' );
$sec11_use_parallax = get_theme_mod( 'canuck_section11_use_parallax', false );

if ( '' !== $sec11_bg_image && false !== $sec11_use_parallax ) { ?>
	<div class="home-11-wide parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $sec11_bg_image ); ?>">
<?php } else { ?>
	<div class="home-11-wide">
<?php } ?>
	<div class="home-11-wide-overlay">
		<div class="home-11-wrap">
			<div class="home-11-media">
				<?php
				if ( 'shortcode' === $section11_usage ) {
					?>
					<div class="home-11-shortcode">
						<?php
							echo do_shortcode( wp_kses_post( $section11_shortcode ) );
						?>
					</div>
					<?php
				} elseif ( 'widgetized' === $section11_usage ) {
					?>
					<div class="home-11-widget">
						<?php
						if ( ! dynamic_sidebar( 'canuck_home_section11_sidebar' ) ) {
							echo esc_html__( 'Section 11 media area is set up as a widget area.', 'canuck' ) .
								'<br/><span class="alert">' .
								esc_html__( 'Go to Appearance->Widgets or the Customizer Widgets panel and add a widget to Home Page Section 10.', 'canuck' ) .
								'</span>';
						}
						?>
					</div>
					<?php
				} else {
					?>
					<div class="home-11-image">
						<img src="<?php echo esc_url( $section11_image ); ?>" alt="<?php echo esc_attr( $section11_title ); ?>" /> 
					</div>
					<?php
				}
				?>
			</div>
			<div class="home-11-content">
				<div class="home-11-title">
					<h2><?php echo esc_html( $section11_title ); ?></h2>
				</div>
				<div class="home-11-text">
					<p><?php echo wp_kses_post( $section11_text ); ?></p>
				</div>
				<?php
				if ( true === $section11_include_link ) {
					if ( '' === $section11_button_label ) {
						$section11_button_label = "<i class='fa fa-link'></i> " . __( 'more', 'canuck' );
					}
					?>
					<div class="home-11-button">
						<a class="button1" href="<?php echo esc_url( $section11_button_link ); ?>" title="<?php esc_attr_e( 'more', 'canuck' ); ?>">
							<?php echo wp_kses_post( $section11_button_label ); ?>
						</a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
