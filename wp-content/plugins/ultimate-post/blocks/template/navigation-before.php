<?php
defined('ABSPATH') || exit;

$wraper_before .= '<div class="ultp-next-prev-wrap" data-pages="'.$pageNum.'" data-pagenum="1" data-blockid="'.$attr['blockId'].'" data-blockname="ultimate-post_'.$block_name.'" data-postid="'.$page_post_id.'" '.ultimate_post()->get_builder_attr().'>';
    $wraper_before .= ultimate_post()->next_prev();
$wraper_before .= '</div>';