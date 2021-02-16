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
        if ( isset( $data['version'] ) ) {
            $this->version = $data['version'];
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

	public function get_data( $key = '' ) {
		return ($key != '' && isset($this->data[$key])) ? $this->data[$key] : $this->data;
	}

	public function get_name() {
		return $this->get_data('plug_name');
	}

	public function get_description() {
		return $this->get_data('description');
	}

	public function get_author() {
		return $this->get_data('author');
	}

	public function get_author_uri() {
		return $this->get_data('author_uri');
	}

	public function run() {
        
    }

}