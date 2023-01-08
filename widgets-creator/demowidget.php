<?php

/* 
Plugin Name: Widgets Demo
Plugin URI: http://localhost/philosophy/wp-admin/plugins.php?
Description: Demo plugin api
Version: 1.0
Author: Limon Hossain
Author URI: https://facebook.com/
License: GPLv2 or later
Text Domain: widgetdemo
*/

require_once plugin_dir_path( __FILE__ )."widgets/class.demowidget.php";

function widgetdemo_load_text_domain() {
    load_plugin_textdomain( 'widgetdemo', false, plugin_dir_path(__FILE__)."languages/" );
}
add_action( 'plugins_loaded', 'widgetdemo_load_text_domain' );


// register widget
function demowidget_register_widget() {
    register_widget( 'DemoWidget' );
}
add_action( 'widgets_init', 'demowidget_register_widget' );


// load assets
function widgetdemo_assets($screen) {
    if( $screen == "widgets.php" ) {
        wp_enqueue_style( 'widgets-style-css', plugin_dir_url( __FILE__ ). "assets/css/widget.css" );
    }
}
add_action( 'admin_enqueue_scripts', 'widgetdemo_assets' );