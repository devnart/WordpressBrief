<?php
namespace ULTP;

defined('ABSPATH') || exit;

class Options_Contact{
    public function __construct() {
        add_submenu_page('ultp-settings', 'Contact', 'Contact / Support', 'manage_options', 'ultp-contact', array( self::class, 'create_admin_page'), 20);
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
            <?php require_once ULTP_PATH . 'classes/options/Footer.php'; ?>
        </div>

    <?php }
}