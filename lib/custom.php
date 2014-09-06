<?php
/**
 * Custom functions
 */

// GA Hook
add_action('wp_footer', 'statrAnalytics');

// Google Analytics Code
function statrAnalytics() {
	global $theme_options;
	echo $theme_options['google-analytics'];
}