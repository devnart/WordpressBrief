<?php
namespace ULTP\blocks;

defined('ABSPATH') || exit;

class Archive_Title{
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
            'contentAlign' => [
                'type' => 'string',
                'default' => "left",
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'left'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title { text-align:{{contentAlign}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'center'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title { text-align:{{contentAlign}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title { text-align:{{contentAlign}}; }'
                    ],
                ],
            ],
            //--------------------------
            //      General Settings
            //--------------------------
            'titleShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'excerptShow' => [
                'type' => 'boolean',
                'default' => true
            ],
            'prefixShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'showImage' => [
                'type' => 'boolean',
                'default' => false,
            ],
            
            //--------------------------
            //      Title Setting/Style
            //--------------------------
            'titleTag' => [
                'type' => 'string',
                'default' => 'h1',
            ],
            'customTaxTitleColor' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'seperatorTaxTitleLink' => [
                'type' => 'string',
                'default' => admin_url( 'edit-tags.php?taxonomy=category' ),
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'customTaxTitleColor','condition'=>'==','value'=>true],
                        ]
                    ]
                ]
            ],
            'titleColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-name { color:{{titleColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'customTaxTitleColor','condition'=>'==','value'=>false],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-name { color:{{titleColor}}; }'
                    ],
                    
                ],
            ],
            'titleTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'28', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)['lg'=>'32', 'unit'=>'px'],'transform' => '', 'decoration'=>'none','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-name'
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
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-name { padding:{{titlePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Content Setting/Style
            //--------------------------
            'excerptColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'excerptShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-desc { color:{{excerptColor}}; }'
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
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-desc'
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
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-desc { padding: {{excerptPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            //      Prefix Setting/Style
            //--------------------------
            'prefixText' => [
                'type' => 'string',
                'default' => 'Sample Prefix Text',
            ],
            'prefixColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'prefixShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-prefix { color:{{prefixColor}}; }'
                    ],
                ],
            ],
            'prefixTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)['lg'=>'', 'unit'=>'px'],'transform' => 'capitalize', 'decoration'=>'none','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'prefixShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-prefix'
                    ],
                ],
            ],
            'prefixPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>10,'bottom'=>5, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'prefixShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-prefix { padding:{{prefixPadding}}; }'
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
                            (object)['key'=>'layout','condition'=>'==','value'=>['1']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-image { max-width: {{imgWidth}}; }'
                    ],
                ],
            ],
            'imgHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-image {object-fit: cover; height: {{imgHeight}}; }'
                    ],
                ],
            ],
            'imgSpacing' => [
                'type' => 'object',
                'default' => (object)['lg'=>'10'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['1']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-image { margin-bottom: {{imgSpacing}}px; }'
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
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content .ultp-archive-overlay { background:{{TaxWrapBg}}; }'
                    ],
                ],
            ],
            'TaxWrapHoverBg' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'customTaxColor','condition'=>'!=','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content:hover .ultp-archive-overlay { background:{{TaxWrapHoverBg}}; }'
                    ],
                ],
            ],
            'TaxWrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content'
                    ],
                ],
            ],
            'TaxWrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content:hover'
                    ],
                ],
            ],
            'TaxWrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content'
                    ],
                ],
            ],
            'TaxWrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content:hover'
                    ],
                ],
            ],
            'TaxWrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content { border-radius: {{TaxWrapRadius}}; }'
                    ],
                ],
            ],
            'TaxWrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content:hover { border-radius: {{TaxWrapHoverRadius}}; }'
                    ],
                ],
            ],
            'customOpacityTax' => [
                'type' => 'string',
                'default' => .6,
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content .ultp-archive-overlay { opacity: {{customOpacityTax}}; }'
                    ],
                ],
            ],
            'customTaxOpacityHover' => [
                'type' => 'string',
                'default' => .9,
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-taxonomy-items li a:hover .ultp-archive-overlay { opacity: {{customTaxOpacityHover}}; }'
                    ],
                ],
            ],
            'TaxWrapPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '20','bottom' => '20','left' => '20','right' => '20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['2']],
                        ],
                        'selector'=>'{{ULTP}} .ultp-block-archive-title .ultp-archive-content { padding: {{TaxWrapPadding}}; }'
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

            //---------------------
            // Advanced > Responsive 
            //---------------------
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
                'style' => [
                    (object)[
                        'selector' => '{{ULTP}} {display:none;}'
                    ],
                ],
            ],
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
        register_block_type( 'ultimate-post/archive-title',
            array(
                'title' => __('Archive Title', 'ultimate-post'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            )
        );
    }

    public function get_data() {
        if (is_admin()) {
            // For Demonstration Purpose
            return [
                'title' => 'Archive Title',
                'image' => ULTP_URL.'assets/img/builder-fallback.jpg',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam molestie aliquet molestie.',
                'color' => '#037fff'
            ];
        } else {
            if (is_archive()) {
                if (is_category()) {
                    $obj = get_queried_object();
                    $attachment_id = get_term_meta( $obj->term_id, 'ultp_category_image', true );
                    return [
                        'title' => $obj->name,
                        'image' => $attachment_id ? wp_get_attachment_url($attachment_id) : '',
                        'desc' => $obj->description,
                        'color' => get_term_meta( $obj->term_id, 'ultp_category_color', true )
                    ];
                } else if (is_tag()) {
                    $obj = get_queried_object();
                    $attachment_id = get_term_meta( $obj->term_id, 'ultp_category_image', true );
                    return [
                        'title' => $obj->name,
                        'image' => $attachment_id ? wp_get_attachment_url($attachment_id) : '',
                        'desc' => $obj->description,
                        'color' => get_term_meta( $obj->term_id, 'ultp_category_color', true )
                    ];
                } else if (is_date()) {
                    $date = '';
                    if ( is_year() ) {
                        $date = get_the_date('Y');
                    } else if ( is_month() ) {
                        $date = get_the_date('F Y');
                    } else if ( is_day() ) {
                        $date = get_the_date('F j, Y');
                    }
                    return [
                        'title' => $date,
                        'image' => '',
                        'desc' => '',
                        'color' => ''
                    ];
                } else if (is_author()) {
                    return [
                        'title' => get_the_author_meta( 'display_name' ),
                        'image' => get_avatar_url( get_the_author_meta( 'ID' ) ),
                        'desc' => get_the_author_meta( 'user_email' ),
                        'color' => ''
                    ];
                } else if (is_tax()) {
                    $obj = get_queried_object();
                    $attachment_id = get_term_meta( $obj->term_id, 'ultp_category_image', true );
                    return [
                        'title' => $obj->name,
                        'image' => $attachment_id ? wp_get_attachment_url($attachment_id) : '',
                        'desc' => $obj->description,
                        'color' => get_term_meta( $obj->term_id, 'ultp_category_color', true )
                    ];
                }
            } else if (is_search()) {
                return [
                    'title' => get_search_query(),
                    'image' => '',
                    'desc' => '',
                    'color' => ''
                ];
            }
            return ['title' => '', 'image' => '', 'desc' => ''];   
        }
    }


    public function content($attr, $noAjax) {

        // Dummy
        $data = $this->get_data();
        $wraper_before = $wraper_after = $post_loop = '';
        $block_name = 'archive-title';

        $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-ultimate-post-'.$block_name.' ultp-block-'.$attr["blockId"].''.(isset($attr["align"])? ' align' .$attr["align"]:'').''.(isset($attr["className"])?' '.$attr["className"]:'').'">';
            $wraper_before .= '<div class="ultp-block-wrapper">';
            $wraper_before .= '<div class="ultp-block-archive-title ultp-archive-layout-'.$attr['layout'].'">';

            $style = $attr['layout'] == '2' ? ($data['image'] ? 'style="background-image: url('.$data['image'].')' : 'style="background-color:'.($data['color'] ? $data['color'] : '#28303d')).'"' : '';
            $prefix = ($attr['prefixShow'] && $attr['prefixText']) ? '<span class="ultp-archive-prefix">'.$attr['prefixText'].'</span> ' : '';

            $name = ($attr['titleShow'] && $data['title']) ? '<'.$attr['titleTag'].' class="ultp-archive-name" '.( ( $data['color'] && $attr['customTaxTitleColor'] ) ? 'style="color: '.$data['color'].'"' : '').'>'.$prefix.$data['title'].'</'.$attr['titleTag'].'>' : '';
            
            $excerpt = ($attr['excerptShow'] && $data['desc']) ? '<div class="ultp-archive-desc">'.$data['desc'].'</div>' : '';

                // Prefix
                switch ($attr['layout']) {
                    case 1:
                        $img = ($attr['showImage'] && $data['image']) ? '<img class="ultp-archive-image" src="'.$data['image'].'" alt="'.$data['title'].'"/>' : '';
                        $post_loop .= $img.$name.$excerpt;
                        break;
                    case 2:
                        $style_overlay = $attr['customTaxColor'] ? 'style="background-color: '.$data['color'].'"' : '';

                        $post_loop .= '<div class="ultp-archive-content" '.$style.'><div class="ultp-archive-overlay" '.$style_overlay.'></div>'.$name.$excerpt.'</div>';
                        break;
                }
            
            $wraper_after .= '</div>';
            $wraper_after .= '</div>';
        $wraper_after .= '</div>';

        return $wraper_before.$post_loop.$wraper_after;
    }

}