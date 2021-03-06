<?php
/**
 * Template Part, image feature for image post format
 *
 * @package     Canuck WordPress Theme
 * @copyright   Copyright (C) 2016  kevinhaig
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      kevinhaig <www.kevinsspace.ca/contact/>
 */

global $post;
$post_style              = esc_html( get_theme_mod( 'canuck_blog_style', 'top_feature' ) );
$link_to_post            = ( '' === get_post_meta( $post->ID, 'canuck_metabox_link_to_post', true ) ? false : true );
$custom_feature_link     = ( '' === get_post_meta( $post->ID, 'canuck_custom_feature_link', true ) ? false : get_post_meta( $post->ID, 'canuck_custom_feature_link', true ) );
$image_url               = get_the_post_thumbnail_url( $post->ID, 'canuck_med15' );
$include_pinterest_pinit = get_theme_mod( 'canuck_include_pinit' ) ? true : false;
$use_lazyload            = get_theme_mod( 'canuck_use_lazyload' ) ? true : false;
if ( has_post_thumbnail() ) {
	?>
	<div class="image-post-feature">
		<?php
		if ( false !== $custom_feature_link ) {
			?>
			<a href="<?php echo esc_url( $custom_feature_link ); ?>" title="<?php esc_attr_e( 'custom link', 'canuck' ); ?>">
				<?php
				if ( true === $use_lazyload ) {
					?>
					<img class="lazyload"
					src="<?php echo get_template_directory_uri() . '/images/placeholder15.png';// WPCS: XSS ok. ?>"
					data-src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo the_title_attribute(); ?>"/>
					<?php
				} else {
					?>
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo the_title_attribute(); ?>"/>
					<?php
				}
				?>
			</a>
			<?php
		} elseif ( true === $link_to_post ) {
			?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php
				if ( true === $use_lazyload ) {
					?>
					<img class="lazyload"
						src="<?php echo get_template_directory_uri() . '/images/placeholder15.png';// WPCS: XSS ok. ?>"
						data-src="<?php echo esc_url( $image_url ); ?>"
						alt="<?php the_title_attribute(); ?>"/>
					<?php
				} else {
					?>
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>"/>
					<?php
				}
				?>
			</a>
			<?php
		} else {
			if ( true === $use_lazyload ) {
				?>
				<img class="lazyload"
					src="<?php echo get_template_directory_uri() . '/images/placeholder15.png';// WPCS: XSS ok. ?>"
					data-src="<?php echo esc_url( $image_url ); ?>"
					alt="<?php echo the_title_attribute(); ?>"/>
				<?php
			} else {
				?>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo the_title_attribute(); ?>"/>
				<?php
			}
		}
		?>
	</div>
	<?php
} else {
	$integer       = rand( 1, 5 );
	?>
	<div class="image-post-feature">
		<?php
		$image_url = get_template_directory_uri() . '/images/standard' . $integer . '.jpg';
		$add_nopin = ( true === $include_pinterest_pinit ) ? 'data-pin-no-hover="true" ' : '';
		if ( true === $use_lazyload ) {
			?>
			<img class="lazyload" <?php echo $add_nopin;// WPCS: XSS ok. ?>
				src="<?php echo get_template_directory_uri() . '/images/placeholder15.png';// WPCS: XSS ok. ?>"
				data-src="<?php echo esc_url( $image_url ); ?>"
				alt="<?php esc_attr_e( 'feature image', 'canuck' ); ?>">
			<?php
		} else {
			?>
			<img <?php echo $add_nopin;// WPCS: XSS ok. ?>src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'feature image', 'canuck' ); ?>">
			<?php
		}
		?>
	</div>
	<?php
}

