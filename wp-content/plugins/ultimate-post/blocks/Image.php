<?php
namespace ULTP\blocks;

defined('ABSPATH') || exit;

class Image{
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
            // Image Setting/Style
            //--------------------------
            'imageUpload' => [
                'type' => 'object',
                'default' => (object)[ 'id'=>'999999', 'url' => ULTP_URL.'assets/img/ultp-placeholder.jpg' ],
            ],
            'linkType' => [
                'type' => 'string',
                'default' => 'link',
            ],
            'imgLink' => [
                'type' => 'string',
                'default' => '',
            ],
            'linkTarget' => [
                'type' => 'string',
                'default' => '_blank',
            ],
            'imgAlt' => [
                'type' => 'string',
                'default' => 'Image',
            ],
            'imgAlignment' => [
                'type' => 'object',
                'default' =>  ['md' => 'left'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper {text-align: {{imgAlignment}};}'
                    ],
                ],
            ],
            'imgWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block { max-width: {{imgWidth}}; }'
                    ],
                ],
            ],
            'imgHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block {object-fit: cover; height: {{imgHeight}}; } {{ULTP}} .ultp-image-block .ultp-image {height: 100%;object-fit: cover; }'
                    ],
                ],
            ],
            'imgAnimation' => [
                'type' => 'string',
                'default' => 'none',
            ],
            'imgGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image { filter: grayscale({{imgGrayScale}}); }'
                    ],
                ],
            ],
            'imgHoverGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper:hover .ultp-image { filter: grayscale({{imgHoverGrayScale}}); }'
                    ],
                ],
            ],
            'imgRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block { border-radius:{{imgRadius}}; }'
                    ],
                ],
            ],
            'imgHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper:hover .ultp-image-block { border-radius:{{imgHoverRadius}}; }'
                    ],
                ],
            ],
            'imgShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block'
                    ],
                ],
            ],
            'imgHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper:hover .ultp-image-block'
                    ],
                ],
            ],
            'imgMargin' => [
                'type' => 'object',
                'default' => (object)['lg'=>''],
                'style' => [
                    (object)[
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper { margin: {{imgMargin}}; }'
                    ],
                ],
            ],
            'imgOverlay' => [
               'type' => 'boolean',
                'default' => false,
            ],
            'imgOverlayType' => [
                'type' => 'string',
                'default' => 'default',
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
                        'selector'=>'{{ULTP}} .ultp-image-block::before'
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
                        'selector'=>'{{ULTP}} .ultp-image-block::before { opacity: {{imgOpacity}}; }'
                    ],
                ],
            ],

            //Caption
            'headingText' => [
                'type' => 'string',
                'default' => 'This is a Image Example',
            ],
            'headingEnable' => [
                'type' => 'boolean',
                'default' => false
            ],
            'headingColor' => [
                'type' => 'string',
                'default' =>  '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingEnable','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-caption { color:{{headingColor}}; }'
                    ],
                ],
            ],
            'alignment' => [
                'type' => 'object',
                'default' =>  ['md' => 'left'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingEnable','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-caption {text-align: {{alignment}};}'
                    ],
                ],
            ],
            'headingTypo' => [
                'type' => 'object',
                'default' =>  (object)['openTypography' => 1,'size' => (object)['lg' => '14', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingEnable','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-caption'
                    ],
                ],
            ],
            'headingMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'depends' => [
                            (object)['key'=>'headingEnable','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-caption { margin:{{headingMargin}}; }'
                    ],
                ],
            ],


            //--------------------------
            //  Button Setting & Style
            //--------------------------
            'buttonEnable' => [
                'type' => 'boolean',
                'default' => false
            ],
            'btnText' => [
                'type' => 'string',
                'default' => 'Free Download',
            ],
            'btnLink' => [
                'type' => 'string',
                'default' => '#',
            ],
            'btnTarget' => [
                'type' => 'string',
                'default' => '_blank',
            ],
            'btnPosition' => [
                'type' => 'string',
                'default' => 'centerCenter',
            ],

            //style
            'btnTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>14, 'unit' =>'px'], 'height' => (object)['lg' =>20, 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => 'capitalize', 'weight' => '', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a'
                    ],
                ],
            ],
            'btnColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a { color:{{btnColor}}; }'
                    ],
                ],
            ],
            'btnBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#037fff'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a'
                    ],
                ],
            ],
            'btnBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a'
                    ],
                ],
            ],
            'btnRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a { border-radius:{{btnRadius}}; }'
                    ],
                ],
            ],
            'btnShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a'
                    ],
                ],
            ],
            'btnHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a:hover { color:{{btnHoverColor}}; }'
                    ],
                ],
            ],
            'btnBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#1239e2'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a:hover'
                    ],
                ],
            ],
            'btnHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a:hover'
                    ],
                ],
            ],
            'btnHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a:hover { border-radius:{{btnHoverRadius}}; }'
                    ],
                ],
            ],
            'btnHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a:hover'
                    ],
                ],
            ],
            'btnSacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 0,'bottom' => 0,'left' => 0,'right' => 0, 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a { margin:{{btnSacing}}; }'
                    ],
                ],
            ],
            'btnPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "6",'bottom' => "6",'left' => "12",'right' => "12", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'linkType','condition'=>'==','value'=>'button'],
                        ],
                        'selector'=>'{{ULTP}} .ultp-image-block-wrapper .ultp-image-button a { padding:{{btnPadding}}; }'
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
        register_block_type( 'ultimate-post/image',
            array(
                'title' => __('Image', 'ultimate-post'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            )
        );
    }

    public function content($attr, $noAjax) {
        $wraper_before = '';
        $block_name = 'image';
        $attr['headingShow'] = true;
        $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-ultimate-post-'.$block_name.' ultp-block-'.$attr["blockId"].''.(isset($attr["align"])? ' align' .$attr["align"]:'').''.(isset($attr["className"])?' '.$attr["className"]:'').'">';
            $wraper_before .= '<div class="ultp-block-wrapper">';
                $wraper_before .= '<figure class="ultp-image-block-wrapper">';
                    $wraper_before .= '<div class="ultp-image-block ultp-image-block-'.$attr['imgAnimation'].($attr["imgOverlay"] ? ' ultp-image-block-overlay ultp-image-block-'.$attr["imgOverlayType"] : '' ).'">';
                        // Single Image
                        $img_arr = (array)$attr['imageUpload'];
                        if( !empty($img_arr) ){
                            if(  ($attr['linkType'] == 'link') && $attr['imgLink'] ){
                                $wraper_before .= '<a href="'.$attr['imgLink'].'" target="'.$attr['linkTarget'].'">'.ultimate_post()->get_image_html($img_arr['url'], 'full', 'ultp-image', $attr['imgAlt']).'</a>';
                            } else {
                                $wraper_before .= ultimate_post()->get_image_html($img_arr['url'], 'full', 'ultp-image', $attr['imgAlt']);
                            }
                        }
                        if( $attr['btnLink'] && ($attr['linkType'] == 'button') ){
                            $wraper_before .= '<div class="ultp-image-button ultp-image-button-'.$attr['btnPosition'].'"><a href="'.$attr['btnLink'].'" target="'.$attr['btnTarget'].'">'.$attr['btnText'].'</a></div>';
                        }
                    $wraper_before .= '</div>';
                    if( $attr['headingEnable'] == 1 ){
                        $wraper_before .= '<figcaption class="ultp-image-caption">'.$attr['headingText'].'</figcaption>';
                    }
                $wraper_before .= '</figure>';
            $wraper_before .= '</div>';
        $wraper_before .= '</div>';

        return $wraper_before;
    }

}