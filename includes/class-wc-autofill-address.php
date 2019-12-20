<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    class Wc_Autofill_Address {

        function __construct()
        {
            add_action('init', array($this, 'waa_load_files'));
        }

        function waa_load_files(){

            if(is_admin()){
                require plugin_dir_path( __DIR__ ).'admin/class-autofill-address-settings.php';
            }else{
                require plugin_dir_path( __DIR__ ).'frontend/class-wc-frontend-autofill-address.php';
            }
        }
    }