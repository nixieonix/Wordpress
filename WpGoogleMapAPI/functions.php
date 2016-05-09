<?php 

function create_post_type () {
	register_post_type('location', 
		array('labels' => 
			array(
				'name' => __('Locations'),
				'singular_name' => __('Location')
			),
			'public' => true,
			'menu_position' => 4,
			'menu_icon'   => 'dashicons-location',
			'rewrite' => array('slug' => 'location'),
			'supports' => array('title','thumbnail','excerpt', 'editor'),
			'taxonomies' => array('category', 'post_tag')
		)
	);

	register_post_type('carousel', 
		array('labels' => 
			array(
				'name' => __('Carousel'),
				'singular_name' => __('Carousel')
			),
			'public' => true,
			'menu_position' => 4,
			'menu_icon'   => 'dashicons-media',
			'rewrite' => array('slug' => 'location'),
			'supports' => array('title','thumbnail', 'excerpt'),
			'taxonomies' => array('category', 'post_tag')
		)
	);
}

add_action ('init', 'create_post_type');



// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

if (function_exists ('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
}

if (function_exists ('add_image_size')) {
	add_image_size( 'featured', 400, 250, true );
	add_image_size( 'post-thumb', 150, 150, true );
}

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'farmStyle' ),
) );
