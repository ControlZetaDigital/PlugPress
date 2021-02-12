<?php

/**
 * Abstract class for manage basic plug data
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 *
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 */

/**
 * Abstract class for manage basic plug data
 *
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 * @author     Control Zeta <code@controlzetadigital.com>
 */

defined( 'ABSPATH' ) || exit;

abstract class PlugPress_Plug {

    /**
	 * The data id.
	 *
	 * @since 1.0.0
	 * @var integer
	 */
    protected $id = 0;

    /**
	 * The post type of data.
	 *
	 * @since 1.0.0
	 * @var string
	 */
    protected $plug_type = 'basic';

    /**
	 * The data array key / values.
	 *
	 * @since 1.0.0
	 * @var array
	 */
    protected $data = array();

    public function __construct() {}

}