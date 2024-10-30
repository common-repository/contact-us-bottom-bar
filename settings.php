<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

add_action('admin_menu', 'contact_us_setup_menu');
function contact_us_setup_menu(){
    add_menu_page( 
        'Contact Us Setting', 
        'Contact Us', 
        'manage_options', 
        'contact-us-settings-page',
        'contact_us_settings_template_callback', 
        'dashicons-email',
        null
    );
}

if (!function_exists('haidm_contact_us')) {
    function haidm_contact_us() {
    ?>
        <?php if( wp_is_mobile() ) { ?>
            <div class="footer-contact-mobile-wrapper text-center">

                    <div class="footer-contact-mobile-content tel">
                        <a target="_blank" href="<?php if ( get_option('contact_us_hotline_number') ) { ?>tel:<?php echo get_option('contact_us_hotline_number'); }else{ ?>#<?php }?>">
                            <p class="icon"></p>
                            
                            <p>Gọi ngay</p>
                        </a>
                    </div>
                
                    <div class="footer-contact-mobile-content messenger">
                        <a target="_blank" href="<?php if ( get_option('contact_us_facebook_messenger_link') ) { echo get_option('contact_us_facebook_messenger_link'); }else{ ?>#<?php } ?>">
                            <p class="icon"></p>
                            
                            <p>FB Chat</p>
                        </a>
                    </div>
                
                    <div class="footer-contact-mobile-content zalo">
                        <a target="_blank" href="<?php if ( get_option('contact_us_zalo_number') ) { ?>https://zalo.me/<?php echo get_option('contact_us_zalo_number'); }else{ ?>#<?php } ?>">
                            <p class="icon"></p>
                            
                            <p>Zalo Chat</p>
                        </a>
                    </div>
                
                    <div class="footer-contact-mobile-content address">
                        <a target="_blank" href="<?php if ( get_option('contact_us_google_map_link') ) { echo get_option('contact_us_google_map_link'); }else{ ?>#<?php } ?>">
                            <p class="icon"></p>
                            
                            <p>Địa chỉ</p>
                        </a>
                    </div>
                                
                </div>
            </div><!-- .footer-contact-wrapper -->
        <?php }else{ ?>
            <div class="footer-contact-wrapper text-center">
                <div class="container">

                    <div class="footer-contact">
                        <span class="tel"><a target="_blank" href="<?php if ( get_option('contact_us_hotline_number') ) { ?>tel:<?php echo get_option('contact_us_hotline_number'); }else{ ?>#<?php }?>"><span class="icon"></span> Gọi ngay</a></span>

                        <span class="messenger"><a target="_blank" href="<?php if ( get_option('contact_us_facebook_messenger_link') ) { echo get_option('contact_us_facebook_messenger_link'); }else{ ?>#<?php } ?>"><span class="icon"></span> Facebook chat</a></span>

                        <span class="zalo"><a target="_blank" href="<?php if ( get_option('contact_us_zalo_number') ) { ?>https://zalo.me/<?php echo get_option('contact_us_zalo_number'); }else{ ?>#<?php } ?>"><span class="icon"></span> Zalo chat</a></span>

                        <span class="address"><a target="_blank" href="<?php if ( get_option('contact_us_google_map_link') ) { echo get_option('contact_us_google_map_link'); }else{ ?>#<?php } ?>"><span class="icon"></span> Địa chỉ</a></span>
                    </div>

                </div>
            </div><!-- .footer-contact-wrapper -->
        <?php } ?>
    <?php
    }
    add_action( 'wp_footer', 'haidm_contact_us' );
}
 
function contact_us_settings_template_callback(){
?>
    <h1>Cài đặt Liên hệ</h1>

    <form method="post" action="options.php">
        <?php
            settings_fields('contact-us-settings-page');

            do_settings_sections('contact-us-settings-page');

            submit_button('Save Settings')
        ?>
    </form>
<?php
}

add_action('admin_init', 'contact_us_settings_init');
function contact_us_settings_init() {
    add_settings_section(
        'contact_us_settings_section',
        '',
        '',
        'contact-us-settings-page'
    );

    register_setting(
        'contact-us-settings-page',
        'contact_us_hotline_number',
        array(
            'type' => 'text',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    add_settings_field(
        'contact_us_hotline_number',
        __('Hotline number', 'hotline-text'),
        'haidm_contact_us_hotline_number_callback',
        'contact-us-settings-page',
        'contact_us_settings_section',
    );

    register_setting(
        'contact-us-settings-page',
        'contact_us_facebook_messenger_link',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Call now'
        )
    );

    add_settings_field(
        'contact_us_facebook_messenger_link',
        __('Facebook Messenger Link', 'facebook-messenger-text'),
        'haidm_contact_us_facebook_messenger_link_callback',
        'contact-us-settings-page',
        'contact_us_settings_section',
    );

    register_setting(
        'contact-us-settings-page',
        'contact_us_zalo_number',
        array(
            'type' => 'text',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Call now'
        )
    );

    add_settings_field(
        'contact_us_zalo_number',
        __('Zalo number', 'zalo-text'),
        'haidm_contact_us_zalo_number_callback',
        'contact-us-settings-page',
        'contact_us_settings_section',
    );

    register_setting(
        'contact-us-settings-page',
        'contact_us_google_map_link',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Call now'
        )
    );

    add_settings_field(
        'contact_us_google_map_link',
        __('Google Map Links', 'google-map-text'),
        'haidm_contact_us_google_map_link_callback',
        'contact-us-settings-page',
        'contact_us_settings_section',
    );
}

function haidm_contact_us_hotline_number_callback() {
    $hotline_number_input_field = get_option('contact_us_hotline_number');
?>

    <input type="text" placeholder="0123456789" name="contact_us_hotline_number" class="regular-text" value="<?php echo isset( $hotline_number_input_field ) ? esc_attr( $hotline_number_input_field ) : ''; ?>" />

<?php
}

function haidm_contact_us_facebook_messenger_link_callback() {
    $facebook_messenger_input_field = get_option('contact_us_facebook_messenger_link');
?>

    <input type="text" placeholder="https://m.me/#" name="contact_us_facebook_messenger_link" class="regular-text" value="<?php echo isset( $facebook_messenger_input_field ) ? esc_attr( $facebook_messenger_input_field ) : 'Call now'; ?>" />

<?php
}

function haidm_contact_us_zalo_number_callback() {
    $zalo_number_input_field = get_option('contact_us_zalo_number');
?>

    <input type="text" placeholder="0123456789" name="contact_us_zalo_number" class="regular-text" value="<?php echo isset( $zalo_number_input_field ) ? esc_attr( $zalo_number_input_field ) : ''; ?>" />

<?php
}

function haidm_contact_us_google_map_link_callback() {
    $google_map_input_field = get_option('contact_us_google_map_link');
?>

    <input type="text" placeholder="https://www.google.com/maps" name="contact_us_google_map_link" class="regular-text" value="<?php echo isset( $google_map_input_field ) ? esc_attr( $google_map_input_field ) : 'Call now'; ?>" />

<?php
}
