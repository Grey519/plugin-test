<?php
/*
Plugin Name: Stratis Test WP
Plugin URI: https://github.com/Grey519/plugin-test.git
Description: Simple Plugin pour tester les compétences, Afficher le formulaire avec le shortcode <strong>[form-template]</strong>
Version: 0.1
Author: Ahmed Hammami
Text Domain: plugin-test
*/

define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( PLUGIN_DIR . 'back/load-plugin.php' );
require_once( PLUGIN_DIR . 'front/init.php' );

