<?php
/*
 * Plugin Name: Підрозділи ДонНТУ
 * Plugin URI: https://donntu.edu.ua
 * Description: Підрозділи ДонНТУ
 * Version: 1.1.1
 * Author: ІОЦ
 * Author URI: https://donntu.edu.ua
 * License: GPLv2 or later
 */

$dir = plugin_dir_path( __FILE__ );

require_once($dir.'inc/admin-menu.php');
require_once($dir.'inc/dobavit-tip.php');
require_once($dir.'inc/taxonomy.php');
require_once($dir.'inc/dobavit-tip.php');
require_once($dir.'inc/kerivnik-metabox.php');
require_once($dir.'inc/documenti-metabox.php');

if (!function_exists ('pidrozdil_enqueue_script' )){

    function pidrozdil_enqueue_script() {
        wp_enqueue_script('pidrozdil-select-file', plugin_dir_url(__FILE__) . 'js/select-file.js');
    }

    add_action( 'admin_enqueue_scripts', 'pidrozdil_enqueue_script' );
}

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {

	$posttype=get_post_type();
	$pageid=get_the_ID();
//	echo $posttype;
	
	   
    if ($posttype == 'pidrozdily' or $pageid=='1866' ) {
	wp_enqueue_style( 'pidrozdilPluginStylesheet', plugins_url('stylesheet.css', __FILE__) );		
	 if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
           
               $template_path = plugin_dir_path( __FILE__ ) . '/single-pidrozdil.php';
        }
        elseif ( is_archive() or is_page( '1866' ) ) { $template_path = plugin_dir_path( __FILE__ ) . '/archive-pidrozdil.php';
            }
                     
    }
	
    return $template_path;
}
