<?php
defined('ABSPATH') || exit;

global $post;
$post_id        = get_the_ID();
$title          = get_the_title( $post_id );
$titlelink      = get_permalink( $post_id );
$post_thumb_id  = get_post_thumbnail_id( $post_id );
$user_id        = $post->post_author;
$author_link    = get_author_posts_url( $user_id );
$display_name   = get_the_author_meta('display_name');
$time           = get_the_date();
$timeModified   = get_the_modified_date();
$comment        = get_comments_number();
$view           = get_post_meta(get_the_ID(),'__post_views_count', true);
$post_time      = human_time_diff(get_the_time('U'),current_time('U'));
$reading_time   = ceil(mb_strlen(strip_tags(get_the_content()))/1200).__(' min read', 'ultimate-post');