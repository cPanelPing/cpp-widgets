<?php
/*
Plugin Name: cPanelPing Widgets
Plugin URI: https://my.cpanelping.com
Description: Adds a widget to the wp-admin dashboard with your server status and incident log. Also, add a widget to the frontend via the (Appearence > Widgets) menu. On WordPress Multisite, this plugin must be "Network Activated".
Author:	Jason Jersey
Author URI: https://www.twitter.com/degersey
Version: 1.0.1
Text Domain: cpp-widgets
Domain Path: language
*/

/** exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/** load functions **/
require_once(dirname(__FILE__)."/functions.php");

/** load panel **/
require_once(dirname(__FILE__)."/panel.php");

/** enable panel menu **/
if ( is_multisite() ) { 
    add_action('network_admin_menu', 'cpanelping_fp_panel_menu');
} else {
    add_action('admin_menu', 'cpanelping_fp_panel_menu');
}

/** enqueue panel page css **/
add_action('admin_enqueue_scripts', 'cpanelping_panel_style');

/** enable language support **/
add_action('plugins_loaded', 'cpanelping_textdomain');

// add dashboard widgets
if (get_option("cpanelping_monitor_url")) {
    if ( is_multisite() ) { 
        add_action( 'wp_network_dashboard_setup', 'dashboard_add_server_monitor_widget' );
    } else {
        add_action( 'wp_dashboard_setup', 'dashboard_add_server_monitor_widget' );
    }
}

// add frontend widget
if (get_option("cpanelping_monitor_url")) add_action( 'widgets_init', 'cpp_load_widget' );
