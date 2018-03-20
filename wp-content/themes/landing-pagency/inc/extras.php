<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package landing Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function landing_pagency_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'landing_pagency_body_classes' );


add_action( 'admin_menu', 'landing_pagency_register_backend' );
function landing_pagency_register_backend() {
	add_theme_page( __('Landing Pagency', 'landing-pagency'), __('Landing Pagency', 'landing-pagency'), 'edit_theme_options', 'about-landing_pagency.php', 'landing_pagency_backend');
}

function landing_pagency_backend(){ ?>
<div class="theme-info-wrapper">
	<div class="theme-info-inner">
		<div class="theme-info-left">
			<div class="theme-info-left-inner">
				<h2>Plugin or WordPress issues?</h2>
				<p>
					If you are experiencing issues with plugins, please contact the plugin author. If you are experiencing issues with WordPress functionality then please visit the <a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a>.
				</p>
				<h2>Theme issues?</h2>
				<p>
					If you are having theme related problems then please contact us through our <a href="http://admirablethemes.com/contact/" target="_blank">contact form</a>, which can be found at <a href="http://admirablethemes.com/contact/" target="_blank">http://admirablethemes.com/contact/</a>
				</p>	

				<h2>Need more help?</h2>
				<ul>
					<li><a href="http://admirablethemes.com/landing-pagency-theme/" target="_blank">Landing Pagency Premium</a></li>
					<li><a href="http://admirablethemes.com/contact/" target="_blank">Contact AdmirableThemes</a></li>
					<li><a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a></li>
				</ul>
			</div>
		</div>
		<div class="theme-info-right">
			<a href="http://admirablethemes.com/landing-pagency-theme/" target="_blank" style="display:block;">
				<img src="http://admirablethemes.com/wp-content/uploads/2017/10/landing-pagency-info.png">
			</a>
		</div>
	</div>
</div>
<?php }
