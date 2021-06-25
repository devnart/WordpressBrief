<?php
/**
 * Notice Action.
 * 
 * @package ULTP\Notice
 * @since v.1.0.0
 */
namespace ULTP;

defined('ABSPATH') || exit;

/**
 * Notice class.
 */
class Notice {

    /**
	 * Setup class.
	 *
	 * @since v.1.0.0
	 */
    public function __construct(){
		//add_action('admin_notices', array($this, 'ultp_installation_notice_callback'));
		add_action('wp_ajax_ultp_get_pro_notice', array($this, 'set_dismiss_notice_callback'));
	}


    /**
	 * Promotional Dismiss Notice Option Data
     * 
     * @since v.2.0.1
	 * @param NULL
	 * @return NULL
	 */
	public function set_dismiss_notice_callback() {
		if (!wp_verify_nonce($_REQUEST['wpnonce'], 'ultp-free-nonce')) {
			return ;
        }
        set_transient( 'ultp_get_pro_notice_v14', 'off', 2592000 ); // 30 days notice
	}


    /**
	 * Dismiss Notice HTML Data
     * 
     * @since v.1.0.0
	 * @param NULL
	 * @return STRING
	 */
	public function ultp_installation_notice_callback() {
		if (get_transient('ultp_get_pro_notice_v14') != 'off' && (!defined('ULTP_PRO_VER'))) {
			$this->ultp_notice_css();
			$this->ultp_notice_js();
			?>
            <div class="wc-install ultp-pro-notice">
				<div class="wc-install-body">
                    <a class="wc-dismiss-notice" data-security=<?php echo wp_create_nonce('ultp-free-nonce'); ?>  data-ajax=<?php echo admin_url('admin-ajax.php'); ?> href="#"><span class="dashicons dashicons-dismiss"></span></a>
                    <div><?php _e('Special offer for <strong>PostX - Gutenberg Post Blocks</strong>. Limited time offer. You can get <strong style="color:#e5561e;">up to 45% Off</strong> for all premium features.', 'ultimate-post'); ?></div>
                    <a class="button button-primary button-hero ultp-btn-notice-pro" target="_blank" href="<?php echo ultimate_post()->get_premium_link(); ?>"><span class="dashicons dashicons-image-rotate"></span><?php _e('Get Now', 'ultimate-post'); ?></a>
                </div>
			</div>
			<?php
		}
	}


    /**
	 * Admin Notice CSS File
     * 
     * @since v.1.0.0
	 * @param NULL
	 * @return STRING
	 */
	public function ultp_notice_css() {
		?>
		<style type="text/css">
            .wc-install {
                display: flex;
                align-items: center;
                background: #fff;
                margin-top: 40px;
                width: calc(100% - 50px);
                /* width: calc(100% - 40px); */
                border: 1px solid #ccd0d4;
                /* padding: 8px 8px 4px 8px; */
                padding: 12px 15px;
                border-radius: 4px;
                border-left: 4px solid #e5561e;
            }   
            .wc-install img {
                margin-right: 0; 
                max-width: 100%;
            }
            .wc-install-body {
                -ms-flex: 1;
                flex: 1;
                position: relative;
            }
            .wc-install-body > div {
                max-width: 450px;
                margin-bottom: 20px;
            }
            .wc-install-body h3 {
                margin-top: 0;
                font-size: 24px;
                margin-bottom: 15px;
            }
            .ultp-install-btn {
                margin-top: 15px;
                display: inline-block;
            }
			.wc-install .dashicons{
				display: none;
				animation: dashicons-spin 1s infinite;
				animation-timing-function: linear;
			}
			.wc-install.loading .dashicons {
				display: inline-block;
				margin-top: 12px;
				margin-right: 5px;
			}
            .ultp-pro-notice .wc-install-body h3 {
                font-size: 20px;
                margin-bottom: 5px;
            }
            .ultp-pro-notice .wc-install-body > div {
                max-width: 800px;
                margin-bottom: 10px;
            }
            .ultp-pro-notice .button-hero {
                padding: 8px 14px !important;
                min-height: inherit !important;
                line-height: 1 !important;
                /* background: #46b450; */
                box-shadow: none;
                border: none;
                transition: 400ms;
            }
            .ultp-pro-notice .ultp-btn-notice-pro {
                background: #e5561e;
                color: #fff;
            }
            .ultp-pro-notice .ultp-btn-notice-pro:hover,
            .ultp-pro-notice .ultp-btn-notice-pro:focus {
                background: #ce4b18;
            }
            .ultp-pro-notice .button-hero:hover,
            .ultp-pro-notice .button-hero:focus {
                /* background: #349a3d; */
                border: none;
                box-shadow: none;
            }
			@keyframes dashicons-spin {
				0% {
					transform: rotate( 0deg );
				}
				100% {
					transform: rotate( 360deg );
				}
			}
			.wc-dismiss-notice {
                position: absolute;
                text-decoration: none;
                float: right;
                right: 0px;
                /* color: #ffffff; */
                transition: 400ms;
                top: 0px
            }
			.wc-dismiss-notice .dashicons{
                display: inline-block;
                text-decoration: none;
                animation: none;
                font-size: 20px;
                /* width: 25px;
                height: 25px;
                line-height: 25px;
                border-radius: 100px;
                background: #f81430; */
			}
            /* .wc-dismiss-notice:hover {
                color: #fff;
            } */
            /* .wc-dismiss-notice:hover .dashicons{
                background: #cc142a;
            }  */
		</style>
		<?php
    }


    /**
	 * Admin Notice JS File
     * 
     * @since v.1.0.0
	 * @param NULL
	 * @return STRING
	 */
	public function ultp_notice_js() { ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				'use strict';
				// Dismiss notice
				$(document).on('click', '.wc-dismiss-notice', function(e){
					e.preventDefault();
					const that = $(this);
					$.ajax({
						url: that.data('ajax'),
						type: 'POST',
						data: { 
							action: 'ultp_get_pro_notice', 
							wpnonce: that.data('security')
						},
						success: function (data) {
							that.parents('.wc-install').hide("slow", function() { that.parents('.wc-install').remove(); });
						},
						error: function(xhr) {
							console.log('Error occured. Please try again' + xhr.statusText + xhr.responseText );
						},
					});
				});
			});
		</script>
		<?php
	}
}