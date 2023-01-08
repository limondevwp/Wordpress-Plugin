<?php

/**
 * Plugin Name: Word COUNT EXAMPLE
 * Plugin URL: https://github.com/limondev
 * Description: Simple and very easy tools for your website.
 * Version: 1.0
 * Author: Limon Hossain
 * Author URI: https://facebook.com/
 * License: GPLv2 or later
 * Text Domain: word-count
 * Domain Path: /languages/
 */

function word_count_load_textdomain() {
    load_plugin_textdomain( 'word-count', false, plugin_dir_url( __FILE__ ) . '/languages' );
}
add_action( 'plugins_loaded', 'word_count_load_textdomain' );

/* function word_count_activation_hoook() {}
register_activation_hook( __FILE__, 'word_count_activation_hoook' );

function word_count_deactivation_hoook() {}
register_deactivation_hook( __FILE__, 'word_count_deactivation_hoook' );
 */
function wordcount_word_count( $content ) {
    $stripped_tags = strip_tags( $content );
    $word_count = str_word_count( $stripped_tags );
    $label = __( 'Total number of words', 'word-count' );
    $label = apply_filters('word_count_heading',$label);
    $tags = apply_filters('word_count_tag', 'h2');
    $content .= sprintf( '<%s>%s: %s </%s>',$tags, $label, $word_count, $tags );
    return $content;
}
add_filter( 'the_content', 'wordcount_word_count' );



function wordcount_display_readingtime($content){
    $stripped_tags = strip_tags( $content );
    $word_count = str_word_count( $stripped_tags );
    $reading_minute = floor($word_count / 200);
    $reading_sec = floor($word_count % 200 / (200 /60) );
    $is_visible = apply_filters('wordcount_display_readingtime', 1);

    if($is_visible){
        $label = __( 'Total reading time', 'word-count' );
        $label = apply_filters('word_count_reading_heading',$label);
        $tags = apply_filters('word_count_reading_tags', 'h4');

        $content .= sprintf( '<%s>%s: %s minutes %s seconds </%s>',$tags, $label, $reading_minute, $reading_sec, $tags );
    }
    return $content;

}
add_filter( 'the_content', 'wordcount_display_readingtime' );