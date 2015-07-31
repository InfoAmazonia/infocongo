<?php

/*
 * InfoCongo resources
 */

// Template functions
include(STYLESHEETPATH . '/inc/template-functions.php');

// Countries
include(STYLESHEETPATH . '/inc/countries.php');

// Topics
include(STYLESHEETPATH . '/inc/topics.php');

// Datasets
include(STYLESHEETPATH . '/inc/datasets.php');

/*
 * Clears JEO default front-end styles and scripts
 */
function infocongo_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');


	// register normalize and grid system
	wp_register_style('infocongo-normalize', get_stylesheet_directory_uri() . '/css/normalize.css', array(), '2.0.4');
	wp_register_style('infocongo-skeleton', get_stylesheet_directory_uri() . '/css/skeleton.css', array('infocongo-normalize'), '2.0.4');

}
add_action('wp_enqueue_scripts', 'infocongo_scripts', 10);

/*
 * JEO Hooks examples
 * Most common hooks
 */

// Action right after JEO functionality inits
function infocongo_init() {
  // Action goes here
}
add_action('jeo_init', 'infocongo_init');

// Hook scripts after JEO scripts has been initialized
function infocongo_jeo_scripts() {

  // Register and enqueue scripts here

	// Enqueue child theme JEO related scripts
  wp_enqueue_script('infocongo-jeo-scripts', get_stylesheet_directory_uri() . '/js/jeo-scripts.js', array('jquery') , '0.0.1');

	// Enqueue main CSS (with grid system dependency)
  wp_enqueue_style('infocongo-styles', get_stylesheet_directory_uri() . '/css/main.css', array('infocongo-skeleton'));

}
add_action('jeo_enqueue_scripts', 'infocongo_jeo_scripts', 20);

// Hook scripts after JEO Marker scripts has been initialized
function infocongo_markers_scripts() {

  // Register and enqueue scripts here
  wp_enqueue_script('infocongo-jeo-markers-scripts', get_stylesheet_directory_uri() . '/js/jeo-markers-scripts.js', array('jquery') , '0.0.1');

}
add_action('jeo_markers_enqueue_scripts', 'infocongo_markers_scripts', 20);

// Filter to change posts GeoJSON data (also changes the GeoJSON API output)
function infocongo_marker_data($data, $post) {

  // Change $data here

  return $data;
}
add_filter('jeo_marker_data', 'infocongo_marker_data', 10, 2);

// Filter to change GeoJSON response
function infocongo_markers_data($data, $query) {

  // Change $data here

  return $data;
}
add_filter('jeo_markers_data', 'infocongo_markers_data', 10, 2);

// Filter to programatically change map data
function infocongo_map_data($data, $map) {

  // Change $data here

  return $data;
}
add_filter('jeo_map_data', 'infocongo_map_data', 10, 2);
