<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Saved_Templates {
    public function __construct(){
        $this->templates_post_type_callback();
        add_action('admin_head', array($this, 'custom_head_templates'));
        add_action('load-post-new.php', array($this, 'disable_new_post_templates'));
        add_filter('manage_ultp_templates_posts_columns', array($this, 'templates_table_head'));
        add_action('manage_ultp_templates_posts_custom_column', array($this, 'templates_table_content'), 10, 2);
    }

    public function custom_head_templates() {
        if( 'ultp_templates' == get_current_screen()->post_type && (!defined('ULTP_PRO_VER')) ) {
            $post_count = wp_count_posts('ultp_templates');
            $post_count = $post_count->publish + $post_count->draft;
            if( $post_count > 0 ) { ?>
                <span class="ultp-saved-templates-action" data-link="<?php echo ultimate_post()->get_premium_link(); ?>" data-text="Go Pro for Unlimited Templates" data-count="<?php echo $post_count; ?>" style="display:none;"></span>
            <?php }
        }
    }

    public function disable_new_post_templates() {
        if ( get_current_screen()->post_type == 'ultp_templates' && (!defined('ULTP_PRO_VER')) ){
            $post_count = wp_count_posts('ultp_templates');
            $post_count = $post_count->publish + $post_count->draft;
            if ($post_count > 0) {
                wp_die( 'You are not allowed to do that! Please <a target="_blank" href="'.ultimate_post()->get_premium_link().'">Upgrade Pro.</a>' );
            }
        }        
    }

    // Template Heading Add
    public function templates_table_head( $defaults ) {
        $type_array = array('type' => __('Shortcode', 'ultimate-post'));
        array_splice( $defaults, 2, 0, $type_array ); 
        return $defaults;
    }

    // Column Content
    public function templates_table_content( $column_name, $post_id ) {
        if ($column_name == 'shortcode') {
            echo '<code>[gutenberg_post_blocks id="'.$post_id.'"]</code>';
        }
    }


    // Templates Post Type Register
    public function templates_post_type_callback() {
        $labels = array(
            'name'                => _x( 'Saved Templates', 'Templates', 'ultimate-post' ),
            'singular_name'       => _x( 'Saved Template', 'Templates', 'ultimate-post' ),
            'menu_name'           => __( 'Saved Templates', 'ultimate-post' ),
            'parent_item_colon'   => __( 'Parent Template', 'ultimate-post' ),
            'all_items'           => __( 'Saved Templates', 'ultimate-post' ),
            'view_item'           => __( 'View Template', 'ultimate-post' ),
            'add_new_item'        => __( 'Add New Template', 'ultimate-post' ),
            'add_new'             => __( 'Add New Template', 'ultimate-post' ),
            'edit_item'           => __( 'Edit Template', 'ultimate-post' ),
            'update_item'         => __( 'Update Template', 'ultimate-post' ),
            'search_items'        => __( 'Search Template', 'ultimate-post' ),
            'not_found'           => __( 'No Template Found', 'ultimate-post' ),
            'not_found_in_trash'  => __( 'Not Template found in Trash', 'ultimate-post' ),
        );
        $args = array(
            'labels'              => $labels,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor' ),
            'hierarchical'        => false,
            'public'              => false,
            'rewrite'             => false,
            'show_ui'             => true,
            'show_in_menu'        => 'ultp-settings',
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'page',
        );
       register_post_type( 'ultp_templates', $args );
    }
}