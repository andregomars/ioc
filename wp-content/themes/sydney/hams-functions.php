<?php
/**
 * customized functions ddd by Andre
 *
 * @package HAMS
 */

add_action('wp_enqueue_scripts', 'load_scripts');
function load_scripts() {
    global $post;
    wp_register_style('bootstrap-css', 
    	'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', 
    	array(), '4.0.0-alpha.6', 'all');
    wp_register_style('fontawesome-css', 
    	'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 
    	array(), '4.7.0', 'all');

    wp_register_script( 'urlSearchParam', get_template_directory_uri() . '/js/hams/url-search-params.js', array('jquery'), false, true);
    wp_register_script( 'fleet', get_template_directory_uri() . '/js/hams/fleet-bundle.js', array('jquery'), false, true);
    wp_register_script( 'vehicle', get_template_directory_uri() . '/js/hams/vehicle-bundle.js', array('jquery'), false, true);

    if( is_page() || is_single() )
    {
        switch($post->post_name) 
        {
            case 'fleet':
            	wp_enqueue_style('bootstrap-css');
                wp_enqueue_style('fontawesome-css');
                wp_enqueue_script('fleet');
                break;
            case 'vehicle':
            	wp_enqueue_style('bootstrap-css');
                wp_enqueue_script('urlSearchParam');
                wp_enqueue_script('vehicle');
                break;
        }
    } 
}
