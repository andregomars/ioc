<?php
/**
 * customized functions ddd by Andre
 *
 * @package HAMS
 */

add_action('wp_enqueue_scripts', 'load_scripts', 20);
function load_scripts() {
    global $post;

    //register css
    wp_register_style('bootstrap', 
    	'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', 
    	array(), '4.0.0-alpha.6', 'all');
    wp_register_style('fontawesome', 
    	'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 
    	array(), '4.7.0', 'all');
    wp_register_style('hams', get_template_directory_uri() . '/css/hams/style.css');

    //register js
    wp_register_script( 'urlSearchParam', get_template_directory_uri() . '/js/hams/url-search-params.js', array('jquery'), false, true);
    wp_register_script( 'fleet', get_template_directory_uri() . '/js/hams/fleet-bundle.js', array('jquery'), false, true);
    wp_register_script( 'vehicle', get_template_directory_uri() . '/js/hams/vehicle-bundle.js', array('jquery'), false, true);

    if( is_page() || is_single() )
    {
        switch($post->post_name) 
        {
            case 'fleet':
                load_hams_style();
            	wp_enqueue_style('bootstrap');
                wp_enqueue_style('fontawesome');
                wp_enqueue_script('fleet');
                break;
            case 'vehicle':
                load_hams_style();
            	wp_enqueue_style('bootstrap');
                wp_enqueue_script('urlSearchParam');
                wp_enqueue_script('vehicle');
                break;
            default:
                break;
        }
    } 
}

function load_hams_style() {
    //dequeue theme css
    wp_dequeue_style( 'sydney-style' );
    wp_deregister_style( 'sydney-style' );
    wp_dequeue_style( 'sydney-bootstrap' );
    wp_deregister_style( 'sydney-bootstrap' );
    wp_dequeue_style( 'sydney-font-awesome' );
    wp_deregister_style( 'sydney-font-awesome' );

    //enqueue hams css
    wp_enqueue_style('hams');
}
