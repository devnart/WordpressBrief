<?php
/**
 * REST API Action.
 * 
 * @package ULTP\REST_API
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Styles class.
 */
class REST_API{
    
    /**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct() {
        add_action( 'rest_api_init', array($this, 'ultp_register_route') );
    }


    /**
	 * REST API Action
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public function ultp_register_route() {
        register_rest_route( 'ultp', 'posts', array(
                'methods' => \WP_REST_Server::READABLE,
                'args' => array('post_type' => [], 'taxonomy' => [], 'include' => [], 'exclude' => [], 'order' => [], 'orderby' => [], 'count' => [], 'size' => [], 'tag' => [], 'cat' => [], 'meta_key' => [], 'queryQuick' => [], 'wpnonce' => []),
                'callback' => array($this,'ultp_route_post_data'),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route( 'ultp', 'taxonomy', array(
                'methods' => \WP_REST_Server::READABLE,
                'args' => array('wpnonce' => []),
                'callback' => array($this,'ultp_route_taxonomy_data'),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route( 'ultp', 'imagesize', array(
                'methods' => \WP_REST_Server::READABLE,
                'args' => array('taxonomy' => [], 'wpnonce' => []),
                'callback' => array($this,'ultp_route_imagesize_data'),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route( 'ultp', 'posttype', array(
                'methods' => \WP_REST_Server::READABLE,
                'args' => array('wpnonce' => []),
                'callback' => array($this,'ultp_route_posttype_data'),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route( 'ultp', 'specific_taxonomy', array(
                'methods' => \WP_REST_Server::READABLE,
                'args' => array('taxType' => [], 'taxSlug' => [], 'taxValue' => [], 'queryNumber' => [], 'wpnonce' => []),
                'callback' => array($this,'ultp_route_taxonomy_info_data'),
                'permission_callback' => '__return_true'
            )
        );
    }

    /**
	 * REST API Action
     * 
     * @since v.1.0.0
     * @param ARRAY | Parameters of the REST API
	 * @return ARRAY | Response as Array
	 */
    public function ultp_route_posttype_data() {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-nonce') && $local){
            return ;
        }
        return ultimate_post()->get_post_type();
    }

    /**
	 * Image Size Data
     * 
     * @since v.1.0.0
     * @param NULL
	 * @return ARRAY | Response Image Size as Array
	 */
    public function ultp_route_imagesize_data() {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-nonce') && $local){
            return ;
        }
        return ultimate_post()->get_image_size();
    }

    /**
	 * Post Data Response of REST API
     * 
     * @since v.1.0.0
     * @param MIXED | Pram (ARRAY), Local (BOOLEAN)
	 * @return ARRAY | Response Image Size as Array
	 */
    public function ultp_route_post_data($prams,$local=false) {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-nonce') && $local){
            return ;
        }

        // Query Builder
        $args = array(
            'post_type'     => 'post',
            'orderby'       => 'date',
            'post_status'   => 'publish',
            'order'         => 'DESC',
        );

        if(isset($prams['count'])){ $args['posts_per_page'] = esc_attr($prams['count']); }
        if(isset($prams['post_type'])){ $args['post_type'] = esc_attr( $prams['post_type'] ); }

        if(isset($prams['taxonomy'])){ // taxonomy  slug__val__slug__val
            $tax_arr = array('relation' => 'OR');
            $tax = explode('__', esc_attr($prams['taxonomy']));
            if(!empty($tax)){
                for($i=0; $i < count($tax) ; $i++){
                    if($i%2 == 0){
                        $tax_arr[] = array('taxonomy'=>$tax[$i], 'field' => 'slug', 'terms' => array($tax[$i+1]));
                    }
                }
            }
            if(!empty($tax_arr)){
                $args['tax_query'] = $tax_arr;
            }
        }

        if(isset($prams['exclude'])){ $args['post__not_in'] = explode('__', esc_attr($prams['exclude'])); }
        if(isset($prams['orderby'])){ $args['orderby'] = esc_attr($prams['orderby']); }
        if(isset($prams['order'])){ $args['order'] = esc_attr($prams['order']); }
        if(isset($prams['offset'])){ $args['offset'] = esc_attr($prams['offset']); }
        if(isset($prams['paged'])){ $args['paged'] = esc_attr($prams['paged']); }

        if(isset($prams['orderby']) && isset($prams['meta_key'])){
            if($prams['orderby'] == 'meta_value_num') {
                $args['meta_key'] = $prams['meta_key'];
                $args['meta_type'] = 'NUMERIC';
            }
        }

        if(isset($prams['queryQuick'])){
            if($prams['queryQuick'] != ''){
                $args = ultimate_post()->get_quick_query($prams, $args);
            }
        }

        if(isset($prams['include'])){ 
            $args['post__in'] = explode('__', esc_attr($prams['include'])); 
            $args['ignore_sticky_posts'] = 1;
            $args['orderby'] = 'post__in';
        }
        
        $data = [];
        $loop = new \WP_Query($args);
        
        if($loop->have_posts()){
            while($loop->have_posts()) {
                $loop->the_post(); 
                $var                = array();
                $post_id            = get_the_ID();
                $user_id            = get_the_author_meta('ID');
                $content_data       = get_the_content();
                $var['ID']          = $post_id;
                $var['title']       = get_the_title();
                $var['permalink']   = get_permalink();
                $var['excerpt']     = strip_tags($content_data);
                $var['excerpt_full']= strip_tags(get_the_excerpt());
                $var['time']        = get_the_date();
                $var['timeModified']= get_the_modified_date();
                $var['post_time']   = human_time_diff(get_the_time('U'),current_time('U'));
                $var['view']        = get_post_meta(get_the_ID(),'__post_views_count', true);
                $var['comments']    = get_comments_number();
                $var['author_link'] = get_author_posts_url($user_id);
                $var['avatar_url']  = get_avatar_url($user_id);
                $var['display_name']= get_the_author_meta('display_name');
                $var['reading_time']= ceil(strlen($content_data)/1200).__(' min read', 'ultimate-post');
                
                // image
                if( has_post_thumbnail() ){
                    $thumb_id = get_post_thumbnail_id($post_id);
                    $image_sizes = ultimate_post()->get_image_size();
                    $image_src = array();
                    foreach ($image_sizes as $key => $value) {
                        $image_src[$key] = wp_get_attachment_image_src($thumb_id, $key, false)[0];
                    }
                    $var['image'] = $image_src;
                }

                // tag
                $tag = get_the_terms($post_id, (isset($prams['tag'])?esc_attr($prams['tag']):'post_tag'));
                if(!empty($tag)){
                    $v = array();
                    foreach ($tag as $val) {
                        $v[] = array('slug' => $val->slug, 'name' => $val->name, 'url' => get_term_link($val->term_id));
                    }
                    $var['tag'] = $v;
                }

                // cat
                $cat = get_the_terms($post_id, (isset($prams['cat'])?esc_attr($prams['cat']):'category'));
                if(!empty($cat)){
                    $v = array();
                    foreach ($cat as $val) {
                        $v[] = array('slug' => $val->slug, 'name' => $val->name, 'url' => get_term_link($val->term_id), 'color' => get_term_meta($val->term_id, 'ultp_category_color', true));
                    }
                    $var['category'] = $v;
                }
                $data[] = $var;
            }
            wp_reset_postdata();
        }

        return rest_ensure_response( $data );
    }


    /**
	 * Taxonomy Data Response of REST API
     * 
     * @since v.1.0.0
     * @param ARRAY | Parameter (ARRAY)
	 * @return ARRAY | Response Taxonomy List as Array
	 */
    public function ultp_route_taxonomy_data($prams) {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-nonce')){
            return rest_ensure_response([]);
        }
        
        $all_post_type = ultimate_post()->get_post_type();
        $data = array();
        foreach ($all_post_type as $post_type_slug => $post_type ) {
            $data_term = array();
            $taxonomies = get_object_taxonomies($post_type_slug);
            foreach ($taxonomies as $key => $taxonomy_slug) {
                $taxonomy_value = get_terms(array(
                    'taxonomy' => $taxonomy_slug,
                    'hide_empty' => false
                ));
                if (!is_wp_error($taxonomy_value)) {
                    $data_tax = array();
                    foreach ($taxonomy_value as $k => $taxonomy) {
                        $data_tax[urldecode_deep($taxonomy->slug)] = $taxonomy->name;
                    }
                    $data_term[$taxonomy_slug] = $data_tax;
                }
            }
            $data[$post_type_slug] = $data_term;
        }
        return rest_ensure_response($data);
    }

    /**
	 * Specific Taxonomy Data Response of REST API
     * 
     * @since v.1.0.0
     * @param ARRAY | Parameter (ARRAY)
	 * @return ARRAY | Response Taxonomy List as Array
	 */
    public function ultp_route_taxonomy_info_data($prams) {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-nonce')) {
            return rest_ensure_response([]);
        }

        return rest_ensure_response( ultimate_post()->get_category_data(json_decode($prams['taxValue']), $prams['queryNumber'], $prams['taxType'], $prams['taxSlug']) );
    }
}