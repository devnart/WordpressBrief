<?php
namespace ULTP\blocks;

defined('ABSPATH') || exit;

class Taxonomy{
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
                'default' => '1',
            ],

            //--------------------------
            //      Query Setting
            //--------------------------
            'taxType' => [
                'type' => 'string',
                'default' => 'regular',
            ],
            'taxSlug' => [
                'type' => 'string',
                'default' => 'category',
            ],
            'taxValue' => [
                'type' => 'string',
                'default' => '[]',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxType','condition'=>'!=','value'=>['parent','regular']],
                        ],
                    ],
                ],
            ],
            'queryNumber' => [
                'type' => 'string',
                'default' => 6,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxType','condition'=>'!=','value'=>'custom'],
                        ],
                    ],
                ],
            ],
            
            //--------------------------
            //      General Setting
            //--------------------------
            'taxGridEn' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'columns' => [
                'type' => 'object',
                'default' => (object)['lg' =>'1'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxGridEn','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}}.wp-block-ultimate-post-ultp-taxonomy .ultp-block-items-wrap .ultp-taxonomy-items { grid-template-columns: repeat({{columns}}, 1fr); }'
                    ],
                ],
            ],
            'columnGridGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'20', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxGridEn','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-taxonomy-items { grid-column-gap: {{columnGridGap}}; } {{ULTP}} .ultp-taxonomy-items .ultp-taxonomy-item { margin-bottom: 0; }'
                    ],
                ],
            ],
            'rowGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'20', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxGridEn','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-items-wrap .ultp-taxonomy-items { grid-row-gap: {{rowGap}}; }'
                    ],
                ],
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
                'default' => false
            ],
            'countShow' => [
                'type' => 'boolean',
                'default' => true
            ],
            'showImage' => [
               'type' => 'boolean',
                'default' => true,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>'1'],
                        ],
                    ],
                ],
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
                'default' => 'Post Taxonomy',
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
                'style' => [(object)['selector' => '{{ULTP}} .ultp-heading-inner, {{ULTP}} .ultp-sub-heading-inner{ text-align:{{headingAlign}}; }']]
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
                        'selector'=>'{{ULTP}} .ultp-block-wrapper .ultp-heading-wrap .ultp-heading-btn'
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
                'default' => (object)['lg'=>30, 'sm'=>10, 'unit'=>'px'],
                'style' => [(object)['selector'=>'{{ULTP}} .ultp-heading-wrap {margin-top:0; margin-bottom:{{headingSpacing}}; }']]
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
            'titlePosition' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'customTaxTitleColor' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'layout','condition'=>'!=','value'=>['2','3','6']],
                        ]
                    ]
                ]
            ],
            'seperatorTaxTitleLink' => [
                'type' => 'string',
                'default' => admin_url( 'edit-tags.php?taxonomy=category' ),
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'customTaxTitleColor','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'!=','value'=>['2','3','6']],
                        ]
                    ]
                ]
            ],
            'titleColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['7','8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-name { color:{{titleColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'customTaxTitleColor','condition'=>'==','value'=>false],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-name { color:{{titleColor}}; }'
                    ],
                    
                ],
            ],
            'TitleBgColor' => [
                'type' => 'string',
                'default' => '#f2f2f2',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['7','8']],
                            (object)['key'=>'customTaxTitleColor','condition'=>'==','value'=>false],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-7 li a .ultp-taxonomy-name, {{ULTP}} .ultp-taxonomy-layout-8 li a .ultp-taxonomy-name { background:{{TitleBgColor}}; }'
                    ],
                ],
            ],
            'TitleBgHoverColor' => [
                'type' => 'string',
                'default' => '#c5c5c5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['7','8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-7 li a:hover .ultp-taxonomy-name, {{ULTP}} .ultp-taxonomy-layout-8 li a:hover .ultp-taxonomy-name { background:{{TitleBgHoverColor}}; }'
                    ],
                ],
            ],
            'titleHoverColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-item a:hover .ultp-taxonomy-name, {{ULTP}} .ultp-block-item a:hover .ultp-taxonomy-count { color:{{titleHoverColor}}!important; }'
                    ],
                ],
            ],
            'titleTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'14', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)['lg'=>'22', 'unit'=>'px'],'transform' => '', 'decoration'=>'none','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-name'
                    ],
                ],
            ],
            'titleDotColor' => [
                'type' => 'string',
                'default' => '#cacaca',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2','3']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-2 li a .ultp-taxonomy-bar, {{ULTP}} .ultp-taxonomy-layout-3 li a .ultp-taxonomy-bar { border-bottom-color:{{titleDotColor}}; }'
                    ],
                ],
            ],
            'titleDotSize' => [
                'type' => 'string',
                'default' => 'solid',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2','3']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-2 li a .ultp-taxonomy-bar, {{ULTP}} .ultp-taxonomy-layout-3 li a .ultp-taxonomy-bar { border-bottom-width:{{titleDotSize}}px; }'
                    ],
                ],
            ],
            'titleDotStyle' => [
                'type' => 'string',
                'default' => (object)['lg'=>'1'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2','3']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-2 li a .ultp-taxonomy-bar, {{ULTP}} .ultp-taxonomy-layout-3 li a .ultp-taxonomy-bar { border-bottom-style: {{titleDotStyle}}; }'
                    ],
                ],
            ],
            'titlePadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-name { padding:{{titlePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Content Setting/Style
            //--------------------------
            'excerptLimit' => [
                'type' => 'string',
                'default' => 30,
            ],
            'excerptColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-desc { color:{{excerptColor}}; }'
                    ],
                ],
            ],
            'excerptTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>'22', 'unit' =>'px'], 'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-desc'
                    ],
                ],
            ],
            'excerptPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '0','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-desc { padding: {{excerptPadding}}; }'
                    ],
                ],
            ],


            //--------------------------
            // Count Style Setting/Style
            //--------------------------
            'counterTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>14, 'unit' =>'px'], 'height' => (object)['lg' =>'22', 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => '', 'weight' => '400', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-count'
                    ],
                ],
            ],
            'counterColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} .ultp-block-item .ultp-taxonomy-count { color:{{counterColor}}; }'
                    ],
                ]
            ],
            'counterBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-count'
                    ],
                ],
            ],
            'counterWidth' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} .ultp-block-item .ultp-taxonomy-count { width:{{counterWidth}}px; }'
                    ],
                ]
            ],
            'counterHeight' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} .ultp-block-item .ultp-taxonomy-count { height:{{counterHeight}}px; line-height:{{counterHeight}}px !important; }'
                    ],
                ]
            ],
            'counterBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-count'
                    ],
                ],
            ],
            'counterRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-item .ultp-taxonomy-count { border-radius:{{counterRadius}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Inner Content Setting/Style
            //--------------------------
            'contentWrapBg' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-item a .ultp-taxonomy-lt5-content  { background:{{contentWrapBg}}; }'
                    ],
                ],
            ],
            'contentWrapHoverBg' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-item a:hover .ultp-taxonomy-lt5-content { background:{{contentWrapHoverBg}}; }'
                    ],
                ],
            ],
            'contentWrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a'
                    ],
                ],
            ],
            'contentWrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a:hover'
                    ],
                ],
            ],
            'contentWrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a { border-radius: {{contentWrapRadius}}; }'
                    ],
                ],
            ],
            'contentWrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a:hover { border-radius: {{contentWrapHoverRadius}}; }'
                    ],
                ],
            ],
            'contentWrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a'
                    ],
                ],
            ],
            'contentWrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a:hover, {{ULTP}} .ultp-taxonomy-layout-5 .ultp-taxonomy-item a:hover'
                    ],
                ],
            ],
            'contentWrapPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1','4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-1 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-layout-4 .ultp-taxonomy-item a, {{ULTP}} .ultp-taxonomy-item a .ultp-taxonomy-lt5-content { padding: {{contentWrapPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Image Setting/Style
            //--------------------------
            'imgWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-4 a img, {{ULTP}} .ultp-taxonomy-layout-5 a img { max-width: {{imgWidth}}; }'
                    ],
                ],
            ],
            'imgHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-4 a img, {{ULTP}} .ultp-taxonomy-layout-5 a img {object-fit: cover; height: {{imgHeight}}; }'
                    ],
                ],
            ],
            'imgSpacing' => [
                'type' => 'object',
                'default' => (object)['lg'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4','5']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-4 a img, {{ULTP}} .ultp-taxonomy-layout-5 a img { margin-bottom: {{imgSpacing}}px; }'
                    ],
                ],
            ],
            'contentAlign' => [
                'type' => 'string',
                'default' => "center",
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'left'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-5 li a, {{ULTP}} .ultp-taxonomy-layout-4 li a { text-align:{{contentAlign}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'center'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-5 li a, {{ULTP}} .ultp-taxonomy-layout-4 li a { text-align:{{contentAlign}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-layout-5 li a, {{ULTP}} .ultp-taxonomy-layout-4 li a { text-align:{{contentAlign}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Separator
            //--------------------------
            'separatorShow' => [
                'type' => 'boolean',
                'default' => false,
                'depends' => [
                    (object)['key'=>'taxGridEn','condition'=>'!=','value'=>true],
                ],
            ],
            'septColor' => [
                'type' => 'string',
                'default' => '#e5e5e5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'separatorShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:not(:last-of-type) { border-bottom-color:{{septColor}}; }'
                    ],
                ],
            ],
            'septStyle' => [
                'type' => 'string',
                'default' => 'solid',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'separatorShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:not(:last-of-type) { border-bottom-style:{{septStyle}}; }'
                    ],
                ],
            ],
            'septSize' => [
                'type' => 'string',
                'default' => (object)['lg'=>'1'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'separatorShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:not(:last-of-type) { border-bottom-width: {{septSize}}px; }'
                    ],
                ],
            ],
            'septSpace' => [
                'type' => 'object',
                'default' => (object)['lg'=>'5'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'taxGridEn','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-item:not(:last-of-type) { padding-bottom: {{septSpace}}px; } {{ULTP}} .ultp-block-item:not(:last-of-type) { margin-bottom: {{septSpace}}px; }'
                    ],
                ],
            ],

            //--------------------------
            //  Custom Wrapper Style
            //--------------------------
            'customTaxColor' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'seperatorTaxLink' => [
                'type' => 'string',
                'default' => admin_url( 'edit-tags.php?taxonomy=category' ),
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'customTaxColor','condition'=>'==','value'=>true],
                        ]
                    ]
                ]
            ],
            'TaxAnimation' => [
                'type' => 'string',
                'default' => 'none'
            ],
            
            'TaxWrapBg' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            // (object)['key'=>'layout','condition'=>'==','value'=>[2, 3, 6, 7, 8]],
                            (object)['key'=>'customTaxColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt2-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt3-overlay,  {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt6-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt7-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt8-overlay { background:{{TaxWrapBg}}; }'
                    ],
                ],
            ],
            'TaxWrapHoverBg' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                            (object)['key'=>'customTaxColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt2-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt3-overlay,  {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt6-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt7-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt8-overlay { background:{{TaxWrapHoverBg}}; }'
                    ],
                ],
            ],
            'TaxWrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a'
                    ],
                ],
            ],
            'TaxWrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a:hover'
                    ],
                ],
            ],
            'TaxWrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a'
                    ],
                ],
            ],
            'TaxWrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a:hover'
                    ],
                ],
            ],
            'TaxWrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a { border-radius: {{TaxWrapRadius}}; }'
                    ],
                ],
            ],
            'TaxWrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a:hover { border-radius: {{TaxWrapHoverRadius}}; }'
                    ],
                ],
            ],
            'customOpacityTax' => [
                'type' => 'string',
                'default' => .6,
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt2-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt3-overlay,  {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt6-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt7-overlay, {{ULTP}} .ultp-taxonomy-items li a .ultp-taxonomy-lt8-overlay { opacity: {{customOpacityTax}}; }'
                    ],
                ],
            ],
            'customTaxOpacityHover' => [
                'type' => 'string',
                'default' => .9,
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt2-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt3-overlay,  {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt6-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt7-overlay, {{ULTP}} .ultp-taxonomy-items li a:hover .ultp-taxonomy-lt8-overlay { opacity: {{customTaxOpacityHover}}; }'
                    ],
                ],
            ],
            'TaxWrapPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)[ 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2', '3', '6', '7', '8']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-taxonomy-item a { padding: {{TaxWrapPadding}}; }'
                    ],
                ],
            ],


            //--------------------------
            //  Wrapper Style
            //--------------------------
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
        register_block_type( 'ultimate-post/ultp-taxonomy',
            array(
                'title' => __('Taxonomy', 'ultimate-post'),
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

        $block_name = 'ultp-taxonomy';
        $wraper_before = $wraper_after = $post_loop = '';
        
        $recent_posts = ultimate_post()->get_category_data( json_decode($attr['taxValue']), $attr['queryNumber'], $attr['taxType'], $attr['taxSlug'] );

        if (!empty($recent_posts)) {
            $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-ultimate-post-'.$block_name.' ultp-block-'.$attr["blockId"].' '.(isset($attr["class"])?$attr["class"]:'').'">';
                $wraper_before .= '<div class="ultp-block-wrapper">';

                    // Loading
                    $wraper_before .= ultimate_post()->loading();

                    if ($attr['headingShow']) {
                        $wraper_before .= '<div class="ultp-heading-filter">';
                            $wraper_before .= '<div class="ultp-heading-filter-in">';
                                // Heading
                                include ULTP_PATH.'blocks/template/heading.php';
                            $wraper_before .= '</div>';
                        $wraper_before .= '</div>';
                    }
                    $wraper_before .= '<div class="ultp-block-items-wrap">';
                        $idx = $noAjax ? 1 : 0;

                        $wraper_before .= '<ul class="ultp-taxonomy-items '.(isset($attr["TaxAnimation"])? ' ultp-taxonomy-animation-' .$attr["TaxAnimation"]:'').' ultp-taxonomy-column-'.json_decode(json_encode($attr['columns']), True)['lg'].' ultp-taxonomy-layout-'.$attr['layout'].'">';
                        foreach ($recent_posts as $value) {
                            $_style = ( ($attr["customTaxColor"] && $value['color'])  ? ' style="background-color:'.$value['color'].';"' : '');
                            $_style_color = ((in_array($attr['layout'], [1,4,5]) && $value['color'] && $attr["customTaxTitleColor"] ) ? ' style="color:'.$value['color'].';"' : '');
                            $_style_title_bg = ((in_array($attr['layout'], [7,8]) && $value['color'] && $attr["customTaxTitleColor"] ) ? ' style="background:'.$value['color'].';"' : '');

                            $post_loop .= '<li class="ultp-block-item ultp-taxonomy-item">';

                                $style = in_array($attr['layout'], [2,3,6,7,8]) ? 'style="background-image:'.($value['image'] ? 'url('.$value['image'].')' : $value['color']).'"' : '';
                                $name = ($attr['titleShow'] && $value['name']) ? '<span class="ultp-taxonomy-name" '.$_style_color.'>'.$value['name'].'</span>' : '';
                                $count = ($attr['countShow'] && $value['count']) ? '<span class="ultp-taxonomy-count" '.$_style_color.'>'.$value['count'].'</span>' : '';
                                $excerpt = ($attr['excerptShow'] && $value['desc']) ? '<div class="ultp-taxonomy-desc">'.$value['desc'].'</div>' : '';

                                $post_loop .= '<a href="'.$value['url'].'" '.($attr['layout'] != 3 ? $style : '').'>';
                                    switch ($attr['layout']) {
                                        case 1:
                                            $post_loop .= $name.$count.$excerpt;
                                            break;
                                        case 2:
                                            $post_loop .= '<div class="ultp-taxonomy-lt2-overlay"'.$_style.'></div><div class="ultp-taxonomy-lt2-content">'.$name.'<span class="ultp-taxonomy-bar"></span>'.$count.'</div>'.$excerpt;
                                            break;
                                        case 3:
                                            $post_loop .= '<div class="ultp-taxonomy-lt3-img" '.$style.'></div><div class="ultp-taxonomy-lt3-overlay"'.$_style.'></div><div class="ultp-taxonomy-lt3-content">'.$name.'<span class="ultp-taxonomy-bar"></span>'.$count.'</div>'.$excerpt;
                                            break;
                                        case 4:
                                            $img = $value['image'] ? '<img src="'.$value['image'].'" alt="'.$value['name'].'"/>' : '';
                                            $post_loop .= $img.'<div class="ultp-taxonomy-lt4-content">'.$name.$count.'</div>'.$excerpt;
                                            break;
                                        case 5:
                                            $img = $value['image'] ? '<img src="'.$value['image'].'" alt="'.$value['name'].'"/>' : '';
                                            $post_loop .= $img.'<span class="ultp-taxonomy-lt5-content">'.$name.$count.$excerpt.'</span>';
                                            break;
                                        case 6:
                                            $post_loop .= '<div class="ultp-taxonomy-lt6-overlay"'.$_style.'></div>'.$name.$count.$excerpt;
                                            break;
                                        case 7:
                                            $post_loop .= '<div class="ultp-taxonomy-lt7-overlay"'.$_style.'></div><span class="ultp-taxonomy-name" '.$_style_title_bg.'>'.$value['name'].$count.'</span>'.$excerpt;
                                            break;
                                        case 8:
                                            $post_loop .= '<div class="ultp-taxonomy-lt8-overlay"'.$_style.'></div><span class="ultp-taxonomy-name" '.$_style_title_bg.'>'.$value['name'].$count.'</span>'.$excerpt;
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                $post_loop .= '</a>';
                            $post_loop .= '</li>';
                            $idx ++;
                        }
                        $wraper_after .= '</ul>';
                    $wraper_after .= '</div>';//ultp-block-items-wrap
                $wraper_after .= '</div>';
            $wraper_after .= '</div>';
            wp_reset_query();
        }

        return $noAjax ? $post_loop : $wraper_before.$post_loop.$wraper_after;
    }

}