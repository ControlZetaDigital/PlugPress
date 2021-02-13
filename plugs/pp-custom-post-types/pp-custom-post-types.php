<?php
/*
Plug Name: Custom Post Types
Description: Permite crear custom post types
Version: 1.0.0
Author: Control Zeta
Author URI: https://controlzetadigital.com
License: GPLv2 or later
*/

defined( 'ABSPATH' ) || exit;

require $plug_path . "/includes/class-{$plug_id}.php";

$plug = new Plug_CustomPostTypes( $plug_data );
$plug->run();