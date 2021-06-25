<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Shortcode {
    public function __construct(){
        add_shortcode('gutenberg_post_blocks', array($this, 'shortcode_callback'));
    }

    // Shortcode Callback
    function shortcode_callback( $atts = array(), $content = null ) {
        extract(shortcode_atts(array(
         'id' => ''
        ), $atts));

        $content = '';
        if($id){
            $init = new \ULTP\ULTP_Initialization();
            $init->register_scripts_common();
            ultimate_post()->set_css_style($id);
            $content_post = get_post($id);
            $content = $content_post->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            return '<div class="ultp-shortcode" data-postid="'.$id.'">' . $content . '</div>';
        }
        return '';
    }
    
}