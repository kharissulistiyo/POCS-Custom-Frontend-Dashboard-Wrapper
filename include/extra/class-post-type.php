<?php 
if (!defined('ABSPATH')) {
    exit;
}

class POCSCD_CustomPostType {
    // Properties to store the slug and name
    private $post_type_slug;
    private $post_type_name;
    private $post_type_plural;

    public function set_post_type_slug($slug) {
        $this->post_type_slug = $slug;
    }

    public function set_post_type_name($name) {
        $this->post_type_name = $name[0];
        $this->post_type_plural = $name[1];
    }

    public function labels() {
        return array(
            'name'                  => _x( $this->post_type_name, 'Post type general name', 'pocscd' ),
            'singular_name'         => _x( 'Book', 'Post type singular name', 'pocscd' ),
            'menu_name'             => _x( $this->post_type_plural, 'Admin Menu text', 'pocscd' ),
            'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'pocscd' ),
            'add_new'               => __( 'Add New', 'pocscd' ),
            'add_new_item'          => __( 'Add New Book', 'pocscd' ),
            'new_item'              => __( 'New Book', 'pocscd' ),
            'edit_item'             => __( 'Edit Book', 'pocscd' ),
            'view_item'             => __( 'View Book', 'pocscd' ),
            'all_items'             => __( 'All Books', 'pocscd' ),
            'search_items'          => __( 'Search Books', 'pocscd' ),
            'parent_item_colon'     => __( 'Parent Books:', 'pocscd' ),
            'not_found'             => __( 'No books found.', 'pocscd' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'pocscd' ),
            'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'pocscd' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'pocscd' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'pocscd' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'pocscd' ),
            'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'pocscd' ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'pocscd' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'pocscd' ),
            'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'pocscd' ),
            'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'pocscd' ),
            'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'pocscd' ),
        );
    }

    public function args() {
        return array(
            'labels'             => $this->labels(),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $this->post_type_slug ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );
    }

    public function register_post_type() {
        register_post_type( $this->post_type_slug, $this->args() );
    }
}