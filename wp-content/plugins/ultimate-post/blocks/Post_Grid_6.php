<?php
namespace ULTP\blocks;

defined('ABSPATH') || exit;

class Post_Grid_6{

    public function __construct() {
        add_action('init', array($this, 'register'));
    }

    public function get_attributes($default = false){

        $attributes = array(
            'blockId' => [
                'type' => 'string',
                'default' => '',
            ],

            //--------------------------
            //      Layout
            //--------------------------
            'layout' => [
                'type' => 'string',
                'default' => 'layout1',
            ],

            //--------------------------
            //      Query Setting
            //--------------------------
            'queryQuick' => [
                'type' => 'string',
                'default' =>'',
            ],
            'queryNumber' => [
                'type' => 'string',
                'default' => 5,
            ],
            'queryType' => [
                'type' => 'string',
                'default' => 'post'
            ],
            'queryTax' => [
                'type' => 'string',
                'default' => 'category'
            ],
            'queryTaxValue' => [
                'type' => 'string',
                'default' => '[]',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'queryTax','condition' => '!=','value' => '']]
                    ],
                ],
            ],
            'queryCat' => [ // for compatibility
                'type' => 'string',
                'default' => '[]'
            ],
            'queryTag' => [ // for compatibility
                'type' => 'string',
                'default' => '[]'
            ],
            'queryOrderBy' => [
                'type' => 'string',
                'default' => 'date',
            ],
            'metaKey' => [
                'type' => 'string',
                'default' => 'custom_meta_key',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'queryOrderBy','condition' => '==','value' => 'meta_value_num']]
                    ],
                ],
            ],
            'queryOrder' => [
                'type' => 'string',
                'default' => 'desc',
            ],
            'queryInclude' => [
                'type' => 'string',
                'default' => ''
            ],
            'queryExclude' => [
                'type' => 'string',
                'default' => ''
            ],
            'queryOffset' => [
                'type' => 'string',
                'default' => '0',
            ],
            //--------------------------
            //      General Setting
            //--------------------------
            'contentAlign' => [
                'type' => 'string',
                'default' => "left",
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'left'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content { text-align:{{contentAlign}}; } {{ULTP}} .ultp-block-meta {justify-content: flex-start;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'center'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content { text-align:{{contentAlign}}; } {{ULTP}} .ultp-block-meta {justify-content: center;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content { text-align:{{contentAlign}}; } {{ULTP}} .ultp-block-meta {justify-content: flex-end;} .rtl {{ULTP}} .ultp-block-meta {justify-content: start;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'  .rtl {{ULTP}} .ultp-block-items-wrap .ultp-block-item .ultp-block-readmore a {display:flex; flex-direction:row-reverse;justify-content: flex-end;}'
                    ],
                ],
            ],
            'columnGridGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'5', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}}.wp-block-ultimate-post-post-grid-6 .ultp-block-row.ultp-layout1 .ultp-block-item:first-child .ultp-block-content-overlay, {{ULTP}}.wp-block-ultimate-post-post-grid-6 .ultp-block-row.ultp-layout2 .ultp-block-item:first-child .ultp-block-content-overlay { height: calc(100% + {{columnGridGap}}); } {{ULTP}} .ultp-block-row { grid-row-gap: {{columnGridGap}}; } {{ULTP}} .ultp-block-row {grid-column-gap: {{columnGridGap}}; }'
                    ],
                ],
            ],
            'overlayHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'500', 'unit' =>'px'],
                'style' => [
                    (object)[ 
                        'selector'=>'{{ULTP}} .ultp-block-row.ultp-layout2 .ultp-block-item .ultp-block-content-overlay, {{ULTP}} .ultp-block-row.ultp-layout1 .ultp-block-item .ultp-block-content-overlay {height: calc({{overlayHeight}}/2);} {{ULTP}} .ultp-block-row.ultp-layout1 .ultp-block-item:first-child, {{ULTP}} .ultp-block-row.ultp-layout2 .ultp-block-item:first-child {max-height: {{overlayHeight}};} {{ULTP}} .ultp-block-row {max-height: {{overlayHeight}};} {{ULTP}} .ultp-block-item .ultp-block-image img, {{ULTP}} .ultp-block-item .ultp-block-empty-image, {{ULTP}} .ultp-block-row .ultp-block-item:first-child .ultp-block-image img, {{ULTP}} .ultp-block-row .ultp-block-item:first-child .ultp-block-empty-image {width: 100%; object-fit: cover; height: 100%; } {{ULTP}} .ultp-block-row.ultp-layout1 .ultp-block-item:first-child .ultp-block-image img, {{ULTP}} .ultp-block-row.ultp-layout2 .ultp-block-item:first-child .ultp-block-image img {min-height: {{overlayHeight}};}'
                    ],
                ],
            ],
            'columnFlip' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'titleShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'headingShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'excerptShow' => [
                'type' => 'boolean',
                'default' => true
            ],
            'catShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'metaShow' => [
               'type' => 'boolean',
                'default' => true,
            ],
            'showImage' => [
               'type' => 'boolean',
                'default' => true,
            ],
            'filterShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'paginationShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'readMore' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'contentTag' => [
                'type' => 'string',
                'default' => 'div',
            ],
            'openInTab' => [
                'type' => 'boolean',
                'default' => false,
            ],



            //--------------------------
            //      Heading Setting/Style
            //--------------------------
            'headingText' => [
                'type' => 'string',
                'default' => 'Post Grid #6',
            ],
            'headingURL' => [
                'type' => 'string',
                'default' => '',
            ],
            'headingBtnText' => [
                'type' => 'string',
                'default' =>  'View More',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                    ],
                ],
            ],
            'headingStyle' => [
                'type' => 'string',
                'default' => 'style9',
            ],
            'headingTag' => [
                'type' => 'string',
                'default' => 'h2',
            ],
            'headingAlign' => [
                'type' => 'string',
                'default' =>  'left',
                'style' => [(object)['selector' => '{{ULTP}} .ultp-heading-inner, {{ULTP}} .ultp-sub-heading-inner { text-align:{{headingAlign}}; }']]
            ],
            'headingTypo' => [
                'type' => 'object',
                'default' =>  (object)['openTypography' => 1,'size' => (object)['lg' => '20', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => 'none', 'transform' => 'uppercase', 'family'=>'','weight'=>'700'],
                'style' => [(object)['selector' => '{{ULTP}} .ultp-heading-wrap .ultp-heading-inner']]
            ],
            'headingColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [(object)['selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { color:{{headingColor}}; }']],
            ],
            'headingBorderBottomColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-bottom-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { background-color: {{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style7'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { background-color: {{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style9'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style15'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style16'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style17'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { border-color:{{headingBorderBottomColor}}; }'
                    ],
                ],
            ],
            'headingBorderBottomColor2' => [
                'type' => 'string',
                'default' =>  '#e5e5e5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                ],
            ],
            'headingBg' => [
                'type' => 'string',
                'default' =>  '#037fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-style5 .ultp-heading-inner span:before { border-color:{{headingBg}} transparent transparent; } {{ULTP}} .ultp-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { border-color:{{headingBg}} transparent transparent; } {{ULTP}} .ultp-heading-inner { background-color:{{headingBg}}; }'
                    ],
                ],
            ],
            'headingBg2' => [
                'type' => 'string',
                'default' =>  '#e5e5e5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { background-color:{{headingBg2}}; }'
                    ],
                ],
            ],
            'headingBtnTypo' => [
                'type' => 'object',
                'default' =>  (object)['openTypography' => 1,'size' => (object)['lg' => '14', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-btn'
                    ],
                ],
            ],
            'headingBtnColor' => [
                'type' => 'string',
                'default' =>  '#037fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-btn { color:{{headingBtnColor}}; } {{ULTP}} .ultp-heading-wrap .ultp-heading-btn svg { fill:{{headingBtnColor}}; }'
                    ],
                ],
            ],
            'headingBtnHoverColor' => [
                'type' => 'string',
                'default' =>  '#0a31da',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-btn:hover { color:{{headingBtnHoverColor}}; } {{ULTP}} .ultp-heading-wrap .ultp-heading-btn:hover svg { fill:{{headingBtnHoverColor}}; }'
                    ],
                ],
            ],
            
            'headingBorder' => [
                'type' => 'string',
                'default' => '3',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-bottom-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style7'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before, {{ULTP}} .ultp-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style9'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before, {{ULTP}} .ultp-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner { border-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before, {{ULTP}} .ultp-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style15'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style16'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style17'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-inner:after { width:{{headingBorder}}px; }'
                    ],
                ],
            ],
            'headingSpacing' => [
                'type' => 'object',
                'default' => (object)['lg'=>30, 'unit'=>'px'],
                'style' => [(object)['selector'=>'{{ULTP}} .ultp-heading-wrap {margin-top:0; margin-bottom:{{headingSpacing}}; }']]
            ],

            'headingRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                ]
            ],

            
            'headingPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-heading-wrap .ultp-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                ]
            ],
            'subHeadingShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'subHeadingText' => [
                'type' => 'string',
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut sem augue. Sed at felis ut enim dignissim sodales.',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                    ],
                ],
            ],
            'subHeadingTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'16', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'27', 'unit'=>'px'],'decoration'=>'none','transform' => 'capitalize','family'=>'','weight'=>'500'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-sub-heading div'
                    ],
                ],
            ],
            'subHeadingColor' => [
                'type' => 'string',
                'default' =>  '#989898',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-sub-heading div{ color:{{subHeadingColor}}; }'
                    ],
                ],
            ],
            'subHeadingSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} div.ultp-sub-heading-inner{ margin:{{subHeadingSpacing}}; }'
                    ],
                ],
            ],


            //--------------------------
            //      Title Setting/Style
            //--------------------------
            'titleTag' => [
                'type' => 'string',
                'default' => 'h3',
            ],
            'titleAnimation' => [
                'type' => 'string',
                'default' => '',
            ],
            'titlePosition' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'titleColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content .ultp-block-title a { color:{{titleColor}}; }'
                    ],
                ],
            ],
            'titleHoverColor' => [
                'type' => 'string',
                'default' => 'rgba(255,255,255,0.70)',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content .ultp-block-title a:hover { color:{{titleHoverColor}}; }'
                    ],
                ],
            ],
            'titleLgTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'28', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'32', 'unit'=>'px'],'decoration'=>'none','family'=>'','weight'=>'700'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:first-child .ultp-block-title, {{ULTP}} .ultp-block-item:first-child .ultp-block-title a'
                    ],
                ],
            ],
            'titleTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'20', 'unit'=>'px'], 'height'=>(object)['lg'=>'26', 'unit'=>'px'], 'decoration'=>'none','family'=>'','weight'=>'600'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:not(:first-child) .ultp-block-title, {{ULTP}} .ultp-block-item:not(:first-child) .ultp-block-title a'
                    ],
                ],
            ],
            'titlePadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>10,'bottom'=>5, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content .ultp-block-title { padding:{{titlePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Overlay Content Setting/Style
            //--------------------------
            'overlayContentPosition' => [
                'type' => 'string',
                'default' => 'bottomPosition',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'overlayContentPosition','condition'=>'==','value'=>'topPosition'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-topPosition { align-items:flex-start; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'overlayContentPosition','condition'=>'==','value'=>'middlePosition'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-middlePosition { align-items:center; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'overlayContentPosition','condition'=>'==','value'=>'bottomPosition'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-bottomPosition { align-items:flex-end; }'
                    ],
                ]
            ],
            'overlayBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-content-inner'
                    ],
                ],
            ],
            'overlayWrapPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '20','bottom' => '20', 'left'=>'20','right'=>'20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-content-inner { padding: {{overlayWrapPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Content Setting/Style
            //--------------------------
            'showSmallExcerpt' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'showFullExcerpt' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'excerptLimit' => [
                'type' => 'string',
                'default' => 20,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showFullExcerpt','condition'=>'==','value'=>false],
                        ],
                    ],
                ],
            ],
            'excerptColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-excerpt { color:{{excerptColor}}; }'
                    ],
                ],
            ],
            'excerptTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>20, 'unit' =>'px'], 'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-excerpt'
                    ],
                ],
            ],
            'excerptPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 15,'bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-excerpt{ padding: {{excerptPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Category Setting/Style
            //--------------------------
            'showSmallCat' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'catStyle' => [
                'type' => 'string',
                'default' => 'classic',
            ],
            'catPosition' => [
                'type' => 'string',
                'default' => 'aboveTitle',
            ],
            'customCatColor' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'seperatorLink' => [
                'type' => 'string',
                'default' => admin_url( 'edit-tags.php?taxonomy=category' ),
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'customCatColor','condition'=>'==','value'=>true],
                        ]
                    ]
                ]
            ],
            'onlyCatColor' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'customCatColor','condition'=>'==','value'=>true],
                        ]
                    ]
                ]
            ],
            'catLineWidth' => [
                'type' => 'object',
                'default' => (object)['lg'=>'20'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'catStyle','condition'=>'!=','value'=>'classic'],
                        ],
                        'selector' => '{{ULTP}} .ultp-category-borderRight .ultp-category-in:before, {{ULTP}} .ultp-category-borderBoth .ultp-category-in:before, {{ULTP}} .ultp-category-borderBoth .ultp-category-in:after, {{ULTP}} .ultp-category-borderLeft .ultp-category-in:before  { width:{{catLineWidth}}px; }'
                    ],
                ]
            ],
            'catLineSpacing' => [
                'type' => 'object',
                'default' => (object)['lg'=>'30'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'catStyle','condition'=>'!=','value'=>'classic'],
                        ],
                        'selector' => '{{ULTP}} .ultp-category-borderBoth .ultp-category-in { padding-left: {{catLineSpacing}}px; padding-right: {{catLineSpacing}}px; }
                        {{ULTP}} .ultp-category-borderLeft .ultp-category-in { padding-left: {{catLineSpacing}}px; }
                        {{ULTP}} .ultp-category-borderRight .ultp-category-in { padding-right:{{catLineSpacing}}px; }'
                    ],
                ]
            ],
            'catLineColor' => [
                'type' => 'string',
                'default' => '#000',
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'catStyle','condition'=>'!=','value'=>'classic'],
                        ],
                        'selector' => '{{ULTP}} .ultp-category-borderRight .ultp-category-in:before, {{ULTP}} .ultp-category-borderLeft .ultp-category-in:before, {{ULTP}} .ultp-category-borderBoth .ultp-category-in:after, {{ULTP}} .ultp-category-borderBoth .ultp-category-in:before { background:{{catLineColor}}; }'
                    ],
                ]
            ],
            'catLineHoverColor' => [
                'type' => 'string',
                'default' => '#037fff',
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'catStyle','condition'=>'!=','value'=>'classic'],
                        ],
                        'selector' => '{{ULTP}} .ultp-category-borderBoth:hover .ultp-category-in:before, {{ULTP}} .ultp-category-borderBoth:hover .ultp-category-in:after, {{ULTP}} .ultp-category-borderLeft:hover .ultp-category-in:before, {{ULTP}} .ultp-category-borderRight:hover .ultp-category-in:before { background:{{catLineHoverColor}}; }'
                    ],
                ]
            ],
            'catTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>11, 'unit' =>'px'], 'height' => (object)['lg' =>15, 'unit' =>'px'], 'spacing' => (object)['lg' =>1, 'unit' =>'px'], 'transform' => 'uppercase', 'weight' => '500', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-item .ultp-category-grid a'
                    ],
                ],
            ],
            'catColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'customCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-item .ultp-category-grid a { color:{{catColor}}; }'
                    ],
                ],
            ],
            'catBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#000'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'customCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a'
                    ],
                ],
            ],
            'catBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'onlyCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a'
                    ],
                ],
            ],
            'catRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'onlyCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a { border-radius:{{catRadius}}; }'
                    ],
                ],
            ],
            'catHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'customCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-category-grid a:hover { color:{{catHoverColor}}; }'
                    ],
                ],
            ],
            'catBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#037fff'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'customCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a:hover'
                    ],
                ],
            ],
            'catHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'onlyCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a:hover'
                    ],
                ],
            ],
            'catSacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 5,'bottom' => 5,'left' => 0,'right' => 0, 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid { margin:{{catSacing}}; }'
                    ],
                ],
            ],
            'catPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 3,'bottom' => 3,'left' => 7,'right' => 7, 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                            (object)['key'=>'onlyCatColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-category-grid a { padding:{{catPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Meta Setting/Style
            //--------------------------
            'showSmallMeta' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'metaPosition' => [
                'type' => 'string',
                'default' => 'top',
            ],
            'metaStyle' => [
                'type' => 'string',
                'default' => 'icon',
            ],
            'metaSeparator' => [
                'type' => 'string',
                'default' => 'emptyspace',
            ],
            'metaList' => [
                'type' => 'string',
                'default' => '["metaAuthor","metaDate"]',
            ],
            'metaListSmall' => [
                'type' => 'string',
                'default' => '["metaDate"]',
            ],
            'metaTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>13, 'unit' =>'px'],'height' => (object)['lg' =>20, 'unit' =>'px'], 'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta span, {{ULTP}} .ultp-block-item .ultp-block-meta span a'
                    ],
                ],
            ],
            'metaColor' => [
                'type' => 'string',
                'default' => 'rgba(255,255,255,0.90)',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-meta span { color: {{metaColor}}; } {{ULTP}} .ultp-block-items-wrap .ultp-block-meta span svg { fill: {{metaColor}}; } {{ULTP}} .ultp-block-items-wrap .ultp-block-meta span a { color: {{metaColor}}; }{{ULTP}} .ultp-block-meta-dot span:after { background:{{metaColor}}; }  {{ULTP}} .ultp-block-items-wrap .ultp-block-meta span:after { color:{{metaColor}}; }'
                    ],
                ],
            ],
            'metaHoverColor' => [
                'type' => 'string',
                'default' => '#037fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-meta span a:hover { color: {{metaHoverColor}}; }'
                    ],
                ],
            ],
            'metaSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>'10', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta span { margin-right:{{metaSpacing}}; } {{ULTP}} .ultp-block-meta span { padding-left: {{metaSpacing}}; } .rtl {{ULTP}} .ultp-block-meta span {margin-right:0; margin-left:{{metaSpacing}}; } .rtl {{ULTP}} .ultp-block-meta span { padding-left:0; padding-right: {{metaSpacing}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-meta span:last-child{margin-right:0px;}'
                    ],
                ],
            ],
            'metaMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '5','bottom' => '', 'left'=>'','right'=>'', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta { margin:{{metaMargin}}; }'
                    ],
                ],
            ],
            'metaPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '5','bottom' => '5', 'left'=>'','right'=>'', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta { padding:{{metaPadding}}; }'
                    ],
                ],
            ],
            'metaBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => '0', 'bottom' => '0', 'left' => '0'],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta'
                    ],
                ],
            ],
            'metaBg' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'metaShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-meta { background:{{metaBg}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Image Setting/Style
            //--------------------------
            'imgAnimation' => [
                'type' => 'string',
                'default' => 'zoomIn',
            ],
            'imgGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-image img { filter: grayscale({{imgGrayScale}}); }'
                    ],
                ],
            ],
            'imgHoverGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:hover .ultp-block-image img { filter: grayscale({{imgHoverGrayScale}}); }'
                    ],
                ],
            ],
            'imgRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-wrap, {{ULTP}} .ultp-block-image { border-radius:{{imgRadius}}; }'
                    ],
                ],
            ],
            'imgHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-wrap:hover, {{ULTP}} .ultp-block-content-wrap:hover .ultp-block-image { border-radius:{{imgHoverRadius}}; }'
                    ],
                ],
            ],
            'imgShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-content-overlay'
                    ],
                ],
            ],
            'imgHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:hover .ultp-block-content-overlay'
                    ],
                ],
            ],
            'imgOverlay' => [
               'type' => 'boolean',
                'default' => true,
            ],
            'imgOverlayType' => [
                'type' => 'string',
                'default' => 'simgleGradient',
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'imgOverlay','condition'=>'==','value'=>true],
                        ]
                    ],
                ]         
            ],
            'overlayColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#0e1523'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'imgOverlayType','condition'=>'==','value'=>'custom'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-image-custom > a::before'
                    ],
                ],

            ],
            'imgOpacity' => [
                'type' => 'string',
                'default' => .7,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'imgOverlayType','condition'=>'==','value'=>'custom'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-image-custom > a::before { opacity: {{imgOpacity}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Read more Setting/Style
            //--------------------------
            'showSmallBtn' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'readMoreText' => [
                'type' => 'string',
                'default' => ''
            ],
            'readMoreIcon' => [
                'type' => 'string',
                'default' => 'rightArrowLg',
            ],
            'readMoreTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>12, 'unit' =>'px'], 'height' => (object)['lg' =>'', 'unit' =>'px'], 'spacing' => (object)['lg' =>1, 'unit' =>'px'], 'transform' => 'uppercase', 'weight' => '400', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-item .ultp-block-readmore a'
                    ],
                ],
            ],
            'readMoreIconSize' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{ULTP}} .ultp-block-readmore svg{ width:{{readMoreIconSize}}; }'
                    ],
                ]
            ],
            'readMoreColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-readmore a { color:{{readMoreColor}}; } {{ULTP}} .ultp-block-readmore a svg { fill:{{readMoreColor}}; }'
                    ],
                ],
            ],
            'readMoreBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0,'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a'
                    ],
                ],
            ],
            'readMoreBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a'
                    ],
                ],
            ],
            'readMoreRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a { border-radius:{{readMoreRadius}}; }'
                    ],
                ],
            ],
            'readMoreHoverColor' => [
                'type' => 'string',
                'default' => 'rgba(255,255,255,0.80)',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-block-readmore a:hover { color:{{readMoreHoverColor}}; } {{ULTP}} .ultp-block-readmore a:hover svg { fill:{{readMoreHoverColor}}; }'
                    ],
                ],
            ],
            'readMoreBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a:hover'
                    ],
                ],
            ],
            'readMoreHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a:hover'
                    ],
                ],
            ],
            'readMoreHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a:hover { border-radius:{{readMoreHoverRadius}}; }'
                    ],
                ],
            ],
            'readMoreSacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 15,'bottom' => '','left' => '','right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore { margin:{{readMoreSacing}}; }'
                    ],
                ],
            ],
            'readMorePadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '','right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'readMore','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-readmore a { padding:{{readMorePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Filter Setting/Style
            //--------------------------
            'filterType' => [
                'type' => 'string',
                'default' => 'category'
            ],
            'filterText' => [
                'type' => 'string',
                'default' => 'all'
            ],
            'filterValue' => [
                'type' => 'string',
                'default' => '[]',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'filterType','condition' => '!=','value' => '']]
                    ],
                ],
            ],
            'filterCat' => [ // for compatibility
                'type' => 'string',
                'default' => '[]'
            ],
            'filterTag' => [ // for compatibility
                'type' => 'string',
                'default' => '[]'
            ],
            'fliterTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>18, 'unit' =>'px'], 'decoration' => 'none','family'=>'','weight'=>500],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-navigation .ultp-filter-wrap ul li a'
                    ],
                ],
            ],
            'filterColor' => [
                'type' => 'string',
                'default' => '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-navigation .ultp-filter-wrap ul li a { color:{{filterColor}}; }'
                    ],
                ],
            ],
            'filterHoverColor' => [
                'type' => 'string',
                'default' =>  '#828282',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-navigation .ultp-filter-wrap ul li a:hover, {{ULTP}} .ultp-filter-navigation .ultp-filter-wrap ul li a.filter-active { color:{{filterHoverColor}}; }'
                    ],
                ],
            ],
            'filterBgColor' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a { background:{{filterBgColor}}; }'
                    ],
                ],
            ],
            'filterHoverBgColor' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a:hover, {{ULTP}} .ultp-filter-wrap ul li.filter-item > a.filter-active { background:{{filterHoverBgColor}}; }'
                    ],
                ],
            ],
            'filterBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a'
                    ],
                ],
            ],
            'filterHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a:hover'
                    ],
                ],
            ],
            'filterRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a { border-radius:{{filterRadius}}; }'
                    ],
                ],
            ],
            'fliterSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'right' => '', 'left' => '20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li { margin:{{fliterSpacing}}; }'
                    ],
                ],
            ],
            'fliterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.filter-item > a { padding:{{fliterPadding}}; }'
                    ],
                ],
            ],
            'filterDropdownColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup li a { color:{{filterDropdownColor}}; }'
                    ],
                ],
            ],
            'filterDropdownHoverColor' => [
                'type' => 'string',
                'default' =>  '#037fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup li a:hover { color:{{filterDropdownHoverColor}}; }'
                    ],
                ],
            ],
            'filterDropdownBg' => [
                'type' => 'string',
                'default' =>  '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}}  .ultp-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { background:{{filterDropdownBg}}; }'
                    ],
                ],
            ],
            'filterDropdownRadius' => [
                'type' => 'object',
                'default' => (object)['lg'=>'0'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}}  .ultp-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { border-radius:{{filterDropdownRadius}}; }'
                    ],
                ],
            ],
            'filterDropdownPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '15','bottom' => '15','left' => '20','right' => '20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}}  .ultp-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { padding:{{filterDropdownPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Pagination Setting/Style
            //--------------------------
            'paginationType' => [
                'type' => 'string',
                'default' => 'navigation',
            ],
            'paginationNav' => [
                'type' => 'string',
                'default' => 'textArrow',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'pagination'],
                        ],
                    ],
                ],
            ],
            'navPosition' => [
                'type' => 'string',
                'default' => 'topRight',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                    ],
                ],
            ],
            'pagiAlign' => [
                'type' => 'object',
                'default' =>  (object)['lg' =>'left'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-loadmore, {{ULTP}} .ultp-next-prev-wrap ul, {{ULTP}} .ultp-pagination { text-align:{{pagiAlign}}; }'
                    ],
                ],
            ],
            'pagiTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>20, 'unit' =>'px'], 'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination-wrap .ultp-pagination li a, {{ULTP}} .ultp-loadmore .ultp-loadmore-action'
                    ],
                ],

            ],
            'pagiArrowSize' => [
                'type' => 'object',
                'default' => (object)['lg'=>'14'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-next-prev-wrap ul li a svg { width:{{pagiArrowSize}}px; }'
                    ],
                ],

            ],
            'pagiColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination-wrap .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-block-wrapper .ultp-loadmore .ultp-loadmore-action { color:{{pagiColor}}; } {{ULTP}} .ultp-next-prev-wrap ul li a svg, {{ULTP}} .ultp-block-wrapper .ultp-loadmore .ultp-loadmore-action svg { fill:{{pagiColor}}; } {{ULTP}} .ultp-pagination li a svg { fill:{{pagiColor}}; }'
                    ],
                ],
            ],
            'pagiBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#0e1523'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination-wrap .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-loadmore .ultp-loadmore-action'
                    ],
                ],
            ],
            'pagiBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-loadmore-action'
                    ],
                ],
            ],
            'pagiShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-loadmore-action'
                    ],
                ],
            ],
            'pagiRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '2','bottom' => '2','left' => '2','right' => '2', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-loadmore-action { border-radius:{{pagiRadius}}; }'
                    ],
                ],
            ],
            'pagiHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination-wrap .ultp-pagination li.pagination-active a, {{ULTP}} .ultp-next-prev-wrap ul li a:hover, {{ULTP}} .ultp-block-wrapper .ultp-loadmore-action:hover { color:{{pagiHoverColor}}; } {{ULTP}} .ultp-pagination li a:hover svg, {{ULTP}} .ultp-block-wrapper .ultp-loadmore .ultp-loadmore-action:hover svg { fill:{{pagiHoverColor}}; } {{ULTP}} .ultp-next-prev-wrap ul li a:hover svg { fill:{{pagiHoverColor}}; } @media (min-width: 768px) { {{ULTP}} .ultp-pagination li a:hover { color:{{pagiHoverColor}};}}'
                    ],
                ],
            ],
            'pagiHoverbg' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#037fff','replace'=>1],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination-wrap .ultp-pagination li a:hover, {{ULTP}} .ultp-pagination-wrap .ultp-pagination li.pagination-active a, {{ULTP}} .ultp-pagination-wrap .ultp-pagination li a:focus, {{ULTP}} .ultp-next-prev-wrap ul li a:hover, {{ULTP}} .ultp-loadmore-action:hover{ {{pagiHoverbg}} }'
                    ],
                ],
            ],
            'pagiHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a:hover, {{ULTP}} .ultp-pagination li.pagination-active a, {{ULTP}} .ultp-next-prev-wrap ul li a:hover, {{ULTP}} .ultp-loadmore-action:hover'
                    ],
                ],
            ],
            'pagiHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a:hover, {{ULTP}} .ultp-pagination li.pagination-active a, {{ULTP}} .ultp-next-prev-wrap ul li a:hover, {{ULTP}} .ultp-loadmore-action:hover'
                    ],
                ],
            ],
            'pagiHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '2','bottom' => '2','left' => '2','right' => '2', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li.pagination-active a, {{ULTP}} .ultp-pagination li a:hover, {{ULTP}} .ultp-next-prev-wrap ul li a:hover, {{ULTP}} .ultp-loadmore-action:hover { border-radius:{{pagiHoverRadius}}; }'
                    ],
                ],
            ],
            'pagiPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '8','bottom' => '8','left' => '14','right' => '14', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-pagination li a, {{ULTP}} .ultp-next-prev-wrap ul li a, {{ULTP}} .ultp-loadmore-action { padding:{{pagiPadding}}; }'
                    ],
                ],
            ],
            'navMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-next-prev-wrap ul { margin:{{navMargin}}; }'
                    ],
                ],
            ],

            //--------------------------
            //  Wrapper Style
            //--------------------------
            'loadingColor' => [
                'type' => 'string',
                'default' => '#000',
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-loading .ultp-loading-blocks div { --loading-block-color: {{loadingColor}}; }'
                    ],
                ],
            ],
            'wrapBg' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#f5f5f5'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper'
                    ],
                ],
            ],
            'wrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' =>(object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper'
                    ],
                ],
            ],
            'wrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper'
                    ],
                ],
            ],
            'wrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper { border-radius:{{wrapRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverBackground' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#037fff'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper:hover { border-radius:{{wrapHoverRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper { margin:{{wrapMargin}}; }'
                    ],
                ],
            ],
            'wrapOuterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper { padding:{{wrapOuterPadding}}; }'
                    ],
                ],
            ],
            'wrapInnerPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-wrapper { padding:{{wrapInnerPadding}}; }'
                    ],
                ],
            ],
            'advanceId' => [
                'type' => 'string',
                'default' => '',
            ],
            'advanceZindex' => [
                'type' => 'number',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {z-index:{{advanceZindex}};}'
                    ],
                ],
            ],
            'hideExtraLarge' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {display:none;}'
                    ],
                ],
            ],
            'hideDesktop' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {display:none;}'
                    ],
                ],
            ],
            'hideTablet' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {display:none;}'
                    ],
                ],
            ],
            'hideMobile' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {display:none;}'
                    ],
                ],
            ],
            'advanceCss' => [
                'type' => 'string',
                'default' => '',
                'style' => [(object)['selector' => '']],
            ]
        );
        
        if( $default ){
            $temp = array();
            foreach ($attributes as $key => $value) {
                if( isset($value['default']) ){
                    $temp[$key] = $value['default'];
                }
            }
            return $temp;
        }else{
            return $attributes;
        }
    }

    public function register() {
        register_block_type( 'ultimate-post/post-grid-6',
            array(
                'title' => __('Post Grid #6', 'ultimate-post'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            )
        );
    }

    public function content($attr, $noAjax) {

        if(!$noAjax){
            $paged = is_front_page() ? get_query_var('page') : get_query_var('paged');
            $attr['paged'] = $paged ? $paged : 1;
        }

        $block_name = 'post-grid-6';
        $page_post_id = ultimate_post()->get_ID();
        $wraper_before = $wraper_after = $post_loop = '';
        $recent_posts = new \WP_Query( ultimate_post()->get_query( $attr ) );
        $pageNum = ultimate_post()->get_page_number($attr, $recent_posts->found_posts);
        
        if ($recent_posts->have_posts()) {
            $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-ultimate-post-'.$block_name.' ultp-block-'.$attr["blockId"].''.(isset($attr["align"])? ' align' .$attr["align"]:'').''.(isset($attr["className"])?' '.$attr["className"]:'').'">';
                $wraper_before .= '<div class="ultp-block-wrapper">';

                    // Loading
                    $wraper_before .= ultimate_post()->loading();

                    if ($attr['headingShow'] || $attr['filterShow'] || $attr['paginationShow']) {
                        $wraper_before .= '<div class="ultp-heading-filter">';
                            $wraper_before .= '<div class="ultp-heading-filter-in">';
                                
                                // Heading
                                include ULTP_PATH.'blocks/template/heading.php';
                                
                                if ($attr['filterShow'] || $attr['paginationShow']) {
                                    $wraper_before .= '<div class="ultp-filter-navigation">';

                                        // Filter
                                        if($attr['filterShow']) {
                                            include ULTP_PATH.'blocks/template/filter.php';
                                        }

                                        // Navigation
                                        if($attr['paginationShow'] && ($attr['paginationType'] == 'navigation') && ($attr['navPosition'] == 'topRight')) {
                                            include ULTP_PATH.'blocks/template/navigation-before.php';
                                        }
                                    $wraper_before .= '</div>';
                                }

                            $wraper_before .= '</div>';
                        $wraper_before .= '</div>';
                    }
             
                    $wraper_before .= '<div class="ultp-block-items-wrap ultp-block-row ultp-'.$attr['layout'].' ultp-block-content-'.($attr['columnFlip'] ? 'true' : 'false').'">';
                        $idx = $noAjax ? 1 : 0;
                        while ( $recent_posts->have_posts() ): $recent_posts->the_post();
                            
                            include ULTP_PATH.'blocks/template/data.php';

                            include ULTP_PATH.'blocks/template/category.php';
                            
                            $post_loop .= '<'.$attr['contentTag'].' class="ultp-block-item post-id-'.$post_id.' ultp-block-item-'.$idx.($attr['titleAnimation'] ? ' ultp-animation-'.$attr['titleAnimation'] : '').'">';
                                $post_loop .= '<div class="ultp-block-content-wrap ultp-block-content-overlay">';

                                    if( has_post_thumbnail() && $attr['showImage'] ){
                                        $post_loop .= '<div class="ultp-block-image ultp-block-image-'.$attr['imgAnimation'].($attr["imgOverlay"] ? ' ultp-block-image-overlay ultp-block-image-'.$attr["imgOverlayType"] : '' ).'">';
                                            $post_loop .= '<a href="'.$titlelink.'" '.($attr['openInTab'] ? 'target="_blank"' : '').'><img loading="lazy" alt="'.$title.'" src="'.wp_get_attachment_image_url( $post_thumb_id, 'full' ).'" /></a>';
                                            if( ($attr['catPosition'] != 'aboveTitle') && ($idx == 0 || $attr['showSmallCat']) && $attr['catShow'] ) {
                                                $post_loop .= '<div class="ultp-category-img-grid">'.$category.'</div>';
                                            }
                                        $post_loop .= '</div>';
                                    } else {
                                        $post_loop .= '<div class="ultp-block-image ultp-block-empty-image"></div>';
                                    }
                                    $post_loop .= '<div class="ultp-block-content ultp-block-content-'.$attr['overlayContentPosition'].'">';
                                        $post_loop .= '<div class="ultp-block-content-inner">';
                                            // Category
                                            if(($attr['catPosition'] == 'aboveTitle') && ($idx == 0 || $attr['showSmallCat'] ) && $attr['catShow']) {
                                                $post_loop .= $category;
                                            }

                                            // Title
                                            if ($title && $attr['titleShow'] && $attr['titlePosition'] == 1) {
                                                include ULTP_PATH.'blocks/template/title.php';
                                            }
                                            
                                            // Meta
                                            if( ($idx == 0 || $attr['showSmallMeta']) && $attr['metaShow'] && $attr['metaPosition'] =='top' ) {
                                                include ULTP_PATH.'blocks/template/meta.php';
                                            }
                                            
                                            // Title
                                            if ($title && $attr['titleShow'] && $attr['titlePosition'] == 0) {
                                                include ULTP_PATH.'blocks/template/title.php';
                                            }

                                            // Excerpt
                                            if(($idx == 0 || $attr['showSmallExcerpt']) && $attr['excerptShow']) {
                                                if ( $attr['showFullExcerpt']== 0 )  {
                                                    $post_loop .= '<div class="ultp-block-excerpt">'.ultimate_post()->excerpt($post_id, $attr['excerptLimit']).'</div>';
                                                } else {
                                                    $post_loop .= '<div class="ultp-block-excerpt">'.get_the_excerpt().'</div>';
                                                }
                                            }

                                            // Read More
                                            if ($attr['readMore'] && ($idx == 0 || $attr['showSmallBtn'])) {
                                                $post_loop .= '<div class="ultp-block-readmore"><a href="'.$titlelink.'" '.($attr['openInTab'] ? 'target="_blank"' : '').'>'.($attr['readMoreText'] ? $attr['readMoreText'] : __( "Read More", "ultimate-post" )).ultimate_post()->svg_icon($attr['readMoreIcon']).'</a></div>';
                                            }

                                            // Meta
                                            if( ($idx == 0 || $attr['showSmallMeta']) && $attr['metaShow'] && $attr['metaPosition'] =='bottom' ) {
                                                include ULTP_PATH.'blocks/template/meta.php';
                                            }
                                        $post_loop .= '</div>';
                                    $post_loop .= '</div>';
                                $post_loop .= '</div>';
                            $post_loop .= '</'.$attr['contentTag'].'>';
                            $idx ++;
                        endwhile;
    
                    $wraper_after .= '</div>';//ultp-block-items-wrap
              
                    // Navigation
                    if ($attr['paginationShow'] && ($attr['paginationType'] == 'navigation') && ($attr['navPosition'] != 'topRight')) {
                        include ULTP_PATH.'blocks/template/navigation-after.php';
                    }

                $wraper_after .= '</div>';
            $wraper_after .= '</div>';

            wp_reset_query();
        }

        return $noAjax ? $post_loop : $wraper_before.$post_loop.$wraper_after;
    }

}