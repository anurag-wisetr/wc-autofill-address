<?php

    if ( ! defined('ABSPATH')){
        exit;
    }

    class Wc_Frontend_Autofill_Address{

//        private $api_key='AIzaSyCn-c5NhOBJ2NdqihFSwyj6HiCyF5BZg0Y';
        private $api_key='AIzaSyB16sGmIekuGIvYOfNoW9T44377IU2d2Es';


        function __construct(){
            add_action('wp_enqueue_scripts', array($this,'waa_load_scripts'));
            add_action('woocommerce_before_checkout_billing_form', array($this, 'waa_add_billing_field'));
            add_action('woocommerce_before_checkout_shipping_form', array($this, 'waa_add_shipping_field'));
        }

        function waa_load_scripts(){
            if(is_checkout()){
                wp_enqueue_script('waa-autofill-script', plugin_dir_url(__DIR__) . 'assets/js/autofill-address.js', array('jquery'), '1.0.0', true);
                wp_localize_script('waa-autofill-script', 'wp_ajax', array('wpAjaxUrl' => admin_url('admin-ajax.php')));

                wp_enqueue_script('waa-google-place', "https://maps.googleapis.com/maps/api/js?key=$this->api_key&libraries=places&callback=initAutocomplete", array('jquery'), '1.0.0', true);
            }
        }

        function waa_add_billing_field($checkout){
            echo $this->get_address_search_field('billing');
        }

        function waa_add_shipping_field($checkout){
            echo $this->get_address_search_field('shipping');
        }

        function get_address_search_field($type){
            $html='<div id="locationField" class="form-row form-row-wide">
            <input id="'.$type.'-autocomplete"
                    placeholder="Search address"
                    type="text" class="'.$type.'-search-addr" data-type="'.$type.'"/>
            </div>';
            return $html;
        }

    }
    new Wc_Frontend_Autofill_Address();