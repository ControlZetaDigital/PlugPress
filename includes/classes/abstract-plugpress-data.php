<?php

/**
 * Abstract class for defining basic controls to manage data
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 *
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 */

/**
 * Abstract class for defining basic controls to manage data
 *
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 * @author     Control Zeta <code@controlzetadigital.com>
 */

defined( 'ABSPATH' ) || exit;

abstract class PlugPress_Data {

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
    protected $post_type = 'post';

    /**
	 * The object type of data.
	 *
	 * @since 1.0.0
	 * @var string
	 */
    protected $object_type = 'post';

    /**
	 * The data array key / values.
	 *
	 * @since 1.0.0
	 * @var array
	 */
    protected $data = array(
        'title'             => '',
        'slug'              => '',
        'date_created'      => null,
        'date_modified'     => null,
        'status'            => '',
        'content'           => '',
        'excerpt'           => '',
        'post_thumbnail'    => ''
    );

    /**
	 * The data aliases array.
	 *
	 * @since 1.0.0
	 * @var array
	 */
    protected $data_aliases = array(
        'title'             => 'post_title',
        'slug'              => 'post_name',
        'date_created'      => 'post_date',
        'date_modified'     => 'post_modified',
        'status'            => 'post_status',
        'content'           => 'post_content',
        'excerpt'           => 'post_excerpt'
    );

    /**
	 * The metadata of this data
	 *
	 * @since 1.0.0
	 * @var array
	 */
    protected $meta_data = array();

    public function __construct() { }

    /**
	 * Get data by key
	 *
	 * @since    1.0.0
	 * @param    string       $key         The key of the data to retrieve
     * @return   mixed
	 */
    public function __get( $key ) {
        if ($key === 'id') {
            return $this->id;
        }
        if ($key === 'post_type') {
            return $this->post_type;
        }
        if ($key === 'object_type') {
            return $this->object_type;
        }
        if (in_array($key, array_keys( $this->data ))) {
            return $this->data[$key];
        } else {
            return false;
        }
    }

    /**
	 * Get data by key
	 *
	 * @since    1.0.0
	 * @param    string       $key         The key of the data to retrieve
     * @return   mixed
	 */
    public function get_prop( $key ) {
        return $this->__get( $key );
    }

    /**
	 * Get the id of the object
	 *
	 * @since    1.0.0
     * @return   integer
	 */
    public function get_id() {
        return $this->__get( 'id' );
    }

    /**
	 * Get the post_type of the object
	 *
	 * @since    1.0.0
     * @return   string
	 */
    public function get_post_type() {
        return $this->__get( 'post_type' );
    }

    /**
	 * Get the object type
	 *
	 * @since    1.0.0
     * @return   string
	 */
    public function get_object_type() {
        return $this->__get( 'object_type' );
    }

    /**
	 * Set ID.
	 *
	 * @since    1.0.0
	 * @param    int    $id     ID.
	 */
	public function set_id( $id ) {
		$this->id = absint( $id );
	}

    /**
	 * Store data.
	 *
	 * @since    1.0.0
	 */
	public function store_data() {
		if ($this->id <= 0)
            return false;

        $post = get_post($this->id);
        foreach ($this->data as $key => $value) {
            switch ($key) {
                case 'post_thumbnail':
                    $this->data[$key] = get_the_post_thumbnail_url($post->ID, 'full');
                    break;
                default:
                    if ( ! in_array( $key, array_keys( $this->data_aliases ) ) ) {
                        if ( in_array( $key, array_keys( $this->data ) ) )
                            $this->data[$key] = $post->{$key};
                    } else {
                        $alias = $this->data_aliases[$key];
                        $this->data[$key] = $post->{$alias};
                    }
                    break;
            }
        }
	}
}