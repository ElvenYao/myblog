<?php
/**
 * Template part file that contains the default sidebar b default content.
 *
 * This file is called by all primary template pages..
 *
 * @package     Canuck WordPress Theme
 * @copyright   Copyright (C) 2017-2018  Kevin Archibald
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Kevin Archibald <www.kevinsspace.ca/contact/>
 */

if ( ! dynamic_sidebar( 'canuck_default_sidebar_b' ) ) {
	?>
	<h2><?php esc_html_e( 'Default Sidebar B', 'canuck' ); ?></h2>
	<p><?php esc_html_e( 'Go to Appearance => Widgets and drag a widget over to this sidebar.', 'canuck' ); ?></p>
<?php
}

