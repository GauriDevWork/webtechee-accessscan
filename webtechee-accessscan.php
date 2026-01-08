<?php
/*
Plugin Name: WebTechee AccessScan
Description: Run automated accessibility scans to detect common accessibility issues on your WordPress site.
Version: 1.0.0
Author: Gauri Kaushik
Author URI: https://webtechee.me
Text Domain: webtechee-accessscan
License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WTAS_PATH', plugin_dir_path( __FILE__ ) );

require_once WTAS_PATH . 'includes/class-scanner.php';
require_once WTAS_PATH . 'includes/class-admin-ui.php';

add_action( 'plugins_loaded', function () {
    new ASS_Admin_UI();
});
