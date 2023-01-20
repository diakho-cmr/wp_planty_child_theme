<?php

function flavour_post_type() {

    $labels = [
        'name'               => 'Saveurs',
        'singular_name'      => 'Saveur',
        'add_new'            => 'Ajouter une saveur',
        'add_new_item'       => 'Ajouter une saveur',
        'edit_item'          => 'Modifier la saveur',
        'new_item'           => 'Nouvelle saveur',
        'view_item'          => 'Voir la saveur',
        'search_items'       => 'Rechercher une saveur',
        'not_found'          => 'Aucune saveur',
        'not_found_in_trash' => 'Aucune saveur',
        'parent_item_colon'  => ''
    ];

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-carrot',
        'supports'           => ['title', 'thumbnail', 'editor','author'],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'hierarchical'       => false,
        'show_in_rest'       => true
    );

    register_post_type( 'flavour', $args );
}

add_action( 'init', 'flavour_post_type' );