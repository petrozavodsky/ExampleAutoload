<?php
/*
Plugin Name: Example Autoload plugin
Author: Petrozavodsky
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . "includes/Autoloader.php" );


new ExampleAutoload\Autoloader( __FILE__, 'ExampleAutoload' );


// тут мы вызываем все существующие классы из немспейса ExampleAutoload\AutoPop
add_action( 'plugins_loaded', function () {

	new ExampleAutoload\Classes\Activate(
		__FILE__,
		'AutoPop',
		'ExampleAutoload'
	);

}, 50 );


