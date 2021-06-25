<?php
defined( 'ABSPATH' ) || exit;

class Gutenberg_Post_Blocks_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'gutenberg-post-blocks';
    }

    public function get_title() {
        return __( 'PostX - Gutenberg Post Blocks', 'ultimate-post' );
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _all_posts(){
        $args = array(
            'post_type' => 'ultp_templates',
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $loop = new WP_Query( $args );   
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $data[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $data;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Settings', 'ultimate-post' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'saved_template',
			[
				'label' => __( 'Saved Template', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->_all_posts(),
			]
		);
        $this->add_control(
			'important_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<a href="'.admin_url('edit.php?post_type=ultp_templates').'" class="ultp-elementor-settings" target="_blank">Edit Template with Gutenberg</a>',
			]
		);
        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $settings['saved_template'];
        ob_start();

        if($id){
            $this->set_inline_css($id);
            echo '<div class="ultp-shortcode" data-postid="'.$id.'">';
                $args = array( 'p' => $id, 'post_type' => 'ultp_templates');
                $the_query = new \WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        the_content();
                    }
                    wp_reset_postdata();
                }
            echo '</div>';
        }else{
            echo '<p>'.__('Please Select Your Saved Template.', 'ultimate-post').'</p>';
        }

        echo ob_get_clean();
    }

    public function set_inline_css($id) {
        if(isset($_GET['action']) || isset($_POST['action'])){
            $upload_dir_url = wp_get_upload_dir();
            $upload_css_dir_url = trailingslashit( $upload_dir_url['basedir'] );
            $css_dir_path = $upload_css_dir_url . "ultimate-post/ultp-css-{$id}.css";
            if ( file_exists( $css_dir_path ) ) {
                $css_dir_url = trailingslashit( $upload_dir_url['baseurl'] );
                if (is_ssl()) {
                    $css_dir_url = str_replace('http://', 'https://', $css_dir_url);
                }
                $css_url = $css_dir_url . "ultimate-post/ultp-css-{$id}.css";
                echo '<style type="text/css">'.file_get_contents($css_url).'</style>';
            } else {
                $css = get_post_meta($id, '_ultp_css', true);
                if( $css ) {
                    echo '<style type="text/css">'.$css.'</style>';
                }
            }
        }else{
            ultimate_post()->set_css_style($id);
        }
    }


}