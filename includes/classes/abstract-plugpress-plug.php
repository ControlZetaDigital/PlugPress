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
	 * The current version of the plug.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plug.
	 */
	protected $version;

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

    public function __construct( $data ) {
        if ( defined( 'PLUGPRESS_VERSION' ) ) {
            $this->version = PLUGPRESS_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->id = $data['plug_id'];
        $this->data = $data;
    }

	public function get_version() {
		return $this->version;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_type() {
		return $this->plug_type;
	}

	public function get_data() {
		return $this->data;
	}

	public function run() {
        
    }

}