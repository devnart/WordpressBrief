<?php
defined('ABSPATH') || exit;

if ($attr['headingShow']) {
    $wraper_before .= '<div class="ultp-heading-wrap ultp-heading-'.$attr["headingStyle"].' ultp-heading-'.$attr["headingAlign"].'">';
        if ($attr['headingURL']) {
            $wraper_before .= '<'.$attr['headingTag'].' class="ultp-heading-inner"><a href="'.$attr["headingURL"].'"><span>'.$attr["headingText"].'</span></a></'.$attr['headingTag'].'>';
        } else {
            $wraper_before .= '<'.$attr['headingTag'].' class="ultp-heading-inner"><span>'.$attr["headingText"].'</span></'.$attr['headingTag'].'>';
        }
        if ($attr['headingStyle'] == 'style11' && $attr['headingURL'] && $attr['headingBtnText']) {
            $wraper_before .= '<a class="ultp-heading-btn" href="'.$attr['headingURL'].'">'.$attr["headingBtnText"].ultimate_post()->svg_icon('rightAngle2').'</a>';
        }
        if ($attr['subHeadingShow']) {
            $wraper_before .= '<div class="ultp-sub-heading"><div class="ultp-sub-heading-inner">'.$attr['subHeadingText'].'</div></div>';
        }
    $wraper_before .= '</div>';
}