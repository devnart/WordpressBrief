<?php
/**
 * Compatibility Action.
 * 
 * @package ULTP\Notice
 * @since v.1.1.0
 */

namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Compatibility class.
 */
class Compatibility{

    /**
	 * Setup class.
	 *
	 * @since v.1.1.0
	 */
    public function __construct(){
        add_action( 'upgrader_process_complete', array($this, 'plugin_upgrade_completed'), 10, 2 );
    }


    /**
	 * Compatibility Class Run after Plugin Upgrade
	 *
	 * @since v.1.1.0
	 */
    public function plugin_upgrade_completed( $upgrader_object, $options ) {
        if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ){
            foreach( $options['plugins'] as $plugin ) {
                if( $plugin == ULTP_BASE ) {
                    $set_settings = array();

                    // Pro Addons Data Init
                    $addon_data = ultimate_post()->get_setting();
                    if (!isset($addon_data['ultp_category'])) {
                        $set_settings['ultp_category'] = 'false';
                    }
                    // if (!isset($addon_data['ultp_builder'])) {
                    //     $set_settings['ultp_builder'] = 'false';
                    // }
                    if (!isset($addon_data['ultp_templates'])) {
                        $set_settings['ultp_templates'] = 'true';
                    }
                    if (!isset($addon_data['ultp_elementor'])) {
                        $set_settings['ultp_elementor'] = 'true';
                    }

                    if (!isset($addon_data['post_grid_1'])) {
                        $set_settings['post_grid_1'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_2'])) {
                        $set_settings['post_grid_2'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_3'])) {
                        $set_settings['post_grid_3'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_4'])) {
                        $set_settings['post_grid_4'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_5'])) {
                        $set_settings['post_grid_5'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_6'])) {
                        $set_settings['post_grid_6'] = 'yes';
                    }
                    if (!isset($addon_data['post_grid_7'])) {
                        $set_settings['post_grid_7'] = 'yes';
                    }
                    if (!isset($addon_data['post_list_1'])) {
                        $set_settings['post_list_1'] = 'yes';
                    }
                    if (!isset($addon_data['post_list_2'])) {
                        $set_settings['post_list_2'] = 'yes';
                    }
                    if (!isset($addon_data['post_list_3'])) {
                        $set_settings['post_list_3'] = 'yes';
                    }
                    if (!isset($addon_data['post_list_4'])) {
                        $set_settings['post_list_4'] = 'yes';
                    }
                    if (!isset($addon_data['post_module_1'])) {
                        $set_settings['post_module_1'] = 'yes';
                    }
                    if (!isset($addon_data['post_module_2'])) {
                        $set_settings['post_module_2'] = 'yes';
                    }
                    if (!isset($addon_data['post_slider_1'])) {
                        $set_settings['post_slider_1'] = 'yes';
                    }
                    if (!isset($addon_data['heading'])) {
                        $set_settings['heading'] = 'yes';
                    }
                    if (!isset($addon_data['image'])) {
                        $set_settings['image'] = 'yes';
                    }
                    if (!isset($addon_data['taxonomy'])) {
                        $set_settings['taxonomy'] = 'yes';
                    }
                    if (!isset($addon_data['wrapper'])) {
                        $set_settings['wrapper'] = 'yes';
                    }

                    if (!empty($set_settings)) {
                        foreach ($set_settings as $key => $value) {
                            ultimate_post()->set_setting($key, $value);
                        }
                    }
                }
            }
        }
    }
}