<?php

/*Регистрируем Підрозділи и таксономию для них
-----------------------------------------------*/
function pidrozdil_dobavit_tip()
{
    $labels = array(
        'name' => 'Підрозділи',
        'singular_name' => 'Підрозділ',
        'add_new' => 'Додати підрозділ',
        'add_new_item' => 'Додати новий підрозділ',
        'edit_item' => 'Редагувати підрозділ',
        'new_item' => 'Новая підрозділ',
        'view_item' => 'Посмотреть підрозділ',
        'search_items' => 'Найти підрозділ',
        'not_found' =>  'Підрозділів не знайдено',
        'not_found_in_trash' => 'В корзине специальностей не найдено',
        'parent_item_colon' => '',
        'menu_name' => 'Підрозділи'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
		'show_in_admin_bar'=>true,
		'show_in_rest'=>true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'comments','page-attributes')
    );
    register_post_type('pidrozdily', $args);
}
add_action('init', 'pidrozdil_dobavit_tip');