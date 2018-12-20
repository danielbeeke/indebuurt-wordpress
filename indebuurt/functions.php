<?php
/**
 * Theme Functions
 */
function indebuurt_scripts() {
  wp_enqueue_style('style-name', get_stylesheet_uri());

}

add_action('wp_enqueue_scripts', 'indebuurt_scripts');