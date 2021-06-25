<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Options_Addons{
    public function __construct() {
        add_submenu_page('ultp-settings', 'Addons', 'Addons', 'manage_options', 'ultp-addons', array( $this, 'create_admin_page'), 10);
        add_filter('ultp_settings', array($this, 'get_addon_settings'), 10, 1);
    }


    public static function get_addon_settings($config) {
        $arr = array(
            'addon' => array(
                'label' => __('Blocks', 'ultimate-post'),
                'attr' => array(
                    'addon_enable' => array(
                        'type'  => 'heading',
                        'label' => __('Enable/Disable Blocks', 'ultimate-post'),
                    ),
                    'post_grid_1' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #1 Block.', 'ultimate-post')
                    ),
                    'post_grid_2' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #2 Block.', 'ultimate-post')
                    ),
                    'post_grid_3' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #3 Block.', 'ultimate-post')
                    ),
                    'post_grid_4' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #4 Block.', 'ultimate-post')
                    ),
                    'post_grid_5' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #5 Block.', 'ultimate-post')
                    ),
                    'post_grid_6' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #6 Block.', 'ultimate-post')
                    ),
                    'post_grid_7' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Grid #7 Block.', 'ultimate-post')
                    ),
                    'post_list_1' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post List #1 Block.', 'ultimate-post')
                    ),
                    'post_list_2' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post List #2 Block.', 'ultimate-post')
                    ),
                    'post_list_3' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post List #3 Block.', 'ultimate-post')
                    ),
                    'post_list_4' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post List #4 Block.', 'ultimate-post')
                    ),
                    'post_module_1' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Module #1 Block.', 'ultimate-post')
                    ),
                    'post_module_2' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Module #2 Block.', 'ultimate-post')
                    ),
                    'post_slider_1' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Post Slider #1 Block.', 'ultimate-post')
                    ),
                    'heading' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Heading Block.', 'ultimate-post')
                    ),
                    'image' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Image Block.', 'ultimate-post')
                    ),
                    'taxonomy' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Taxonomy Block.', 'ultimate-post')
                    ),
                    'wrapper' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'ultimate-post'),
                        'default' => true,
                        'desc' => __('Wrapper Block.', 'ultimate-post')
                    ),
                )
            )
        );
        return array_merge($config, $arr);
    }
  

    public static function all_addons(){
        $all_addons = array(
            'ultp_category' => array(
                'name' => __( 'Category', 'ultimate-post' ),
                'desc' => __( 'Choose your desired color and Image for categories or any taxonomy.', 'ultimate-post' ),
                'img' => ULTP_URL.'/assets/img/addons/category-style.svg',
                'is_pro' => true
            ),
            'ultp_builder' => array(
                'name' => __( 'Builder', 'ultimate-post' ),
                'desc' => __( 'Design template for Archive, Category, Custom Taxonomy, Date and Search page.', 'ultimate-post' ),
                'img' => ULTP_URL.'/assets/img/addons/builder-icon.svg',
                'is_pro' => true
            )
        );
        return apply_filters('ultp_addons_config', $all_addons);
    }

    /**
     * Settings page output
     */
    public function create_admin_page() { ?>
        <style>
            .style-css{
                background-color: #f2f2f2;
                -webkit-font-smoothing: subpixel-antialiased;
            }
        </style>

        <div class="ultp-option-body">
            
            <?php require_once ULTP_PATH . 'classes/options/Heading.php'; ?>

            <div class="ultp-content-wrap ultp-addons-wrap">
                <div class="ultp-text-center"><h2 class="ultp-admin-title"><?php _e('All Addons', 'ultimate-post'); ?></h2></div> 
                <div class="ultp-addons-items">
                    <?php
                        $option_value = ultimate_post()->get_setting();
                        $addons_data = self::all_addons();
                        foreach ($addons_data as $key => $val) {
                            echo '<div class="ultp-addons-item ultp-admin-card">';
                                echo '<div class="ultp-addons-item-content">';
                                    echo '<img src="'.$val['img'].'" />';
                                    echo '<h4>'.$val['name'].'</h4>';
                                    echo '<div class="ultp-addons-desc">'.$val['desc'].'</div>';
                                echo '</div>';
                            if( $val['is_pro'] && !defined('ULTP_PRO_VER') ){
                                echo '<div class="ultp-addons-btn">';
                                    echo '<a class="ultp-btn ultp-btn-default" target="_blank" href="'.ultimate_post()->get_premium_link().'">'.__("Get Pro", "ultimate-post").'</a>';
                                echo '</div>';
                            } else {
                                echo '<div class="ultp-addons-btn">';
                                    echo '<label class="ultp-switch">';
                                        echo '<input class="ultp-addons-enable" '.(($val['is_pro'] && (!defined('ULTP_PRO_VER'))) ? 'disabled' : '').' data-addon="'.$key.'" type="checkbox" '.( isset($option_value[$key]) && $option_value[$key] == 'true' ? 'checked' : '' ).'>';
                                        echo '<span class="ultp-slider ultp-round"></span>';
                                    echo '</label>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    ?> 
                </div>
            </div>
        </div>

    <?php }
}