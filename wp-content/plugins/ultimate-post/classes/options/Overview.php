<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Options_Overview{
    public function __construct() {
        add_submenu_page('ultp-settings', 'Overview', 'Overview', 'manage_options', 'ultp-settings', array( self::class, 'create_admin_page'), 0);
    }

    /**
     * Settings page output
     */
    public static function create_admin_page() { ?>
        <style>
            .style-css{
                background-color: #f2f2f2;
                -webkit-font-smoothing: subpixel-antialiased;
            }
        </style>

        <div class="ultp-option-body">
            
            <?php require_once ULTP_PATH . 'classes/options/Heading.php'; ?>

            <div class="ultp-tab-wrap">
                <div class="ultp-content-wrap">
                    <div class="ultp-overview-wrap">
                        <div class="ultp-tab-content-wrap">
                            <div class="ultp-overview ultp-admin-card">
                                <iframe width="650" height="350" src="https://www.youtube.com/embed/_GfXTvSdJTk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <div class="ultp-overview-btn">
                                        <a href="https://ultp.wpxpo.com/" class="ultp-btn ultp-btn-primary"><?php esc_html_e('Live Preview', 'ultimate-post'); ?></a>
                                        <a class="ultp-btn ultp-btn-transparent" target="_blank" href="<?php echo ultimate_post()->get_premium_link(); ?>"><?php esc_html_e('Plugin Details', 'ultimate-post'); ?></a>
                                    </div>
                            </div>
                        </div><!--/overview-->
                        
                        <div class="ultp-admin-sidebar">
                            <div class="ultp-sidebar ultp-admin-card">
                                <h3><?php esc_html_e('Plugins Feature', 'ultimate-post'); ?></h3>
                                <p><?php esc_html_e('PostX plugin helps to create beautiful post grid, post listing, dynamic post slider and post carousel within a few seconds.', 'ultimate-post'); ?></p>
                                <ul class="ultp-sidebar-list">
                                    <li><?php esc_html_e('Archive Builder.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Custom Taxonomy Support.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Block Layout Options.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Ready-made Start Packs.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Advanced Quick Query Feature.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Get Category Specific Color and Image Feature.', 'ultimate-post'); ?></li>
                                    <li><?php esc_html_e('Get Fast & Quick Support.', 'ultimate-post'); ?></li>
                                </ul>
                                <?php if(!function_exists('ultimate_post_pro')) { ?>
                                    <a href="<?php echo ultimate_post()->get_premium_link(); ?>" target="_blank" class="ultp-btn ultp-btn-primary ultp-btn-pro"><?php esc_html_e('Upgrade Pro  ➤', 'ultimate-post'); ?></a>
                                <?php } ?>
                            </div>
                        </div><!--/sidebar-->
                    </div>
                </div><!--/overview wrapper-->

                <div class="ultp-content-wrap">
                    <div class="ultp-promo-items">
                        <div class="ultp-promo-item ultp-admin-card">
                            <h4><?php _e('<strong>Archive</strong> Builder <span style="color:#25b425">(Pro)</span>', 'ultimate-post'); ?></h4> 
                        </div>
                        <div class="ultp-promo-item ultp-admin-card">
                            <h4><?php _e('Advanced <strong>Query</strong> Builder', 'ultimate-post'); ?></h4> 
                        </div>
                        <div class="ultp-promo-item ultp-admin-card">
                            <h4><?php _e('<strong>AJAX</strong> Powered Post Filter', 'ultimate-post'); ?></h4> 
                        </div>
                        <div class="ultp-promo-item ultp-admin-card">
                            <h4><?php _e('Quick <strong>Query</strong> Builder', 'ultimate-post'); ?></h4> 
                        </div>
                        <div class="ultp-promo-item ultp-admin-card">
                            <h4><?php _e('Ready-made <strong>Starter</strong> Packs', 'ultimate-post'); ?></h4> 
                        </div>
                    </div>
                </div><!--/Promo-->

                <div class="ultp-content-wrap">
                    <div class="ultp-featured-item ultp-admin-card">   
                        <div class="ultp-featured-image"> 
                            <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/starter-packs.png'; ?>" alt="Filter Category"> 
                        </div>
                        <div class="ultp-featured-content">     
                            <h4><?php _e('Design Library', 'ultimate-post'); ?></h4> 
                            <p><?php _e('PostX comes with a rich and beautiful ready-made starter pack and design library. It helps you create a beautiful website without the knowledge of web design.', 'ultimate-post'); ?></p>       
                            <a class="ultp-btn ultp-btn-primary" target="_blank" href="https://ultp.wpxpo.com/starter-packs/"><?php _e('Explore Details', 'ultimate-post'); ?></a>
                        </div>
                    </div>
                </div><!--/ultp-featured-item-->

                <div class="ultp-content-wrap">
                    <div class="ultp-features ultp-admin-card"> 
                        <div class="ultp-text-center"><h2 class="ultp-admin-title"><?php _e('Core Features', 'ultimate-post'); ?></h2></div> 
                        <div class="ultp-feature-items">    
                            <div class="ultp-feature-item">    
                                <div class="ultp-feature-image">    
                                    <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/free-f1.png'; ?>" alt="Filter Category">        
                                </div>
                                <div class="ultp-feature-content">    
                                    <h4><?php _e('AJAX Powered Post Filter', 'ultimate-post'); ?></h4> 
                                    <div><?php _e('A category or tag filter is the best tool to show several contents in a small place. By clicking on category or tag users can easily read the content they are interested in.', 'ultimate-post'); ?></div>
                                </div>
                            </div>
                            <div class="ultp-feature-item"> 
                                <div class="ultp-feature-image">    
                                    <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/free-f2.png'; ?>" alt="Filter Category">        
                                </div>   
                                <div class="ultp-feature-content">    
                                    <h4><?php _e('Advanced Pagination Options', 'ultimate-post'); ?></h4> 
                                    <div><?php _e('PostX comes with an AJAX-powered Pagination system, that’s why content is loaded without reloading the whole page.', 'ultimate-post'); ?></div>
                                </div>
                            </div>
                            <div class="ultp-feature-item">    
                                <div class="ultp-feature-image">    
                                    <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/free-f3.png'; ?>" alt="Filter Category">        
                                </div>
                                <div class="ultp-feature-content">    
                                    <h4><?php _e('Awesome Typography Control', 'ultimate-post'); ?></h4> 
                                    <div><?php _e('Typography is one of the major concerns for readability. PostX accumulates all the Google free fonts in one place for your convenience.', 'ultimate-post'); ?></div>
                                </div>
                            </div>
                            <div class="ultp-feature-item"> 
                                <div class="ultp-feature-image">    
                                    <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/free-f4.png'; ?>" alt="Filter Category">        
                                </div>   
                                <div class="ultp-feature-content">    
                                    <h4><?php _e('Dynamic Post Slider', 'ultimate-post'); ?></h4> 
                                    <div><?php _e('Post Sliders are now easier to build using our post slider blocks. It is fully dynamic and can be used with any custom query to display your posts.', 'ultimate-post'); ?></div>
                                </div>
                            </div>  
                        </div>
                        <div class="ultp-text-center">
                            <a class="ultp-btn ultp-btn-primary" target="_blank" href="<?php echo ultimate_post()->get_premium_link(); ?>"><?php esc_html_e('More Features', 'ultimate-post'); ?></a>
                        </div>  
                    </div>  
                </div><!--/feature-->

                <?php require_once ULTP_PATH . 'classes/options/Footer.php'; ?>

            </div>
        </div>

    <?php }
}

