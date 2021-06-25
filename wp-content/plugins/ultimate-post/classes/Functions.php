<?php
/**
 * Common Functions.
 * 
 * @package ULTP\Functions
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Functions class.
 */

class Functions{

    /**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct(){
        $GLOBALS['ultp_settings'] = get_option('ultp_options');
    }

    /**
	 * ID for the Builder Post or Normal Post
     * 
     * @since v.2.3.1
	 * @return NUMBER | is Builder or not
	 */
    public function get_ID() {
        $id = $this->is_builder();
        return $id ? $id : get_the_ID();
    }
    
     /**
	 * Checking Statement of Archive Builder
     * 
     * @since v.2.3.1
	 * @return BOOLEAN | is Builder or not
	 */
    public function is_archive_builder() {
        return  get_post_type( get_the_ID() ) == 'ultp_builder' ? true : false;
    }


    /**
	 * Set Link with the Parameters
     * 
     * @since v.1.1.0
	 * @return STRING | URL with Arg
	 */
    public function get_premium_link( $url = 'https://www.wpxpo.com/postx/' ) {
        $affiliate_id = apply_filters( 'ultp_affiliate_id', FALSE );
        $arg = array( 'utm_source' => 'go_premium' );
        if ( ! empty( $affiliate_id ) ) {
            $arg[ 'ref' ] = esc_attr( $affiliate_id );
        }
        return add_query_arg( $arg, $url );
    }


    /**
	 * Get Width and Height of the Image
     * 
     * @since v.1.1.0
	 * @return STRING | Image Size
	 */
    public function get_size($name = ''){
        global $_wp_additional_image_sizes;
        $image_size = $name ? ( isset($_wp_additional_image_sizes[$name]) ? $_wp_additional_image_sizes[$name] : array_values($_wp_additional_image_sizes)[0] ) : array_values($_wp_additional_image_sizes)[0];
        
        return ' width="'.$image_size['width'].'" height="'.$image_size['height'].'" ';
    }


    /**
	 * Image Placeholder
     * 
     * @since v.1.1.0
	 * @return STRING | Image Placeholder
	 */
    public function img_placeholder($type = 'small') {
        switch ($type) {
            case 'small':
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG4AAABLAQMAAACr9CA9AAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABZJREFUOI1jYMADmEe5o9xR7iiXQi4A4BsA388WUyMAAAAASUVORK5CYII=';
                break;

            case 'wide':
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAKCAYAAADVTVykAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAB9JREFUeNpi/P//P8NAAiaGAQajDhh1wKgDRh0AEGAAQTcDEcKDrpMAAAAASUVORK5CYII=';
                break;

            case 'square':
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAApJREFUCJljYAAAAAIAAfRxZKYAAAAASUVORK5CYII=';
                break;

            case 'slider':
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKYAAABkCAMAAAA7drv6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAAqSURBVHja7MEBDQAAAMKg909tDjegAAAAAAAAAAAAAAAAAAAAAH5NgAEAQTwAAWZtItYAAAAASUVORK5CYII=';
                break;
            
            default:
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAYYAAADcAQMAAABOLJSDAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAACJJREFUaIHtwTEBAAAAwqD1T20ND6AAAAAAAAAAAAAA4N8AKvgAAUFIrrEAAAAASUVORK5CYII=';
                break;
        }
    }

    
    /**
	 * Quick Query
     * 
     * @since v.1.1.0
	 * @return ARRAY | Query Arg
	 */
    public function get_quick_query($prams, $args) {
        switch ($prams['queryQuick']) {
            case 'related_posts':
                global $post;
                if($post->ID){
                    $args['post__not_in'] = array($post->ID);
                }
                break;
            case 'sticky_posts':
                $args['post__in'] = get_option('sticky_posts');
                break;
            case 'latest_post_published':
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
                break;
            case 'latest_post_modified':
                $args['orderby'] = 'modified';
                $args['order'] = 'DESC';
                break;
            case 'oldest_post_published':
                $args['orderby'] = 'date';
                $args['order'] = 'ASC';
                break;
            case 'oldest_post_modified':
                $args['orderby'] = 'modified';
                $args['order'] = 'ASC';
                break;
            case 'alphabet_asc':
                $args['orderby'] = 'title';
                $args['order'] = 'ASC';
                break;
            case 'alphabet_desc':
                $args['orderby'] = 'title';
                $args['order'] = 'DESC';
                break;
            case 'random_post':
                $args['orderby'] = 'rand';
                $args['order'] = 'ASC';
                break;
            case 'random_post_7_days':
                $args['orderby'] = 'rand';
                $args['order'] = 'ASC';
                $args['date_query'] = array( array( 'after' => '1 week ago') );
                break;
            case 'random_post_30_days':
                $args['orderby'] = 'rand';
                $args['order'] = 'ASC';
                $args['date_query'] = array( array( 'after' => '1 month ago') );
                break;
            case 'most_comment':
                $args['orderby'] = 'comment_count';
                $args['order'] = 'DESC';
                break;
            case 'most_comment_1_day':
                $args['orderby'] = 'comment_count';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 day ago') );
                break;
            case 'most_comment_7_days':
                $args['orderby'] = 'comment_count';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 week ago') );
                break;
            case 'most_comment_30_days':
                $args['orderby'] = 'comment_count';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 month ago') );
                break;
            case 'popular_post_1_day_view':
                $args['meta_key'] = '__post_views_count';
                $args['orderby'] = 'meta_value meta_value_num';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 day ago') );
                break;
            case 'popular_post_7_days_view':
                $args['meta_key'] = '__post_views_count';
                $args['orderby'] = 'meta_value meta_value_num';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 week ago') );
                break;
            case 'popular_post_30_days_view':
                $args['meta_key'] = '__post_views_count';
                $args['orderby'] = 'meta_value meta_value_num';
                $args['order'] = 'DESC';
                $args['date_query'] = array( array( 'after' => '1 month ago') );
                break;
            case 'popular_post_all_times_view':
                $args['meta_key'] = '__post_views_count';
                $args['orderby'] = 'meta_value meta_value_num';
                $args['order'] = 'DESC';
                break;
            default:
                # code...
                break;
        }
        return $args;
    }


    /**
	 * Get All Reusable ID
     * 
     * @since v.1.1.0
	 * @return ARRAY | Query Arg
	 */
    public function reusable_id($post_id){
        $reusable_id = array();
        if($post_id){
            $post = get_post($post_id);
            if (has_blocks($post->post_content)) {
                $blocks = parse_blocks($post->post_content);
                foreach ($blocks as $key => $value) {
                    if(isset($value['attrs']['ref'])) {
                        $reusable_id[] = $value['attrs']['ref'];
                    }
                }
            }
        }
        return $reusable_id;
    }
    

    /**
	 * Set CSS Style
     * 
     * @since v.1.1.0
	 * @return ARRAY | Query Arg
	 */
    public function set_css_style($post_id){
        if( $post_id ){
			$upload_dir_url = wp_get_upload_dir();
			$upload_css_dir_url = trailingslashit( $upload_dir_url['basedir'] );
            $css_dir_path = $upload_css_dir_url . "ultimate-post/ultp-css-{$post_id}.css";
            
            $css_dir_url = trailingslashit( $upload_dir_url['baseurl'] );
            if (is_ssl()) {
                $css_dir_url = str_replace('http://', 'https://', $css_dir_url);
            }
                
            // Reusable CSS
			$reusable_id = ultimate_post()->reusable_id($post_id);
			foreach ( $reusable_id as $id ) {
				$reusable_dir_path = $upload_css_dir_url."ultimate-post/ultp-css-{$id}.css";
				if (file_exists( $reusable_dir_path )) {
                    $css_url = $css_dir_url . "ultimate-post/ultp-css-{$id}.css";
				    wp_enqueue_style( "ultp-post-{$id}", $css_url, array(), ULTP_VER, 'all' );
				}else{
					$css = get_post_meta($id, '_ultp_css', true);
                    if( $css ) {
                        wp_enqueue_style("ultp-post-{$id}", $css, false, ULTP_VER);
                    }
				}
            }
            
			if ( file_exists( $css_dir_path ) ) {
				$css_url = $css_dir_url . "ultimate-post/ultp-css-{$post_id}.css";
				wp_enqueue_style( "ultp-post-{$post_id}", $css_url, array(), ULTP_VER, 'all' );
			} else {
				$css = get_post_meta($post_id, '_ultp_css', true);
				if( $css ) {
					wp_enqueue_style("ultp-post-{$post_id}", $css, false, ULTP_VER);
				}
			}
		}
    }


    /**
	 * Get Global Plugin Settings
     * 
     * @since v.1.0.0
     * @param STRING | Key of the Option
	 * @return ARRAY | STRING
	 */
    public function get_setting($key = ''){
        $data = $GLOBALS['ultp_settings'];
        if ($key != '') {
            return isset($data[$key]) ? $data[$key] : '';
        } else {
            return $data;
        }
    }


    /**
	 * Set Option Settings
     * 
     * @since v.1.0.0
     * @param STRING | Key of the Option (STRING), Value (STRING)
	 * @return NULL
	 */
    public function set_setting($key = '', $val = '') {
        if($key != ''){
            $data = $GLOBALS['ultp_settings'];
            $data[$key] = $val;
            update_option('ultp_options', $data);
            $GLOBALS['ultp_settings'] = $data;
        }
    }


    /**
	 * Get Image HTML
     * 
     * @since v.1.0.0
     * @param  | URL (STRING) | size (STRING) | class (STRING) | alt (STRING) 
	 * @return STRING
	 */
    public function get_image_html($url = '', $size = 'full', $class = '', $alt = ''){
        $alt = $alt ? ' alt="'.$alt.'" ' : '';
        if( function_exists('ultimate_post_pro') ){
            $addon_enable = ultimate_post()->get_setting('addons_imageloading');
            if($addon_enable == 'true'){
                $class = $class ? ' class="ultp-lazy '.$class.'" ' : ' class="ultp-lazy" ';
                return '<img loading="lazy" loading="lazy" '.$class.$alt.' '.ultimate_post()->get_size($size).' src="'.ultimate_post()->img_placeholder($size).'" data-src="'.$url.'"/>';    
            }else{
                $class = $class ? ' class="'.$class.'" ' : '';
                return '<img loading="lazy" '.$class.$alt.' src="'.$url.'" />';
            }
        } else {
            $class = $class ? ' class="'.$class.'" ' : '';
            return '<img loading="lazy" '.$class.$alt.' src="'.$url.'" />';
        }
    }


    /**
	 * Get Image HTML
     * 
     * @since v.1.0.0
     * @param  | Attach ID (STRING) | size (STRING) | class (STRING) | alt (STRING) 
	 * @return STRING
	 */
    public function get_image($attach_id, $size = 'full', $class = '', $alt = ''){
        $alt = $alt ? ' alt="'.$alt.'" ' : '';
        $size = ( ultimate_post()->get_setting('disable_image_size') == 'yes' && strpos($size, 'ultp_layout_') !== false ) ? 'full' : $size;
        if( function_exists('ultimate_post_pro') ){
            $addon_enable = ultimate_post()->get_setting('addons_imageloading');
            if ($addon_enable == 'true') {
                $class = $class ? ' class="ultp-lazy '.$class.'" ' : ' class="ultp-lazy" ';
                return '<img loading="lazy" '.$class.$alt.' '.ultimate_post()->get_size($size).' src="'.ultimate_post()->img_placeholder($size).'" data-src="'.wp_get_attachment_image_url( $attach_id, $size ).'"/>';
            } else {
                $class = $class ? ' class="'.$class.'" ' : '';
                return '<img loading="lazy" '.$class.$alt.' src="'.wp_get_attachment_image_url( $attach_id, $size ).'" />';
            }
        } else {
            $class = $class ? ' class="'.$class.'" ' : '';
            return '<img loading="lazy" '.$class.$alt.' src="'.wp_get_attachment_image_url( $attach_id, $size ).'" />';
        }
    }

    
    /**
	 * Setup Initial Data Set
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public function init_set_data(){
        $data = get_option( 'ultp_options', array() );
        $init_data = array(
            'css_save_as'       => 'wp_head',
            'preloader_style'   => 'style1',
            'preloader_color'   => '#037fff',
            'container_width'   => '1140',
            'editor_container'  => 'full_width',
            'hide_import_btn'   => '',
            'disable_image_size'=> '',
            'ultp_templates'    => 'true',
            'ultp_elementor'    => 'true',
            'post_grid_1'       => 'yes',
            'post_grid_2'       => 'yes',
            'post_grid_3'       => 'yes',
            'post_grid_4'       => 'yes',
            'post_grid_5'       => 'yes',
            'post_grid_6'       => 'yes',
            'post_grid_7'       => 'yes',
            'post_list_1'       => 'yes',
            'post_list_2'       => 'yes',
            'post_list_3'       => 'yes',
            'post_list_4'       => 'yes',
            'post_module_1'     => 'yes',
            'post_module_2'     => 'yes',
            'post_slider_1'     => 'yes',
            'heading'           => 'yes',
            'image'             => 'yes',
            'taxonomy'          => 'yes',
            'wrapper'           => 'yes'
        );
        if (empty($data)) {
            update_option('ultp_options', $init_data);
            $GLOBALS['ultp_settings'] = $init_data;
        } else {
            foreach ($init_data as $key => $single) {
                if (!isset($data[$key])) {
                    $data[$key] = $single;
                }
            }
            update_option('ultp_options', $data);
            $GLOBALS['ultp_settings'] = $data;
        }
    }

    
    /**
	 * Get Excerpt Text
     * 
     * @since v.1.0.0
     * @param  | Post ID (STRING) | Limit (NUMBER)
	 * @return STRING
	 */
    public function excerpt( $post_id, $limit = 55 ) {
        return apply_filters( 'the_excerpt', wp_trim_words( get_the_content( $post_id ) , $limit ) );
    }

    public function get_builder_attr() {
        $builder_data = '';
        if (is_archive()) {
            if (is_date()) {
                if ( is_year() ) {
                    $builder_data = 'date###'.get_the_date('Y');
                } else if ( is_month() ) {
                    $builder_data = 'date###'.get_the_date('Y-n');
                } else if ( is_day() ) {
                    $builder_data = 'date###'.get_the_date('Y-n-j');
                }
            } else if (is_author()) {
                $builder_data = 'author###'.get_the_author_meta('ID');
            } else {
                $obj = get_queried_object();
                if (isset($obj->taxonomy)) {
                    $builder_data = 'taxonomy###'.$obj->taxonomy.'###'.$obj->slug;
                }
            }
        } else if (is_search()) {
            $builder_data = 'search###'.get_search_query(true);
        }
        return $builder_data ? 'data-builder="'.$builder_data.'"' : '';
    }


    public function is_builder($builder = '') {
        $id = '';
        if (function_exists('ultimate_post_pro')) {
            if ($builder) { 
                return true; 
            }
            $page_id = ultimate_post_pro()->conditions('return');
            if ($page_id && ultimate_post()->get_setting('ultp_builder')) {
                $id = $page_id;
            }
        }
        return $id;
    }

    /**
	 * Query Builder 
     * 
     * @since v.1.0.0
     * @param ARRAY | Attribute of the Query
	 * @return ARRAY
	 */
    public function get_query($attr) {
        $archive_query = array();
        $builder = isset($attr['builder']) ? $attr['builder'] : '';
        if ($this->is_builder($builder)) {
            if ($builder) {
                $str = explode('###', $builder);
                if (isset($str[0])) {
                    if ($str[0] == 'taxonomy') {
                        if (isset($str[1]) && isset($str[2])) {
                            $archive_query['tax_query'] = array(
                                array(
                                    'taxonomy' => $str[1],
                                    'field' => 'slug',
                                    'terms' => $str[2]
                                )
                            );
                        }
                    } else if ($str[0] == 'author') {
                        if (isset($str[1])) {
                            $archive_query['author'] = $str[1];
                        }
                    } else if ($str[0] == 'search') {
                        if (isset($str[1])) {
                            $archive_query['s'] = $str[1];
                        }
                    } else if ($str[0] == 'date') {
                        if (isset($str[1])) {
                            $all_date = explode('-', $str[1]);
                            if (!empty($all_date)) {
                                $arg = array();
                                if (isset($all_date[0])) { $arg['year'] = $all_date[0]; }
                                if (isset($all_date[1])) { $arg['month'] = $all_date[1]; }
                                if (isset($all_date[2])) { $arg['day'] = $all_date[2]; }
                                $archive_query['date_query'][] = $arg;
                            }
                        }
                    }
                }
            } else {
                global $wp_query;
                $archive_query = $wp_query->query_vars;
            }
            $archive_query['posts_per_page'] = isset($attr['queryNumber']) ? $attr['queryNumber'] : 3;
            $archive_query['paged'] = isset($attr['paged']) ? $attr['paged'] : 1;
            if (isset($attr['queryOffset']) && $attr['queryOffset'] ) {
                $offset = $this->get_offset($attr['queryOffset'], $archive_query);
                $archive_query = array_merge($archive_query, $offset);
            }
            return $archive_query;
        }

        $query_args = array(
            'posts_per_page'    => isset($attr['queryNumber']) ? $attr['queryNumber'] : 3,
            'post_type'         => isset($attr['queryType']) ? $attr['queryType'] : 'post',
            'orderby'           => isset($attr['queryOrderBy']) ? $attr['queryOrderBy'] : 'date',
            'order'             => isset($attr['queryOrder']) ? $attr['queryOrder'] : 'desc',
            'paged'             => isset($attr['paged']) ? $attr['paged'] : 1,
            'post_status'       => 'publish'
        );

        if(isset($attr['queryOrderBy']) && isset($attr['metaKey'])){
            if($attr['queryOrderBy'] == 'meta_value_num') {
                $query_args['meta_key'] = $attr['metaKey'];
            }
        }

        if(isset($attr['queryInclude']) && $attr['queryInclude']){
            $query_args['post__in'] = explode(',', $attr['queryInclude']);
            $query_args['ignore_sticky_posts'] = 1;
            $query_args['orderby'] = 'post__in';
        }

        $exclude = '';
        if (is_single()) {
            $id = get_the_ID();
            $exclude = $id ? $id : '';
        }
        if(isset($attr['queryExclude']) && $attr['queryExclude']) {
            $exclude = ($exclude ? $exclude.',' : '') . $attr['queryExclude'];
        }
        if ($exclude) {
            $query_args['post__not_in'] = explode(',', $exclude);
        }

        if(isset($attr['queryTax'])){
            if(isset($attr['queryTaxValue'])){

                $tax_value = (strlen($attr['queryTaxValue']) > 2) ? $attr['queryTaxValue'] : ($attr['queryTax'] == 'category' ? $attr['queryCat'] : $attr['queryTag']);

                if(strlen($tax_value) > 2){
                    $var = array('relation'=>'OR');
                    foreach (json_decode($tax_value) as $val) {
                        $tax_name = $attr['queryTax'] == 'tag' ? 'post_tag' : $attr['queryTax']; // for compatibility
                        $var[] = array('taxonomy'=> $tax_name, 'field' => 'slug', 'terms' => $val );
                    }
                    if(count($var) > 1){
                        $query_args['tax_query'] = $var;
                    }
                }
            }
        }

        if(isset($attr['queryQuick'])){
            if($attr['queryQuick'] != ''){
                $query_args = ultimate_post()->get_quick_query($attr, $query_args);
            }
        }

        if (isset($attr['queryOffset']) && $attr['queryOffset'] ) {
            $offset = $this->get_offset($attr['queryOffset'], $query_args);
            $query_args = array_merge($query_args, $offset);
        }

        $query_args['wpnonce'] = wp_create_nonce( 'ultp-nonce' );
        
        return $query_args;
    }

    function get_offset($queryOffset, $query_args) {
        $query = array();
        if ($query_args['paged'] > 1) {
            $offset_post = wp_get_recent_posts($query_args, OBJECT);
            if ( count($offset_post) > 0 ) {
                $offset = array();
                for($x = count($offset_post); $x > count($offset_post) - $queryOffset; $x--){
                    $offset[] = $offset_post[$x-1]->ID;
                }
                $query['post__not_in'] = $offset;
            }
        } else {
            $query['offset'] = isset($queryOffset) ? $queryOffset : 0;
        }
        return $query;
    }


    /**
	 * Get Page Number
     * 
     * @since v.1.0.0
     * @param | Attribute of the Query(ARRAY) | Post Number(ARRAY)
	 * @return ARRAY
	 */
    public function get_page_number($attr, $post_number) {
        if($post_number > 0){
            $post_per_page = isset($attr['queryNumber']) ? ($attr['queryNumber'] ? $attr['queryNumber'] : 1) : 3;
            $pages = ceil($post_number/$post_per_page);
            return $pages ? $pages : 1;
        }else{
            return 1;
        }
    }


    /**
	 * Get Image Size
     * 
     * @since v.1.0.0
     * @param | Attribute of the Query(ARRAY) | Post Number(ARRAY)
	 * @return ARRAY
	 */
    public function get_image_size() {
        $sizes = get_intermediate_image_sizes();
        $filter = array('full' => 'Full');
        foreach ($sizes as $value) {
            $filter[$value] = ucwords(str_replace(array('_', '-'), array(' ', ' '), $value));
        }
        return $filter;
    }


    /**
	 * Get All PostType Registered
     * 
     * @since v.1.0.0
     * @param | Attribute of the Query(ARRAY) | Post Number(ARRAY)
	 * @return ARRAY
	 */
    public function get_post_type() {
        $post_type = get_post_types( '', 'names' );
        return array_diff($post_type, array( 'attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'oembed_cache', 'user_request', 'wp_block' ));
    }


    /**
	 * Get Pagination HTML
     * 
     * @since v.1.0.0
     * @param | pages (NUMBER) | Pagination Nav (STRING) | Pagination Text |
	 * @return STRING
	 */
    public function pagination($pages = '', $paginationNav = '', $paginationText = '') {
        $html = '';
        $showitems = 3;
        $paged = is_front_page() ? get_query_var('page') : get_query_var('paged');
        $paged = $paged ? $paged : 1;
        if($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages) {
                $pages = 1;
            }
        }
        $data = ($paged>=3?[($paged-1),$paged,$paged+1]:[1,2,3]);

        $paginationText = explode('|', $paginationText);

        $prev_text = isset($paginationText[0]) ? $paginationText[0] : __("Previous", "ultimate-post");
        $next_text = isset($paginationText[1]) ? $paginationText[1] : __("Next", "ultimate-post");
 
        if(1 != $pages) {
            $html .= '<ul class="ultp-pagination">';            
                $display_none = 'style="display:none"';
                if($pages > 4) {
                    $html .= '<li class="ultp-prev-page-numbers" '.($paged==1?$display_none:"").'><a href="'.get_pagenum_link($paged-1).'">'.ultimate_post()->svg_icon('leftAngle2').' '.($paginationNav == 'textArrow' ? $prev_text : "").'</a></li>';
                }
                if($pages > 4){
                    $html .= '<li class="ultp-first-pages" '.($paged<2?$display_none:"").' data-current="1"><a href="'.get_pagenum_link(1).'">1</a></li>';
                }
                if($pages > 4){
                    $html .= '<li class="ultp-first-dot" '.($paged<2? $display_none : "").'><a href="#">...</a></li>';
                }
                foreach ($data as $i) {
                    if($pages >= $i){
                        $html .= ($paged == $i) ? '<li class="ultp-center-item pagination-active" data-current="'.$i.'"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>':'<li class="ultp-center-item" data-current="'.$i.'"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                    }
                }
                if($pages > 4){
                    $html .= '<li class="ultp-last-dot" '.($pages<=$paged+1?$display_none:"").'><a href="#">...</a></li>';
                }
                if($pages > 4){
                    $html .= '<li class="ultp-last-pages" '.($pages<=$paged+1?$display_none:"").' data-current="'.$pages.'"><a href="'.get_pagenum_link($pages).'">'.$pages.'</a></li>';
                }
                if ($paged != $pages) {
                    $html .= '<li class="ultp-next-page-numbers"><a href="'.get_pagenum_link($paged + 1).'">'.($paginationNav == 'textArrow' ? $next_text : "").ultimate_post()->svg_icon('rightAngle2').'</a></li>';
                }
            $html .= '</ul>';
        }
        return $html;
    }


    /**
	 * Get Excerpt Word
     * 
     * @since v.1.0.0
     * @param NUMBER | Character Length
	 * @return STRING
	 */
    public function excerpt_word($charlength = 200) {
        $html = '';
        $charlength++;
        $excerpt = get_the_excerpt();
        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                $html = mb_substr( $subex, 0, $excut );
            } else {
                $html = $subex;
            }
            $html .= '...';
        } else {
            $html = $excerpt;
        }
        return $html;
    }


    /**
	 * Get Taxonomy Lists
     * 
     * @since v.1.0.0
     * @param STRING | Taxonomy Slug
	 * @return ARRAY
	 */
    public function taxonomy( $prams = 'category' ) {
        $data = array();
        $terms = get_terms( $prams, array(
           'hide_empty' => false,
        ));
        if( !is_wp_error($terms) ){
            foreach ($terms as $val) {
                $data[urldecode_deep($val->slug)] = $val->name;
            }
        }
        return $data;
    }


    /**
	 * Get Taxonomy Data Lists
     * 
     * @since v.1.0.0
     * @param OBJECT | Taxonomy Object
	 * @return ARRAY
	 */
    public function get_tax_data($terms) {
        $temp = array();
        $image = '';
        $thumbnail_id = get_term_meta( $terms->term_id, 'ultp_category_image', true ); 
        if( $thumbnail_id ){
            $image = wp_get_attachment_url( $thumbnail_id ); 
        }
        $temp['url'] = get_term_link($terms);
        $temp['name'] = $terms->name;
        $temp['desc'] = $terms->description;
        $temp['count'] = $terms->count;
        $temp['image'] = $image;
        $color = get_term_meta($terms->term_id, 'ultp_category_color', true);
        $temp['color'] = $color == 1 ? '#037fff' : $color;
        return $temp;
    }

    public function get_category_data($catSlug, $number = 40, $type = '', $tax_slug = 'category') {
        $data = array();
        if($type == 'child'){
            $image = '';
            if (!empty($catSlug)) {
                foreach ($catSlug as $cat) {
                    $parent_term = get_term_by('slug', $cat, $tax_slug);
                    if (!empty($parent_term)) {
                        $term_data = get_terms($tax_slug, array( 
                            'hide_empty' => true,
                            'parent' => $parent_term->term_id
                        ));
                        if (!empty($term_data)) {
                            foreach ($term_data as $terms) {
                                $data[] = $this->get_tax_data($terms);
                            }
                        }
                    }
                }
            }
        } else if ($type == 'parent') {
            $term_data = get_terms( $tax_slug, array( 'hide_empty' => true, 'number' => $number, 'parent' => 0 ) );
            if (!empty($term_data)) {
                foreach ($term_data as $terms) {
                    $data[] = $this->get_tax_data($terms);
                }
            }
        } else if ($type == 'custom') {
            foreach ($catSlug as $cat) {
                $terms = get_term_by('slug', $cat, $tax_slug);
                if (!empty($terms)) {
                    $data[] = $this->get_tax_data($terms);
                }
            }
        } else {
            $term_data = get_terms($tax_slug, array('hide_empty' => true, 'number' => $number));
            if (!empty($term_data)) {
                foreach ($term_data as $terms) {
                    $data[] = $this->get_tax_data($terms);
                }
            }
        }
        return $data;
    }


    /**
	 * Get Next Previous HTML
     * 
     * @since v.1.0.0
     * @param OBJECT | Taxonomy Object
	 * @return STRING
	 */
    public function next_prev() {
        $html = '';
        $html .= '<ul>';
            $html .= '<li>';
                $html .= '<a class="ultp-prev-action ultp-disable" href="#">';
                    $html .= ultimate_post()->svg_icon('leftAngle2').'<span class="screen-reader-text">'.__("Previous", "ultimate-post").'</span>';
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li>';
                $html .= '<a class="ultp-next-action">';
                    $html .= ultimate_post()->svg_icon('rightAngle2').'<span class="screen-reader-text">'.__("Next", "ultimate-post").'</span>';
                $html .= '</a>';
            $html .= '</li>';
        $html .= '</ul>';
        return $html;
    }


    /**
	 * Get Loading HTML
     * 
     * @since v.1.0.0
     * @param NULL
	 * @return STRING
	 */
    public function loading(){
        $html = '';
        $style = ultimate_post()->get_setting('preloader_style');
        if( $style == 'style2' ){
            $html .= '<div class="ultp-loading-spinner" style="width:100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';//ultp-block-items-wrap
        } else {
            $html .= '<div class="ultp-loading-blocks" style="width:100%;height:100%;"><div style="left: 0;top: 0;animation-delay:0s;"></div><div style="left: 21px;top: 0;animation-delay:0.125s;"></div><div style="left: 42px;top: 0;animation-delay:0.25s;"></div><div style="left: 0;top: 21px;animation-delay:0.875s;"></div><div style="left: 42px;top: 21px;animation-delay:0.375s;"></div><div style="left: 0;top: 42px;animation-delay:0.75s;"></div><div style="left: 42px;top: 42px;animation-delay:0.625s;"></div><div style="left: 21px;top: 42px;animation-delay:0.5s;"></div></div>';
        }
        return '<div class="ultp-loading">'.$html.'</div>';
    }


    /**
	 * Get Filter HTML
     * 
     * @since v.1.0.0
     * @param | Filter Text (STRING) | Filter Type (STRING) | Filter Value (ARRAY) | Filter Cat (ARRAY) | Filter Tag (ARRAY) |
	 * @return STRING
	 */
    public function filter($filterText = '', $filterType = '', $filterValue = '[]', $filterCat = [], $filterTag = []){
        $html = '';
        $html .= '<ul class="ultp-flex-menu">';
            
            $filterType = $filterType == 'tag' ? 'post_tag' : $filterType; // for compatibility
            
            $cat = $this->taxonomy($filterType);
            if($filterText){
                $html .= '<li class="filter-item"><a data-taxonomy="" href="#">'.$filterText.'</a></li>';
            }

            $filterValue = strlen($filterValue) > 2 ? $filterValue : ($filterType == 'category' ? $filterCat : $filterTag); 

            foreach (json_decode($filterValue) as $val) {
                $html .= '<li class="filter-item"><a data-taxonomy="'.$val.'" href="#">'.(isset($cat[$val]) ? $cat[$val] : $val).'</a></li>';
            }
        $html .= '</ul>';
        return $html;
    }


    /**
	 * Check License Status
     * 
     * @since v.2.4.2
	 * @return BOOLEAN | Is pro license active or not
	 */
    public function is_lc_active() {
        if (function_exists('ultimate_post_pro')) {
            return get_option('edd_ultp_license_status') == 'valid' ? true : false;
        }
        if (get_transient( 'ulpt_theme_enable' ) == 'integration') {
            return true;
        }
        return false;
    }


    /**
	 * Get SVG Icon
     * 
     * @since v.1.0.0
     * @param STRING | Icon Key
	 * @return STRING | Icon SVG
	 */
    public function svg_icon($icons = ''){
        $icon_lists = array(
            'eye' 			=> file_get_contents(ULTP_PATH.'assets/img/svg/eye.svg'),
            'user' 			=> file_get_contents(ULTP_PATH.'assets/img/svg/user.svg'),
            'calendar'      => file_get_contents(ULTP_PATH.'assets/img/svg/calendar.svg'),
            'comment'       => file_get_contents(ULTP_PATH.'assets/img/svg/comment.svg'),
            'book'  		=> file_get_contents(ULTP_PATH.'assets/img/svg/book.svg'),
            'tag'           => file_get_contents(ULTP_PATH.'assets/img/svg/tag.svg'),
            'clock'         => file_get_contents(ULTP_PATH.'assets/img/svg/clock.svg'),
            'leftAngle'     => file_get_contents(ULTP_PATH.'assets/img/svg/leftAngle.svg'),
            'rightAngle'    => file_get_contents(ULTP_PATH.'assets/img/svg/rightAngle.svg'),
            'leftAngle2'    => file_get_contents(ULTP_PATH.'assets/img/svg/leftAngle2.svg'),
            'rightAngle2'   => file_get_contents(ULTP_PATH.'assets/img/svg/rightAngle2.svg'),
            'leftArrowLg'   => file_get_contents(ULTP_PATH.'assets/img/svg/leftArrowLg.svg'),
            'refresh'       => file_get_contents(ULTP_PATH.'assets/img/svg/refresh.svg'),
            'rightArrowLg'  => file_get_contents(ULTP_PATH.'assets/img/svg/rightArrowLg.svg'),
        ); 
        if($icons){
            return $icon_lists[ $icons ];
        }
    }
    
}
