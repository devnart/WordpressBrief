<?php
/**
 * Options Action.
 * 
 * @package ULTP\Notice
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Options class.
 */
class Options{

    /**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'menu_page_callback' ) );
        add_action( 'in_admin_header', array($this, 'remove_all_notices') );
        add_filter( 'plugin_row_meta', array( $this, 'plugin_settings_meta' ), 10, 2 );
        add_filter( 'plugin_action_links_'.ULTP_BASE, array( $this, 'plugin_action_links_callback' ) );
    }


    /**
	 * Plugin Page Menu Add
     * 
     * @since v.1.0.0
	 * @return ARRAY
	 */
    public function plugin_settings_meta( $links, $file ) {
        if ( strpos( $file, 'ultimate-post.php' ) !== false ) {
            $new_links = array(
                'ultp_docs' =>  '<a href="https://docs.wpxpo.com/" target="_blank">'.__('Docs', 'ultimate-post').'</a>',
                'ultp_tutorial' =>  '<a href="https://www.youtube.com/watch?v=JZxIflYKOuM&list=PLPidnGLSR4qcAwVwIjMo1OVaqXqjUp_s4" target="_blank">'.__('Tutorials', 'ultimate-post').'</a>',
                'ultp_support' =>  '<a href="'.ultimate_post()->get_premium_link( 'https://www.wpxpo.com/contact/' ).'" target="_blank">'.__('Support', 'ultimate-post').'</a>'
            );
            $links = array_merge( $links, $new_links );
        }
        return $links;
    }


    /**
	 * Settings Pro Update Link
     * 
     * @since v.1.0.0
	 * @return ARRAY
	 */
    public function plugin_action_links_callback( $links ) {
        $upgrade_link = array();
        $setting_link = array();
        if(!defined('ULTP_PRO_VER')){
            $upgrade_link = array(
                'ultp_pro' => '<a href="'.ultimate_post()->get_premium_link().'" target="_blank"><span style="color: #e83838; font-weight: bold;">'.__('Go Pro', 'ultimate-post').'</span></a>'
            );
        }
        $setting_link['ultp_settings'] = '<a href="'. menu_page_url('ultp-option-settings', false) .'">'. __('Settings', 'wp-megamenu') .'</a>';
        return array_merge( $setting_link, $links, $upgrade_link);
    }


    /**
	 * Admin Menu Option Page
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function menu_page_callback() {
        
        $ultp_menu_icon = 'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MCA0OC4zIj4NCiAgPGRlZnM+DQogICAgPHN0eWxlPg0KICAgICAgLmNscy0xIHsNCiAgICAgICAgZmlsbDogI2E3YWFhZDsNCiAgICAgIH0NCiAgICA8L3N0eWxlPg0KICA8L2RlZnM+DQogIDx0aXRsZT5Qb3N0eCBJY29uIGNtcHJzc2QgU1ZHPC90aXRsZT4NCiAgPGc+DQogICAgPHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTguODEsOXY4LjlIOC4xOUE2LjE5LDYuMTksMCwwLDAsMiwyMy43N2EzLjE2LDMuMTYsMCwwLDEtMi0yLjk0VjRBMy4xNiwzLjE2LDAsMCwxLDMuMTUuODVIMjBhMy4xOCwzLjE4LDAsMCwxLDMsMi4zMUE2LjIxLDYuMjEsMCwwLDAsMTguODEsOVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTAuODUpIi8+DQogICAgPHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNDUsOVYyM0gzMS4xYTYuMjMsNi4yMywwLDAsMC00LjkzLTQuOTNBNS41NCw1LjU0LDAsMCwwLDI1LDE3Ljk0SDIxLjg1VjlBMy4xNSwzLjE1LDAsMCwxLDIzLjEzLDYuNWEzLjEyLDMuMTIsMCwwLDEsMS40My0uNThsLjA5LDBINDEuODNBMy4xNCwzLjE0LDAsMCwxLDQ1LDlaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0wLjg1KSIvPg0KICAgIDxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTUwLDI5LjE3VjQ2YTMuMTYsMy4xNiwwLDAsMS0zLjE1LDMuMTVIMzBhMy4xOCwzLjE4LDAsMCwxLTMtMi4zMUE2LjIyLDYuMjIsMCwwLDAsMzEuMjEsNDFWMjZINDYuODVhMy4zLDMuMywwLDAsMSwxLjE0LjIxQTMuMTYsMy4xNiwwLDAsMSw1MCwyOS4xN1oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTAuODUpIi8+DQogICAgPHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMjguMTYsMjQuMTNWNDFhMy4xMywzLjEzLDAsMCwxLTEuMjksMi41NCwzLDMsMCwwLDEtMS40Ny41OGwwLDBIOC4xOUEzLjE1LDMuMTUsMCwwLDEsNSw0MVYyNGEzLjE3LDMuMTcsMCwwLDEsMy4xNS0zSDI1YTMuMTIsMy4xMiwwLDAsMSwxLjE0LjIyLDMuMjQsMy4yNCwwLDAsMSwxLjksMi4xQTMuNjMsMy42MywwLDAsMSwyOC4xNiwyNC4xM1oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTAuODUpIi8+DQogIDwvZz4NCjwvc3ZnPg0K';
        add_menu_page(
            esc_html__( 'PostX', 'ultimate-post' ),
            esc_html__( 'PostX', 'ultimate-post' ),
            'manage_options',
            'ultp-settings',
            '',
            $ultp_menu_icon
        );
        require_once ULTP_PATH . 'classes/options/Overview.php';
        require_once ULTP_PATH . 'classes/options/Features.php';
        require_once ULTP_PATH . 'classes/options/Addons.php';
        require_once ULTP_PATH . 'classes/options/Settings.php';
        require_once ULTP_PATH . 'classes/options/Contact.php';
        new \ULTP\Options_Overview();
        new \ULTP\Options_Features();
        new \ULTP\Options_Addons();
        new \ULTP\Options_Settings();
        new \ULTP\Options_Contact();

        if( !function_exists('ultimate_post_pro') ){
            global $submenu;
            $upgrade_link = ultimate_post()->get_premium_link( 'https://www.wpxpo.com/postx/?ultp=plugins' );
            $submenu['ultp-settings'][] = array( '<span class="ultp-dashboard-upgrade"><span class="dashicons dashicons-update"></span> Upgrade</span>', 'manage_options', $upgrade_link );
        }
    }


    /**
	 * Remove All Notification From Menu Page
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function remove_all_notices() {
        if ( isset( $_GET['page'] ) && ( $_GET['page'] === 'ultp-settings' || $_GET['page'] === 'ultp-features' || $_GET['page'] === 'ultp-addons' || $_GET['page'] === 'ultp-option-settings' || $_GET['page'] === 'ultp-contact' || $_GET['page'] === 'ultp-license' ) ) {
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );
        }
    }
}

