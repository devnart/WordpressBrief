<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Options_Settings{
    public function __construct() {
        add_submenu_page('ultp-settings', 'Settings', 'Settings', 'manage_options', 'ultp-option-settings', array( $this, 'create_admin_page'), 15);
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public function register_settings() {
        register_setting( 'ultp_options', 'ultp_options', array( $this, 'sanitize' ) );
    }

    /**
     * Sanitization callback
     */
    public function sanitize( $options ) {
        if ($options) {
            $settings = $this->get_option_settings_keys();
            foreach ($settings as $key) {
                $options[$key] = isset($options[$key]) ? $options[$key] : '';
            }
            $old_data = ultimate_post()->get_setting();
            $options = array_merge($old_data, $options);
        }
        return $options;
    }


    /**
     * Settings Fields Key Return
     */
    public function get_option_settings_keys() {
        $attr = array();
        $data = $this->get_option_settings();
        if (!empty($data)) {
            foreach ($data as $key => $inner_data) {
                if (isset($inner_data['attr'])) {
                    foreach ($inner_data['attr'] as $k => $val) {
                        $attr[] = $k;
                    }
                }
            }
        }
        return $attr;
    }


    /**
     * Settings Field Return
     */
    public function get_option_settings(){
        return apply_filters('ultp_settings', array(
            'general' => array(
                'label' => __('General Settings', 'ultimate-post'),
                'attr' => array(
                    'general_heading' => array(
                        'type'  => 'heading',
                        'label' => __('General Settings', 'ultimate-post'),
                    ),
                    'css_save_as' => array(
                        'type' => 'select',
                        'label' => __('CSS Add Via', 'ultimate-post'),
                        'options' => array(
                            'wp_head'   => __( 'Header - (Internal)','ultimate-post' ),
                            'filesystem' => __( 'File System - (External)','ultimate-post' ),
                        ),
                        'default' => 'wp_head',
                        'desc' => __('Select where you want to save CSS.', 'ultimate-post')
                    ),
                    'preloader_style' => array(
                        'type' => 'select',
                        'label' => __('Preloader Style', 'ultimate-post'),
                        'options' => array(
                            'style1' => __( 'Preloader Style 1','ultimate-post' ),
                            'style2' => __( 'Preloader Style 2','ultimate-post' ),
                        ),
                        'default' => 'style1',
                        'desc' => __('Select Preloader Style.', 'ultimate-post')
                    ),
                    'container_width' => array(
                        'type' => 'number',
                        'label' => __('Container Width', 'ultimate-post'),
                        'default' => '1140',
                        'desc' => __('Change Container Width of the Page Template(PostX Template).', 'ultimate-post')
                    ),
                    'editor_container' => array(
                        'type' => 'select',
                        'label' => __('Editor Container', 'ultimate-post'),
                        'options' => array(
                            'full_width' => __( 'Full Width','ultimate-post' ),
                            'theme_default' => __( 'Theme Default','ultimate-post' )
                        ),
                        'default' => 'full_width',
                        'desc' => __('Select Editor Container Width.', 'ultimate-post')
                    ),
                    'hide_import_btn' => array(
                        'type' => 'switch',
                        'label' => __('Hide Import Button', 'ultimate-post'),
                        'default' => '',
                        'desc' => __('Hide Import Layout Button from the Gutenberg Editor.', 'ultimate-post')
                    ),
                    'disable_image_size' => array(
                        'type' => 'switch',
                        'label' => __('Disable Image Size', 'ultimate-post'),
                        'default' => '',
                        'desc' => __('Disable Image Size of the Plugins.', 'ultimate-post')
                    ),
                )
            )
        ));
    }


    /**
     * Changelog Data
     */
    public function get_changelog_data() {
        $html = '';
        $resource_data = file_get_contents(ULTP_PATH.'/readme.txt', "r");
        $data = array();
        if ($resource_data) {
            $resource_data = explode('== Changelog ==', $resource_data);
            if (isset($resource_data[1])) {
                $resource_data = $resource_data[1];
                $resource_data = explode("\n", $resource_data);
                $inner = false;
                $count = -1;
                
                foreach ($resource_data as $element) {
                    if ($element){
                        if (substr_count($element, '=') > 1) {
                            $count++;
                            $temp = trim(str_replace('=', '', $element));
                            if (strpos($temp, '-') !== false) {
                                $temp = explode('-', $temp);
                                $data[$count]['date'] = trim($temp[1]);
                                $data[$count]['version'] = trim($temp[0]);
                            }
                        }
                        if (strpos($element, '* New:') !== false) {
                            $data[$count]['new'][] = trim(str_replace('* New:', '', $element));
                        }
                        if (strpos($element, '* Fix:') !== false) {
                            $data[$count]['fix'][] = trim(str_replace('* Fix:', '', $element));
                        }
                        if (strpos($element, '* Update:') !== false) {
                            $data[$count]['update'][] = trim(str_replace('* Update:', '', $element));
                        }
                    }
                }
            }
        }
        if (!empty($data)) {
            foreach ($data as $k => $inner_data) {
                $html .= '<div class="ultp-changelog-wrap">';
                foreach ($inner_data as $key => $changelog) {
                    if ($key == 'date') {
                        $html .= '<div class="ultp-changelog-date">'.__('Released on ', 'ultimate-post').' '.$changelog.'</div>';
                    } elseif($key == 'version') {
                        $html .= '<div class="ultp-changelog-version">'.__('Version', 'ultimate-post').' : '.$changelog.'</div>';
                    } else {
                        foreach ($changelog as $keyword => $val) {
                            $html .= '<div class="ultp-changelog-title"><span class="changelog-'.$key.'">'.$key.'</span>'.$val.'</div>';
                        }
                    }
                }
                $html .= '</div>';
            }
        }
        echo $html;
    }


    /**
     * Settings page output
     */
    public function get_settings_data( $data ) {
        $html = '';
        $option_data = ultimate_post()->get_setting();
        
        foreach ($data as $key => $value) {
            if ($value['type'] == 'hidden') {
                $html .= '<input type="hidden" name="ultp_options['.$key.']" value="'.$value['value'].'"/>';
            } else {
                if ($value['type'] == 'heading') {
                    $html .= '<h2 class="ultp-settings-heading">'.$value['label'].'</h2>';
                    if ( isset($value['desc']) ) {
                        $html .= '<div class="ultp-settings-subheading">'.$value['desc'].'</div>';
                    }
                }
                $html .= '<div class="ultp-settings-wrap">';
                if ($value['type'] != 'heading') {
                    if (isset($value['label'])) {
                        $html .= '<div class="ultp-settings-label">'.$value['label'].'</div>';
                    }
                }
                $html .= '<div class="ultp-settings-field-wrap">';
                switch ($value['type']) {
                    case 'select':
                        $html .= '<div class="ultp-settings-field">';
                            $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                            $html .= '<select name="ultp_options['.$key.']">';
                                foreach ( $value['options'] as $id => $label ) {
                                    $html .= '<option value="'.$id.'" '.( $val == $id ? ' selected="selected"':'').'>';
                                    $html .= strip_tags( $label );
                                    $html .= '</option>';
                                }
                                $html .= '</select>';
                            $html .= '<p class="description">'.$value['desc'].'</p>';
                        $html .= '</div>';
                        break;

                    case 'color':
                        $html .= '<div class="ultp-settings-field">';
                            $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                            $html .= '<input name="ultp_options['.$key.']" value="'.$val.'" class="ultp-color-picker" />';
                            $html .= '<p class="description">'.$value['desc'].'</p>';
                        $html .= '</div>';
                        break;

                    case 'number':
                        $html .= '<div class="ultp-settings-field">';
                            $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                            $html .= '<input type="number" name="ultp_options['.$key.']" value="'.$val.'"/>';
                            $html .= '<p class="description">'.$value['desc'].'</p>';
                        $html .= '</div>';
                        break;

                    case 'switch':
                        $html .= '<div class="ultp-settings-field ultp-settings-field-inline">';
                            $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                            $html .= '<input type="checkbox" value="yes" name="ultp_options['.$key.']" '.($val == 'yes' ? 'checked' : '').' />';
                            $html .= '<p class="description">'.$value['desc'].'</p>';
                        $html .= '</div>';
                        break;

                    case 'multiselect':
                        $html .= '<div class="ultp-settings-field">';
                        $saved_val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : []);
                            $html .= '<select style="height:190px;" name="ultp_options['.$key.'][]" multiple>';
                            if (!empty($value['options'])) {
                                foreach ($value['options'] as $val) {
                                    if (!empty($saved_val) && is_array($saved_val)) {
                                        $html .= '<option value="'.$val.'" '.(in_array( $val , $saved_val ) ? 'selected' : '' ).'>'.$val.'</option>';
                                    } else {
                                        $html .= '<option value="'.$val.'">'.$val.'</option>';
                                    }
                                }
                            }
                            $html .= ' </select>';
                        $html .= '</div>';
                        break;

                    default:
                        # code...
                        break;
                }
                $html .= '</div>';
                $html .= '</div>';
            }
        }

        echo $html;
    }

    /**
     * Settings page output
     */
    public function create_admin_page() { 
        $data = self::get_option_settings();
        ?>
        <div class="ultp-option-body">
        
            <?php require_once ULTP_PATH . 'classes/options/Heading.php'; ?>

            <?php $section = isset($_GET['tab']) ? $_GET['tab'] :'general'; ?>
            <div class="ultp-tab-wrap">
                <div class="ultp-tab-title-wrap">
                    <?php foreach ($data as $key => $value) { 
                        if (isset($value['label'])) { ?>
                            <div data-title="<?php echo $key; ?>" class="ultp-tab-title<?php if($section == $key){ echo ' active'; } ?>"><?php echo $value['label']; ?></div>
                        <?php } 
                    } ?>
                    <div data-title="changelog" class="ultp-tab-title<?php if($section == 'changelog'){ echo ' active'; } ?>"><?php _e('Changelog', 'ultimate-post'); ?></div>
                </div>
                <div class="ultp-content-wrap">
                    <form method="post" action="options.php">
                        <div class="ultp-settings">
                            <input type="hidden" name="option_page" value="ultp_options" />
                            <input type="hidden" name="action" value="update" />
                            <?php echo wp_nonce_field( "ultp_options-options" ); ?>
                            <?php foreach ($data as $key => $value) {
                                if (isset($value['attr'])) { ?>
                                    <div class="ultp-tab-content<?php if($section == $key){ echo ' active'; } ?>">
                                        <div class="ultp-tab-overview">
                                            <?php $this->get_settings_data( $value['attr'] ); ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            <div class="ultp-tab-content<?php if($section == 'changelog'){ echo ' active'; } ?>"><!-- #Changelog Content -->
                                <?php $this->get_changelog_data(); ?>
                            </div>
                            <div class="ultp-settings-wrap ultp-submit-button">
                                <div></div><?php echo get_submit_button(); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <script type="text/javascript">
                jQuery( document ).ready(function() {
                    jQuery( document ).on( "click", '.ultp-tab-title', function(e){ 
                        jQuery(this).closest('.ultp-tab-wrap').find('.ultp-tab-title').removeClass('active').eq(jQuery(this).index()).addClass('active')
                        jQuery(this).closest('.ultp-tab-wrap').find('.ultp-tab-content').removeClass('active').eq(jQuery(this).index()).addClass('active');
                        let refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=ultp-option-settings&tab='+jQuery(this).data('title');
                        window.history.pushState({ path: refresh }, '', refresh);
                        jQuery('input[name=_wp_http_referer]').val(window.location.pathname + '?page=ultp-option-settings&tab=general');
                    });
                });
            </script>
        </div>

    <?php }


}