<?php
defined('ABSPATH') || exit;

final class Elementor_ULTP_Extension {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        //add_action( 'plugins_loaded', array($this, 'init') );
        $this->init();
    }

    public function init() {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
    }

    public function widget_scripts() {
        $init = new \ULTP\ULTP_Initialization();
        $init->register_scripts_common();    
    }

    

    public function includes() {
        require_once ULTP_PATH.'addons/elementor/Elementor_Widget.php';
    }

    public function register_widgets() {
        $this->includes();
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Gutenberg_Post_Blocks_Widget() );
    }
}