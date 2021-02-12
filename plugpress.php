<?php
/*
Plugin Name: PlugPress
Plugin URI: https://controlzetadigital.com
Description: Un plugin compuesto por pequeños programas llamados plugs que permiten una sencilla y rápida configuración para que desarrolladores puedan personalizar sus sitios creados en Wordpress de forma rápida, personalizada y sin necesidad de instalar numerosos plugins que ralenticen la carga.
Version: 1.0.0
Author: Control Zeta
Author URI: https://controlzetadigital.com
License: GPLv2 or later
Text Domain: plugpress
*/

/**
 * @package PlugPress
 * @since	1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGPRESS_VERSION', '1.0.0' );
define( 'PLUGPRESS_PLUGIN', 'plugpress' );
define( 'PLUGPRESS_URL', plugin_dir_url(__FILE__) );
define( 'PLUGPRESS_PATH', plugin_dir_path(__FILE__) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require PLUGPRESS_PATH . 'includes/class-plugpress.php';

PlugPress::run();