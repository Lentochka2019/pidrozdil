<?php

function pidrozdil_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'new_media', // link ID, defaults to a sanitized title value
        'title' => 'Підрозділи', // link title
        'href' => admin_url( 'edit.php?post_type=pidrozdily'), // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
	 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct-gf', // link ID, defaults to a sanitized title value
        'title' => 'Гірничий факультет', // link title
        'href' => 'https://donntu.edu.ua/gorn', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
		 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct-kitaer', // link ID, defaults to a sanitized title value
        'title' => 'Кітаер', // link title
        'href' => 'https://donntu.edu.ua/kitaer', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
		 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct-knt', // link ID, defaults to a sanitized title value
        'title' => 'КНТ', // link title
        'href' => 'https://donntu.edu.ua/knt', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
		 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct-fem', // link ID, defaults to a sanitized title value
        'title' => 'ФЕМ', // link title
        'href' => 'https://donntu.edu.ua/fem', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
		 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct-meht', // link ID, defaults to a sanitized title value
        'title' => 'МЕХТ', // link title
        'href' => 'https://donntu.edu.ua/meht', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
		 $wp_admin_bar->add_menu( array(
        'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
        'id' => 'struct', // link ID, defaults to a sanitized title value
        'title' => 'Факультети', // link title
        'href' => 'https://donntu.edu.ua/struktura-vnz-donntu', // name of file
        'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
    ));
}
add_action( 'wp_before_admin_bar_render', 'pidrozdil_admin_bar_render' );
 
function true_colored_admin_bar_0073aa(){
	echo '<style>#wpadminbar{background-color: #0073aa;}</style>'; // выводим стили
}
add_action( 'admin_head', 'true_colored_admin_bar_0073aa' );

