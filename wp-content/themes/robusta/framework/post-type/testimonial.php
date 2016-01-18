<?php
// Register Custom Post Type
function tb_add_post_type_testimonial() {
    // Register taxonomy
    $labels = array(
            'name'              => _x( 'Testimonial Category', 'taxonomy general name', 'robusta' ),
            'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'robusta' ),
            'search_items'      => __( 'Search Testimonial Category', 'robusta' ),
            'all_items'         => __( 'All Testimonial Category', 'robusta' ),
            'parent_item'       => __( 'Parent Testimonial Category', 'robusta' ),
            'parent_item_colon' => __( 'Parent Testimonial Category:', 'robusta' ),
            'edit_item'         => __( 'Edit Testimonial Category', 'robusta' ),
            'update_item'       => __( 'Update Testimonial Category', 'robusta' ),
            'add_new_item'      => __( 'Add New Testimonial Category', 'robusta' ),
            'new_item_name'     => __( 'New Testimonial Category Name', 'robusta' ),
            'menu_name'         => __( 'Testimonial Category', 'robusta' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_category' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_category', array( 'testimonial' ), $args );
    }
    //Register tags
    $labels = array(
            'name'              => _x( 'Testimonial Tag', 'taxonomy general name', 'robusta' ),
            'singular_name'     => _x( 'Testimonial Tag', 'taxonomy singular name', 'robusta' ),
            'search_items'      => __( 'Search Testimonial Tag', 'robusta' ),
            'all_items'         => __( 'All Testimonial Tag', 'robusta' ),
            'parent_item'       => __( 'Parent Testimonial Tag', 'robusta' ),
            'parent_item_colon' => __( 'Parent Testimonial Tag:', 'robusta' ),
            'edit_item'         => __( 'Edit Testimonial Tag', 'robusta' ),
            'update_item'       => __( 'Update Testimonial Tag', 'robusta' ),
            'add_new_item'      => __( 'Add New Testimonial Tag', 'robusta' ),
            'new_item_name'     => __( 'New Testimonial Tag Name', 'robusta' ),
            'menu_name'         => __( 'Testimonial Tag', 'robusta' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_tag', array( 'testimonial' ), $args );
    }
    
    //Register post type Testimonial
    $labels = array(
            'name'                => _x( 'Testimonial', 'Post Type General Name', 'robusta' ),
            'singular_name'       => _x( 'Testimonial Item', 'Post Type Singular Name', 'robusta' ),
            'menu_name'           => __( 'Testimonial', 'robusta' ),
            'parent_item_colon'   => __( 'Parent Item:', 'robusta' ),
            'all_items'           => __( 'All Items', 'robusta' ),
            'view_item'           => __( 'View Item', 'robusta' ),
            'add_new_item'        => __( 'Add New Item', 'robusta' ),
            'add_new'             => __( 'Add New', 'robusta' ),
            'edit_item'           => __( 'Edit Item', 'robusta' ),
            'update_item'         => __( 'Update Item', 'robusta' ),
            'search_items'        => __( 'Search Item', 'robusta' ),
            'not_found'           => __( 'Not found', 'robusta' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'robusta' ),
    );
    $args = array(
            'label'               => __( 'Testimonial', 'robusta' ),
            'description'         => __( 'Testimonial Description', 'robusta' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
            'taxonomies'          => array( 'testimonial_category', 'testimonial_tag' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-yes',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
    );
    
    if(function_exists('custom_reg_post_type')) {
        custom_reg_post_type( 'testimonial', $args );
    }
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_testimonial', 0 );
