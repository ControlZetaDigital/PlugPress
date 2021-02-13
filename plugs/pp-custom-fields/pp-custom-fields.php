<?php
/*
Plug Name: Custom Fields
Description: Permite crear campos personalizados
Version: 1.0.0
Author: Control Zeta
Author URI: https://controlzetadigital.com
License: GPLv2 or later
*/

defined( 'ABSPATH' ) || exit;

require $plug_path . "/includes/class-{$plug_id}.php";

$plug = new Plug_CustomFields( $plug_data );
$plug->run();