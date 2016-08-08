<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */

// Let's load styles and scripts properly please
function theme_style_scripts() {
    // Styles
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
    wp_enqueue_style( 'Estimator', get_template_directory_uri() . '/css/Estimator.css' );
    wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.min.css' );
    wp_enqueue_style( 'jasny-css', get_template_directory_uri() . '/css/jasny-bootstrap.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    

    // Scripts
    wp_enqueue_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'jasny', get_template_directory_uri() . '/js/jasny-bootstrap.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script('collapse', get_template_directory_uri() . '/js/collapse.js', array('jquery') );
    wp_enqueue_script( 'styled-selectbox', get_template_directory_uri() . '/js/styled-selectbox.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'custom-estimator', get_template_directory_uri() . '/js/custom_estimator.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );
    wp_localize_script( 'ajax-pagination', 'ajaxpagination', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'theme_style_scripts' );

require_once('wp_bootstrap_navwalker.php');

// Mobile close button
add_filter( 'wp_nav_menu_items', 'closeButton', 10, 2 );
function closeButton ( $items, $args ) {
    if ($args->theme_location == 'main-nav') {
        $items .= '<li type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">Close<i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>';
    }   
    return $items;
}

add_filter('body_class','browser_body_class');	
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

function register_menus() {
    register_nav_menus(
        array(
            'main-nav' => 'Main Navigation',
            'footer-nav' => 'Footer Navigation',
            'contact-bar' => 'Contact Bar'
        )
    );
}
add_action( 'init', 'register_menus' );

// DO NOT EDIT 
// This corrects the estimator URL so it sends correctly
add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
function wpcf7_custom_form_action_url($url){
    return '/';
}

// remove_filter('subsection', 'wpautop', false, false);

/* -------------------------------------- *\
    Custom Post Types for Equipment
\* -------------------------------------- */
// Register Custom Post Type
function equipment() {

    $labels = array(
        'name'                  => 'Equipment',
        'singular_name'         => 'Equipment',
        'menu_name'             => 'Equipment Types',
        'name_admin_bar'        => 'Equipment',
        'archives'              => 'Equipment Archives',
        'parent_item_colon'     => 'Parent Equipment:',
        'all_items'             => 'All Equipment',
        'add_new_item'          => 'Add New Equipment',
        'add_new'               => 'Add New Equipment',
        'new_item'              => 'New Equipment',
        'edit_item'             => 'Edit Equipment',
        'update_item'           => 'Update Equipment',
        'view_item'             => 'View Equipment',
        'search_items'          => 'Search Equipment',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list'            => 'Items list',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Filter items list',
    );
    $args = array(
        'label'                 => 'Equipment',
        'description'           => 'Mac of All Trades Equipment',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes', ),
        // 'taxonomies'            => array( 'Macbook', ' Macbook Air', ' Macbook Pro', ' iMac', ' Mac mini', ' Mac Pro', ' iPad', ' iPhone', ' Accessories' ),
        'taxonomies'            => array( 'equipment_taxonomy' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'supports'              => array('title', 'thumbnail', 'excerpt')
    );
    register_post_type( 'equipment', $args );
}
add_action( 'init', 'equipment', 0 );

function equipment_taxonomy() {
  // Add new "Equipment Types" taxonomy to Posts
  register_taxonomy('Equipment Types', 'equipment', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Equipment Types', 'taxonomy general name' ),
      'singular_name' => _x( 'Equipment Type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Equipment Types' ),
      'all_items' => __( 'All Equipment Types' ),
      'parent_item' => __( 'Parent Equipment Type' ),
      'parent_item_colon' => __( 'Parent Equipment Type:' ),
      'edit_item' => __( 'Edit Equipment Type' ),
      'update_item' => __( 'Update Equipment Type' ),
      'add_new_item' => __( 'Add New Equipment Type' ),
      'new_item_name' => __( 'New Equipment Type Name' ),
      'menu_name' => __( 'Equipment Types' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'equipment-types', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/Equipment Types/"
      'hierarchical' => true // This will allow URL's like "/Equipment Types/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'equipment_taxonomy', 0 );

add_theme_support( 'post-thumbnails' );

?>