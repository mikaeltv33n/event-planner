<?php

// Register Custom Post Type for Events
function custom_post_type_events() {

    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Events', 'text_domain' ),
        'name_admin_bar'        => __( 'Event', 'text_domain' ),
        'archives'              => __( 'Event Archives', 'text_domain' ),
        'attributes'            => __( 'Event Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
        'all_items'             => __( 'All Events', 'text_domain' ),
        'add_new_item'          => __( 'Add New Event', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Event', 'text_domain' ),
        'edit_item'             => __( 'Edit Event', 'text_domain' ),
        'update_item'           => __( 'Update Event', 'text_domain' ),
        'view_item'             => __( 'View Event', 'text_domain' ),
        'view_items'            => __( 'View Events', 'text_domain' ),
        'search_items'          => __( 'Search Event', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into event', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this event', 'text_domain' ),
        'items_list'            => __( 'Events list', 'text_domain' ),
        'items_list_navigation' => __( 'Events list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter events list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Event', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
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
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'event', $args );

}
add_action( 'init', 'custom_post_type_events', 0 );

function enqueue_event_styles() {
    wp_enqueue_style('event-styles', get_template_directory_uri() . '/event-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_event_styles');

?>
