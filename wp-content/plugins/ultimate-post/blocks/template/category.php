<?php
defined('ABSPATH') || exit;

$category       = '';
if ($attr['catShow']) {
    $category .= '<div class="ultp-category-grid ultp-category-'.$attr['catStyle'].' ultp-category-'.$attr['catPosition'].'">';
        $category .= '<div class="ultp-category-in'.($attr['customCatColor'] ? ' ultp-cat-color-'.$attr['customCatColor'] : '').'">';
            $cat = get_the_terms($post_id, 'category');
            if (!empty($cat)) {
                foreach ($cat as $val) {
                    $color = '';
                    if (isset($attr['customCatColor'])){
                        if ($attr['customCatColor']){
                            $color = get_term_meta($val->term_id, 'ultp_category_color', true);
                            if(isset($attr['onlyCatColor'])){
                                if($attr['onlyCatColor']){
                                    $color = 'style="color: '.($color ? $color : '#CE2746').'"';
                                }else{
                                    $color = 'style="background-color: '.($color ? $color : '#CE2746').';color: #fff;"';
                                }
                            }else{
                                $color = 'style="background-color: '.($color ? $color : '#CE2746').';color: #fff;"';                           
                            }
                        }
                    }
                    if($attr['onlyCatColor']){
                        $category .= '<a class="ultp-cat-'.$val->slug.'" href="'.get_term_link($val->term_id).'" '.$color.' '.($attr['openInTab'] ? 'target="_blank"' : '').'>'.$val->name.'</a>';
                    } else {
                        $category .= '<a class="ultp-cat-'.$val->slug.( $attr['customCatColor'] ? ' ultp-cat-only-color-'.$attr['customCatColor'] : '').'" href="'.get_term_link($val->term_id).'" '.$color.' '.($attr['openInTab'] ? 'target="_blank"' : '').'>'.$val->name.'</a>';
                    }
                }
            }
        $category .= '</div>';
    $category .= '</div>';
}