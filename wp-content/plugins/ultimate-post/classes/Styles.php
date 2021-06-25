<?php
/**
 * Styles Add and Style REST API Action.
 * 
 * @package ULTP\Styles
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Styles class.
 */
class Styles {

	/**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct(){
		$this->require_block_css();
		add_action('rest_api_init', array($this, 'save_block_css_callback'));
	}


	/**
	 * REST API Action
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function save_block_css_callback(){
		register_rest_route(
			'ultp/v1', 
			'/save_block_css/',
			array(
				array(
					'methods'  => 'POST', 
					'callback' => array( $this, 'save_block_content_css'),
					'permission_callback' => function () {
						return current_user_can( 'edit_posts' );
					},
					'args' => array()
				)
			)
		);
		register_rest_route(
			'ultp/v1',
			'/get_posts/',
			array(
				array(
					'methods'  => 'POST',
					'callback' => array($this, 'get_posts_call'),
					'permission_callback' => function () {
						return current_user_can('edit_posts');
					},
					'args' => array()
				)
			)
		);
		register_rest_route(
			'ultp/v1',
			'/appened_css/',
			array(
				array(
					'methods'  => 'POST',
					'callback' => array($this, 'appened_css_call'),
					'permission_callback' => function () {
						return current_user_can('edit_posts');
					},
					'args' => array()
				)
			)
		);
	}


	/**
	 * Save Import CSS in the top of the File
     * 
     * @since v.1.0.0
	 * @param OBJECT | Request Param of the REST API
	 * @return ARRAY/Exception | Array of the Custom Message
	 */
	public function appened_css_call($server) {
			$post = $server->get_params();
			$css = $post['inner_css'];
			$post_id = (int) sanitize_text_field($post['post_id']);
			if( $post_id ){
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				$filename = "ultp-css-{$post_id}.css";
				$dir = trailingslashit(wp_upload_dir()['basedir']).'ultimate-post/';
				if(file_exists($dir.$filename)) {
					$file = fopen($dir.$filename, "a");
					fwrite($file, $css);
					fclose($file);
				}
				$get_data = get_post_meta($post_id, '_ultp_css', true);
				update_post_meta($post_id, '_ultp_css', $get_data.$css);
				wp_send_json_success(array('success' => true, 'message' => __('Data retrive done', 'ultimate-post')));
			}else{
				return array('success' => false, 'message' => __('Data not found!!', 'ultimate-post'));
			}
	}


	/**
	 * Save Import CSS in the top of the File
     * 
     * @since v.1.0.0
	 * @param OBJECT | Request Param of the REST API
	 * @return ARRAY/Exception | Array of the Custom Message
	 */
	public function get_posts_call($server) {
		$post = $server->get_params();
		if (isset($post['postId'])) {
			return array('success' => true, 'data'=> get_post($post['postId'])->post_content, 'message' => __('Data retrive done', 'ultimate-post'));
		} else {
			return array('success' => false, 'message' => __('Data not found!!', 'ultimate-post'));
		}
	}


	/**
	 * Save Import CSS in the top of the File
     * 
     * @since v.1.0.0
	 * @param OBJECT | Request Param of the REST API
	 * @return ARRAY/Exception | Array of the Custom Message
	 */
	public function  save_block_content_css($request){
		try{
			global $wp_filesystem;
			if ( ! $wp_filesystem ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			$params 		= $request->get_params();
			$post_id 		= (int) sanitize_text_field($params['post_id']);
			$filename 		= "ultp-css-{$post_id}.css";
			$upload_dir_url = wp_upload_dir();
			$dir 			= trailingslashit($upload_dir_url['basedir']) . 'ultimate-post/';

			if ($params['has_block']) {
				update_post_meta($post_id, '_ultp_active', 'yes');
				$ultp_block_css = $this->set_top_css($params['block_css']);
				WP_Filesystem( false, $upload_dir_url['basedir'], true );
				if( ! $wp_filesystem->is_dir( $dir ) ) {
					$wp_filesystem->mkdir( $dir );
				}
				if ( ! $wp_filesystem->put_contents( $dir . $filename, $ultp_block_css ) ) {
					throw new Exception(__('CSS can not be saved due to permission!!!', 'ultimate-post')); 
				}
				update_post_meta($post_id, '_ultp_css', $ultp_block_css);
				return ['success'=>true, 'message'=>__('PostX css file has been updated.', 'ultimate-post')];
			} else {
				delete_post_meta($post_id, '_ultp_active');
				if (file_exists($dir.$filename)) {
					unlink($dir.$filename);
				}
				delete_post_meta($post_id, '_ultp_css');
				return ['success' => true, 'message' => __('Data Delete Done', 'ultimate-post')];
			}
		}catch(Exception $e){
			return [ 'success'=> false, 'message'=> $e->getMessage() ];
        }
	}

	
	/**
	 * Save Import CSS in the top of the File
     * 
     * @since v.1.0.0
	 * @param STRING | CSS (STRING)
	 * @return STRING | Generated CSS
	 */
	public function set_top_css($get_css = ''){
		$css_url = "@import url('https://fonts.googleapis.com/css?family=";
		$font_exists = substr_count($get_css, $css_url);
		if ($font_exists){
			$pattern = sprintf('/%s(.+?)%s/ims', preg_quote($css_url, '/'), preg_quote("');", '/'));
			if (preg_match_all($pattern, $get_css, $matches)) {
				$fonts = $matches[0];
				$get_css = str_replace($fonts, '', $get_css);
				if( preg_match_all( '/font-weight[ ]?:[ ]?[\d]{3}[ ]?;/' , $get_css, $matche_weight ) ){
					$weight = array_map( function($val){
						$process = trim( str_replace( array( 'font-weight',':',';' ) , '', $val ) );
						if( is_numeric( $process ) ){
							return $process;
						}
					}, $matche_weight[0] );
					foreach ( $fonts as $key => $val ) {
						$fonts[$key] = str_replace( "');",'', $val ).':'.implode( ',',$weight )."');";
					}
				}
				$fonts = array_unique($fonts);
				$get_css = implode('', $fonts).$get_css;
			}
		}
		return $get_css;
	}


	/**
	 * Enqueue CSS in HEAD or as a File
     * 
     * @since v.1.0.0
	 * @return NULL
	 */ 
	public function require_block_css(){
		$save_as = ultimate_post()->get_setting('css_save_as');
		$save_as = $save_as ? $save_as : '';
		if ($save_as === 'filesystem') {
			add_action('wp_enqueue_scripts', array($this, 'add_block_css_file'));
		} else {
			add_action('wp_head', array( $this, 'add_block_inline_css' ), 100);	
		}
	}

	
	/**
	 * Set CSS as File
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function add_block_css_file() {
		ultimate_post()->set_css_style( ultimate_post()->get_ID() );
	}


	/**
	 * Set Inline CSS in Head
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function add_block_inline_css(){
        $post_id = ultimate_post()->get_ID();
		if( $post_id ){ 
            $upload_dir_url = wp_get_upload_dir();
            $upload_css_dir_url = trailingslashit( $upload_dir_url['basedir'] );
			$css_dir_path = $upload_css_dir_url."ultimate-post/ultp-css-{$post_id}.css";

			// Reusable CSS
			$reusable_css = '';
			$reusable_id = ultimate_post()->reusable_id($post_id);
			foreach ( $reusable_id as $id ) {
				$reusable_dir_path = $upload_css_dir_url."ultimate-post/ultp-css-{$id}.css";
				if (file_exists( $reusable_dir_path )) {
					$reusable_css .= file_get_contents($reusable_dir_path);
				}else{
					$reusable_css .= get_post_meta($id, '_ultp_css', true);
				}
			}

			if (file_exists( $css_dir_path )) {
				echo '<style type="text/css">'.file_get_contents($css_dir_path).$reusable_css.'</style>';
			} else {
				$css = get_post_meta($post_id, '_ultp_css', true);
				if($css) {
					echo '<style type="text/css">'.$css.$reusable_css.'</style>';
				}
			}
		}
	}
}