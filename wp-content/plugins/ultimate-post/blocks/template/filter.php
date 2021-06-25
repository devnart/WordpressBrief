<?php
defined('ABSPATH') || exit;

$wraper_before .= '<div class="ultp-filter-wrap" data-taxtype='.$attr['filterType'].' data-blockid="'.$attr['blockId'].'" data-blockname="ultimate-post_'.$block_name.'" data-postid="'.$page_post_id.'">';
    $wraper_before .= ultimate_post()->filter($attr['filterText'], $attr['filterType'], $attr['filterValue'], $attr['filterCat'], $attr['filterTag']);
$wraper_before .= '</div>';