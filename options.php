<?php
/**
 * @package WordPress
 * @subpackage IDEALAB
 * @since IDEALAB 1.0
 *
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'idealab'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/assets/images/';

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$options = array();

	$options[] = array(
		'name' => __('Header Meta', 'idealab'),
		'type' => 'heading');

// Standard Meta
	$options[] = array(
		'name' => __('Author Name', 'idealab'),
		'desc' => __('Populates meta author tag.', 'idealab'),
		'id' => 'meta_author',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Webmasters', 'idealab'),
		'desc' => __('Paste your Google Webmaster meta code: <a href="http://google.com/webmasters" target="_blank">http://google.com/webmasters</a>.', 'idealab'),
		'id' => 'meta_google_webmaster',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Analytics Code', 'idealab'),
		'desc' => __("Paste you google analytics ID: <a href='http://www.google.com/analytics/' target='_blank'>http://www.google.com/analytics/</a>.", 'idealab'),
		'id' => 'meta_google_analytics',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter username', 'idealab'),
		'desc' => __("Paste your Twitter username.", 'idealab'),
		'id' => 'social_twitter_username',
		'std' => '',
		'type' => 'text');


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	return $options;

}