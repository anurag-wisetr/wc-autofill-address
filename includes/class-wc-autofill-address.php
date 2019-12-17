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

            if(!is_admin() || is_ajax()){
                require plugin_dir_path( __DIR__ ).'frontend/class-wc-frontend-autofill-address.php';
            }
        }
    }