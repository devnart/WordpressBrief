<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Options_Features{
    public function __construct() {
        if (!function_exists('ultimate_post_pro')) {
            add_submenu_page('ultp-settings', 'Pro Features', 'Pro Features', 'manage_options', 'ultp-features', array( self::class, 'create_admin_page'), 5);
        }
    }

    /**
     * Settings page output
     */
    public static function create_admin_page() { ?>
        <div class="ultp-option-body">
            
            <?php require_once ULTP_PATH . 'classes/options/Heading.php'; ?>

            <div class="ultp-content-wrap">
                <div class="ultp-features ultp-admin-card">
                    <div class="ultp-text-center"><h2 class="ultp-admin-title"><?php _e('Pro Features', 'ultimate-post'); ?></h2></div> 
                    <div class="ultp-feature-items"> 
                        <div class="ultp-feature-item">
                            <div class="ultp-feature-image">
                                <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/pro-f1.png'; ?>" alt="Filter Category">    
                            </div>
                            <div class="ultp-feature-content">
                                <h4><?php _e('Quick Query Builder', 'ultimate-post'); ?></h4> 
                                <div><?php _e('With a single click, you can change your query, no coding skill is required whatsoever. Most Comments, Most Popular, Latest Posts, and many more pre-defined queries are available for your convenience.', 'ultimate-post'); ?></div>
                            </div>
                        </div>
                        <div class="ultp-feature-item">
                            <div class="ultp-feature-image">
                                <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/pro-f2.png'; ?>" alt="Starter Packs"> 
                            </div> 
                            <div class="ultp-feature-content">
                                <h4><?php _e('Starter Packs', 'ultimate-post'); ?></h4> 
                                <div><?php _e('A large number of starter packs and pre-made designs are added to our starter pack library. So, you don’t need any designing skills on your part. Simply, choose, click, and import.', 'ultimate-post'); ?></div>
                            </div>
                        </div>

                        <div class="ultp-feature-item">
                            <div class="ultp-feature-image">
                                <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/pro-f3.png'; ?>" alt="Ready-made Designs"> 
                            </div> 
                            <div class="ultp-feature-content">
                                <h4><?php _e('Ready-made Designs', 'ultimate-post'); ?></h4> 
                                <div><?php _e('A large number of readymade designs and pre-made layouts are added to our starter pack library. You no longer need any designing skills on your part. Simply, choose, click, and import.', 'ultimate-post'); ?></div>
                            </div>
                        </div>
                        
                        <div class="ultp-feature-item"> 
                            <div class="ultp-feature-image"> 
                                <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/admin/pro-f4.png'; ?>" alt="Filter Category">
                            </div>
                            <div class="ultp-feature-content"> 
                                <h4><?php _e('Image Loading', 'ultimate-post'); ?></h4> 
                                <div><?php _e('Image loading issues result in bad user experiences for your visitors and users. To improve the user experience, we have added an image lazy loading feature. Your users need not suffer any longer.', 'ultimate-post'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="ultp-text-center">
                        <a class="ultp-btn ultp-btn-primary" target="_blank" href="<?php echo ultimate_post()->get_premium_link(); ?>"><?php esc_html_e('More Features', 'ultimate-post'); ?></a>
                    </div> 
                </div>
            </div><!--/features-->

            <div class="ultp-content-wrap ultp-testimonial">
                <div class="ultp-text-center"><h2 class="ultp-admin-title"><?php _e('Reviews & Testimonials', 'ultimate-post'); ?></h2></div> 
                <div class="ultp-testimonial-items">
                    <div class="ultp-testimonial-item">
                        <div class="ultp-admin-card">
                            <div><?php _e('Plugin is excellent! Thank you for rarely a good great free plugin! To many options, easy to use.I really needed this plugin for the site i’m developing! No errors(bug)! I strongly recommend it! Please next update give to us ???? in options “Order By”: more option like: hits, most popular,last 24hour! Of course if possible', 'ultimate-post'); ?></div>
                            <h3><?php _e('@blumen – A lot of option easy to use!', 'ultimate-post'); ?></h3>
                            <div class="ultp-reviews-rating"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>
                        </div>
                        <div class="ultp-admin-card">
                            <div><?php _e('I have been searching for hours for a plugin like this. Tried all plugins and this is the best! It’s wonderful, easy to use and so many themes to choose from. I can’t believe it’s free!', 'ultimate-post'); ?></div>
                            <h3><?php _e('@laursen299 – Lot of options and works well', 'ultimate-post'); ?></h3>
                            <div class="ultp-reviews-rating"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>
                        </div>
                    </div>
                    <div class="ultp-testimonial-item">
                        <div class="ultp-admin-card">
                            <div><?php _e('I was surprised by the versatility of this plugin. It’s great the other and most important thing is I contacted the developers and they have resolved both my doubts and fixed some minor problems. Thank you!!!!!', 'ultimate-post'); ?></div>
                            <h3><?php _e('@mparraud – Really good plugin!', 'ultimate-post'); ?></h3>
                            <div class="ultp-reviews-rating"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>
                        </div>
                        <div class="ultp-admin-card">
                            <div><?php _e('A great plugin for a blog or news site, with its help you can create not only the main page, but also display similar or recent posts by tags or categories, add exceptions. It has many ready-made styles that you can refine yourself, as there is a block for custom code.', 'ultimate-post'); ?></div>
                            <h3><?php _e('@nalitana – There are no analogues', 'ultimate-post'); ?></h3>
                            <div class="ultp-reviews-rating"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>
                        </div>
                    </div>
                </div>
            </div><!--/testimonials-->

            <div class="ultp-content-wrap ultp-compare-table">
                <div class="ultp-text-center"><h2 class="ultp-admin-title"><?php _e('Free Vs Pro Comparison', 'ultimate-post'); ?></h2></div> 
                <div class="ultp-compare-table-content">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2"><?php _e('Core Features', 'ultimate-post');?></th>
                                <th colspan="2"><?php _e('Free', 'ultimate-post');?></th>
                                <th colspan="2"><?php _e('Pro', 'ultimate-post');?></th>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Starter Packs', 'ultimate-post');?></td>
                                <td colspan="2">3</td>
                                <td colspan="2">10+</td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Ready-made Block Design', 'ultimate-post');?></td>
                                <td colspan="2">11</td>
                                <td colspan="2">88+</td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Archive Builder', 'ultimate-post');?></td>
                                <td colspan="2"><i class="dashicons dashicons-no-alt"></i></td>
                                <td colspan="2"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Advanced Quick Query', 'ultimate-post');?></td>
                                <td colspan="2"><i class="dashicons dashicons-no-alt"></i></td>
                                <td colspan="2"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Image Loading', 'ultimate-post');?></td>
                                <td colspan="2"><i class="dashicons dashicons-no-alt"></i></td>
                                <td colspan="2"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Specific Category Color', 'ultimate-post');?></td>
                                <td colspan="2"><i class="dashicons dashicons-no-alt"></i></td>
                                <td colspan="2"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?php _e('Priority Support', 'ultimate-post');?></td>
                                <td colspan="2"><i class="dashicons dashicons-no-alt"></i></td>
                                <td colspan="2"><i class="dashicons dashicons-yes"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="ultp-compare-button">
                        <a class="ultp-btn ultp-btn-transparent" href="http://ultp.wpxpo.com/" target="_blank" rel="noopener noreferrer"><?php _e('Live Demo', 'ultimate-post'); ?></a>
                        <a class="ultp-btn ultp-btn-primary" href="<?php echo ultimate_post()->get_premium_link(); ?>"><?php _e('Buy Now', 'ultimate-post'); ?></a>
                    </div>
                </div>
            </div><!--/compare-->

            <div class="ultp-money-back">
                <div class="ultp-content-wrap">
                    <div class="ultp-money-back-item">
                        <div class="ultp-money-back-image">
                            <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/money-back.svg'; ?>" alt="<?php _e('Money Back', 'ultimate-post'); ?>">
                        </div>
                        <div class="ultp-money-back-content">
                            <h3><?php _e('100% No-Risk Money Back Guarantee! <span>(No questions asked!)</span>', 'ultimate-post'); ?></h3>
                            <div><?php _e('You are fully protected by our 100% No-Risk Double-Guarantee. If you don’t like  plugins over the next 14 days, then we will happily refund 100% of your money.', 'ultimate-post'); ?></div>
                            <img loading="lazy" src="<?php echo ULTP_URL.'assets/img/credit-cards.svg'; ?>" alt="<?php _e('Credit Cards', 'ultimate-post'); ?>">
                        </div>
                    </div>
                </div>
            </div><!--/money back-->

            <?php require_once ULTP_PATH . 'classes/options/Footer.php'; ?>

        </div>

    <?php }
}

