<?php

add_action('init', 'message_post_type_activation');
function message_post_type_activation()
{
    if (!post_type_exists('message')) {
        $labels = array(
            'name' => _x('Messages', 'post type general name', 'my-plugin'),
            'singular_name' => _x('Message', 'post type singular name', 'my-plugin'),
            'menu_name' => _x('Messages', 'admin menu', 'my-plugin'),
            'name_admin_bar' => _x('Message', 'add new on admin bar', 'my-plugin'),
            'add_new' => _x('Add New', 'message', 'my-plugin'),
            'add_new_item' => __('Add New Message', 'my-plugin'),
            'new_item' => __('New Message', 'my-plugin'),
            'edit_item' => __('Edit Message', 'my-plugin'),
            'view_item' => __('View Message', 'my-plugin'),
            'all_items' => __('All Messages', 'my-plugin'),
            'search_items' => __('Search Messages', 'my-plugin'),
            'parent_item_colon' => __('Parent Messages:', 'my-plugin'),
            'not_found' => __('No messages found.', 'my-plugin'),
            'not_found_in_trash' => __('No messages found in Trash.', 'my-plugin'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'message'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => 'dashicons-buddicons-pm',
            'supports' => array('title', 'editor'),
        );
        register_post_type('message', $args);
    }
}