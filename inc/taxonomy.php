<?php

// Создаем новую таксономию для специальностей/ пункт "Категорія підрозділів"
add_action('init', 'create_pidrozdil_taxonomies', 0);

function create_pidrozdil_taxonomies()
{/*Категории*/
    $labels = array(
        'name' => _x('Категорія підрозділів', 'taxonomy general name'),
        'singular_name' => _x('катерія підрохділу', 'taxonomy singular name'),
        'search_items' =>  __('Знайти категорію'),
        'all_items' => __('Усі категорії'),
        'parent_item' => __('Батьківська категорія підрозділів'),
        'parent_item_colon' => __('Родительская галузь'),
        'edit_item' => __('Родительская галузь'),
        'update_item' => __('Обновить категорію'),
        'add_new_item' => __('Додати нову категорію'),
        'new_item_name' => __('Назва нової категорії підрозділу'),
        'menu_name' => __('Категорія підрозділу'),
    );

    register_taxonomy('pidrozdil', array('pidrozdily'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
		'show_in_rest'=>true,
        'query_var' => true,
        'rewrite' => array('slug' => 'pidrozdil'),
    ));	
	
}

function post_tag_for_pidrozdily(){
	register_taxonomy_for_object_type( 'post_tag', 'pidrozdily');
} 
add_action( 'init', 'post_tag_for_pidrozdily' );