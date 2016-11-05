<?php 
/*
 Plugin Name: theme-addons
 Plugin URI: http://codecomas.com
 Description: Theme addons. Plugins by Merk
 Version: 1.0
 Author: Merksk8
 Author URI: http://codecomas.com
 License: GPL2
 Copyright: merk
 */



defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function mk_theme_addons_build(){
	require( dirname( __FILE__ ) . '/functions.php' );
	//require( dirname( __FILE__ ) . '/load-styles.php' );
}

add_action( 'init', 'mk_theme_addons_build' );

add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

function register_plugin_styles() {
	wp_register_style( 'theme-addons', plugins_url( 'theme-addons/css/plugin.css' ), false, false );
	wp_enqueue_style( 'theme-addons' );
}

set_theme_mod('color_control','');
?>