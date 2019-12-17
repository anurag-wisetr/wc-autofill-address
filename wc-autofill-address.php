<?php
    /**
     * Plugin Name: WooCommerce Autofill Address
     * Plugin URI: https://wisetr.com/
     * Description:  WooCommerce Autofill Address is a Wordpress woocommerce plugin to autofill Address on checkout page by using google place api.
     * Version: 1.0.0
     * Author: Wisetr
     */

    if (!defined('ABSPATH')){
        exit;
    }

    if(in_array('woocommerce/woocommerce.php',apply_filters('active_plugins', get_option('active_plugins')))){
        add_action('plugins_loaded','aaf_address_autofill_init');
    }

    function aaf_address_autofill_init(){
        require 'includes/class-wc-autofill-address.php';
        new Wc_Autofill_Address();
    }