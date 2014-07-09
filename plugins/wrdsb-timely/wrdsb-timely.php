<?php

/**
 * Plugin Name: Timely add-on for wrdsb
 * Plugin URI: http://time.ly/
 * Description: Adjustments to the timely calendar system as made by tbk
 * Author: Paul MacLean / Andre Lefort
 * Author URI: http:tbkcreative.com
 * Version: 2.0.13
 * Text Domain: timely-add-on-for-wrdsb
 * Domain Path: /language
 */
add_action( 'wp_enqueue_scripts', 'wrdsb_timely_scripts' );
add_action( 'wp_print_scripts', 'wrdsb_print_scripts' );

function wrdsb_timely_scripts()
{
	global $post;
	wp_enqueue_script( 'wrdsb-timely-js', plugins_url( '/js/wrdsb_timely.js', __FILE__ ), array(), '1.0.0', true );
	wp_localize_script( 'wrdsb-timely-js', 'wp', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'post_id' => $post->ID,
		'ajax_img_src' => plugins_url( '/img/ajax-loader.gif', __FILE__ ),
		'post_url' => get_permalink($post->ID)
			)
	);
	//wp_enqueue_script( 'wrdsb-typekit', '//use.typekit.net/xex0ouy.js');
}

function wrdsb_print_scripts()
{
	echo '<script type="text/javascript" src="//use.typekit.net/xex0ouy.js"></script>
		  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
}
