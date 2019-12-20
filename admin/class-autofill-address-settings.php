<?php

    if ( ! defined('ABSPATH')){
        exit;
    }

    class Wc_Autofill_Address_Settings{

        function __construct(){

            add_action('admin_menu', array($this, 'waa_admin_settings'));
            add_action('admin_init', array($this, 'waa_register_settings'));
            add_action( 'update_option_waa_google_map_api_key', 'waa_display_msg_after_save', 10, 3 );
            add_action('admin_notices', array($this,'display_notice'));
        }

        function waa_admin_settings(){
            add_menu_page( 'Autofill Address', 'Autofill Address', 'manage_options', 'autofill-address', array($this,'waa_admin_settings_field' ),'',70);
        }

        function waa_admin_settings_field(){
            require plugin_dir_path( __DIR__ ).'admin/views/admin-settings-field.php';
        }

        function waa_register_settings(){
            register_setting('waa_autofill_settings','waa_google_map_api_key');
        }

        function waa_display_msg_after_save($old_value,$new_value,$option){
            set_transient('waa_setting_save','Settings saved.');
        }

        function display_notice(){
            if(!empty(get_transient('waa_setting_save'))) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><strong>Settings saved.</strong></p>
                </div>
                <?php
                    delete_transient('waa_setting_save');
            }
        }

    }
    new Wc_Autofill_Address_Settings();