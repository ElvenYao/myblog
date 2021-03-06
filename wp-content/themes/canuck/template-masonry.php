<?php
/**
 * Template Name: Masonry Gallery
 *
 * Page for displaying galleries in a mosaic format.
 *
 * @package     Canuck WordPress Theme
 * @copyright   Copyright (C) 2017-2018  Kevin Archibald
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Kevin Archibald <www.kevinsspace.ca/contact/>
 */

global $canuck_include_breadcrumbs,$canuck_exclude_page_title;
$layout_option = esc_html( ( '' === get_post_meta( $post->ID, 'canuck_metabox_page_layout', true ) ? 'right_sidebar' : get_post_meta( $post->ID, 'canuck_metabox_page_layout', true ) ) );
$canuck_include_breadcrumbs = get_theme_mod( 'canuck_breadcrumbs' ) ? true : false;
$canuck_exclude_page_title = get_post_meta( $post->ID, 'canuck_metabox_title', true ) ? true : false;
$sidebar_a = esc_html( ( '' === get_post_meta( $post->ID, 'canuck_metabox_sidebar_a', true ) ? 'default-a' : get_post_meta( $post->ID, 'canuck_metabox_sidebar_a', true ) ) );
$sidebar_b = esc_html( ( '' === get_post_meta( $post->ID, 'canuck_metabox_sidebar_b', true ) ? 'default-b' : get_post_meta( $post->ID, 'canuck_metabox_sidebar_b', true ) ) );

get_header( 'no-feature' );

get_template_part( '/template-parts/partials', 'page-title' );
?>
<div id="main-section">
	<div id="content-wrap">
		<?php
		if ( 'left_sidebar' === $layout_option ) {
			echo '<aside id="two-column-sidebar-left" class="toggle-sb-a">';
				get_template_part( '/template-parts/sidebars/sidebar', 'default-a' );
			echo '</aside>';
			echo '<div id="two-column-content">';
				get_template_part( '/template-parts/partials', 'masonry' );
			echo '</div>';
		} elseif ( 'both_sidebars' === $layout_option ) {
			echo '<aside id="three-column-sidebar-left" class="toggle-sb-a">';
				get_template_part( '/template-parts/sidebars/sidebar', 'default-a' );
			echo '</aside>';
			echo '<div id="three-column-content">';
				get_template_part( '/template-parts/partials', 'masonry' );
			echo '</div>';
			echo '<aside id="three-column-sidebar-right" class="toggle-sb-b">';
				get_template_part( '/template-parts/sidebars/sidebar', 'default-b' );
			echo '</aside>';
		} elseif ( 'fullwidth' === $layout_option ) {
			echo '<div id="fullwidth">';
				get_template_part( '/template-parts/partials', 'masonry' );
			echo '</div>';
		} else {
			echo '<div id="two-column-content">';
				get_template_part( '/template-parts/partials', 'masonry' );
			echo '</div>';
			echo '<aside id="two-column-sidebar-right" class="toggle-sb-b">';
				get_template_part( '/template-parts/sidebars/sidebar', 'default-a' );
			echo '</aside>';
		}
		?>
	</div>
</div>
<div class="clearfix"></div>
<?php
get_footer();
