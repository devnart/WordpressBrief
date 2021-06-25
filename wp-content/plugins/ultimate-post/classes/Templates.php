<?php
/**
 * Template Action.
 * 
 * @package ULTP\Templates
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Templates class.
 */
class Templates{

  	/**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct(){
        add_filter( 'template_include', array($this, 'set_template_callback') );
        $post_types = get_post_types();
		if( !empty($post_types) ){
			foreach ($post_types as $post_type){
				add_filter( "theme_{$post_type}_templates", array( $this, 'add_template_callback' ) );
			}
        }
    }

    /**
	 * Include Template File
     * 
     * @since v.1.0.0
     * @param STRING | Attachment 
	 * @return STRING | Template File Path
	 */
    public function set_template_callback($template){
		if ( is_singular() ) {
            if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) === 'ultp_page_template' ) {
                $template = ULTP_PATH . 'classes/template-without-title.php';
            }
		}
		return $template;
    }

	/**
	 * Add A Page Template
     * 
     * @since v.1.0.0
     * @param ARRAY | Page Template List
	 * @return ARRAY | Page Template List as Array
	 */
    public function add_template_callback($templates){
		$templates['ultp_page_template'] = __('PostX Template', 'ultimate-post');
		return $templates;
	}
}