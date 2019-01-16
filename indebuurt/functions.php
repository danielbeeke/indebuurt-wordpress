<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once(get_stylesheet_directory() . '/../../plugins/meta-box/meta-box.php');

/**
 * Theme Functions
 */
function indebuurt_scripts() {
  wp_enqueue_style('style-name', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'indebuurt_scripts');
wp_enqueue_script('script', get_template_directory_uri() . '/script.js', [], 1, TRUE);

function register_my_menus() {
  register_nav_menus(
    array(
      'main-menu' => __('Menu'),
    )
  );
}

add_action('init', 'register_my_menus');
function custom_events() {
  $labels = array(
    'name' => 'Events',
    'singular_name' => 'Event',
    'add_new' => 'Add Event',
    'all_items' => 'All Events',
    'add_new_item' => 'Add Event',
    'edit_item' => 'Edit Event',
    'new_item' => 'New Event',
    'view_item' => 'View Event',
    'search_item_label' => 'Search Events',
    'not_found' => 'No Events Found',
    'not_found_in_trash' => 'No Events Found in Trash',
    'parent_item_colon' => 'Parent Event'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'can_export' => true,
    'hierarchical' => true,
    'supports' => array(
      'title',
      'editor',
    ),
    'menu_icon' => 'dashicons-calendar-alt',
    'menu_position' => 5
  );

  register_post_type('events', $args);
}

function prefix_register_meta_boxes_events($meta_boxes) {
  $prefix = 'custom_event_';

  $meta_boxes[] = array(
    'id' => $prefix . 'details',
    'title' => 'Event details',
    'post_types' => 'events',
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
      array(
        'name' => 'Event date',
        'desc' => 'Select event date',
        'id' => $prefix . 'date',
        'type' => 'date',
      ),
      array(
        'name' => 'Event time',
        'desc' => 'Select event time',
        'id' => $prefix . 'time',
        'type' => 'time',
      ),
      array(
        'name' => 'Event location',
        'desc' => 'Location of the event',
        'id' => $prefix . 'location',
        'type' => 'text'
      )
    )
  );

  return $meta_boxes;
}

add_action('init', 'custom_events');

add_filter('rwmb_meta_boxes', 'prefix_register_meta_boxes_events');

function filter_events (&$query) {
  if (is_post_type_archive('events') && !is_admin() && $query->is_main_query()) {
    $qv = &$query->query_vars;
    $qv['meta_key'] = 'custom_event_date';
    $qv['meta_compare'] = '>=';
    $qv['meta_value'] = date("Y-m-d",time());
    unset($qv['year']);
    unset($qv['monthnum']);
    unset($qv['day']);
  }
}

add_action( 'pre_get_posts', 'filter_events' );
