<?php

/**
 * Plugin Name:       Content Restriction Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Content Restriction plugin is the wordpres plugin to restrict user to access the content. Only login user can access the content.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Suresh Chand
 * Author URI:        https://hamrocsit.com/user/hamrocs
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       contentrestriction
 * Domain Path:       /languages
 */

if( ! defined( 'ABSPATH' ) ){
    die("Restricted!!!");
}

define('CRPTEXT', 'contentrestriction');
define('CRP_VERSION', '1.0');

if( ! class_exists( 'CRP' ) ){

    require_once plugin_dir_path( __FILE__ ) . "functions.php";

    class CRP{

        /**
         * On plugin initialize, this function will be automatically called
         * 
         * @since 1.0
         */
        public function __construct(){

            //registering settings
            add_action( 'admin_init', [$this, 'register_settings'] );

            //Create Admin Menu
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );

            //add plugin script
            add_action( 'admin_enqueue_scripts', [$this, 'admin_scripts'] );

            //handle ajax
            add_action('wp_ajax_crp_settings', [$this, 'ajax']);

            //add setting link
            add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'plugin_links'], 10, 2  );

        }

        /**
         * Add setting link to plugin page
         * 
         * @since 1.0
         */
        public function plugin_links($links, $file){
            /****************************************
            Insert Settings link
            *****************************************/
            $links[] = '<a style="color:#009688;font-weight:bold;" href="admin.php?page=crp">'.__('Settings', CRPTEXT).'</a>';
            return $links;
        }

        /**
         * Register settings
         * 
         * @since 1.0
         */
        public function register_settings(){
            register_setting('crp_settings', 'registred_crp_settings');
            register_setting('chp_abd_settings', 'registred_chp_abd_settings');
            add_settings_section(
                'crp_settings_section',
                '',
                null,
                'crp_settings'
            );

            add_settings_field(
                'crp_settings_data',
                '',
                null,
                'crp_settings',
                'crp_settings_section'
            );
        }

        /**
         * Handle Ajax Request
         * 
         * @since 1.0
         */
        public function ajax(){
            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'ul' => array(),
                'ol' => array(),
                'sub' => array(),
                'img' => array(),
                'i' => array(),
                'p' => array()
            );
            update_option("crp_settings_data", wp_kses($_POST['data'], $allowed_html));
            echo "Settings Updated Successfully";
            die();
        }

        /**
         * Add plugin scripts to admin
         * 
         * @since 1.0
         */
        public function admin_scripts(){

            if( is_admin() && isset($_GET['page']) && $_GET['page'] == 'crp' ){

                wp_enqueue_style( 'wp-color-picker' ); 
                wp_enqueue_script( 'wp-color-picker' ); 


                wp_enqueue_style("mdb-material", plugin_dir_url( __FILE__ ) . "mdl/material.min.css");
                wp_enqueue_style("mdb-fontfaily", "https://fonts.googleapis.com/icon?family=Material+Icons");
                wp_enqueue_script("mdb-materialjs", plugin_dir_url( __FILE__ ) . "mdl/material.min.js", array(), "1.0", true);
                wp_enqueue_script("crp-main", plugin_dir_url( __FILE__ ) . "assets/js/admin.js", array(), "1.0", true);

            }

        }

        /**
         * Add plugin menu function callback
         * 
         * @since 1.0
         */
        public function admin_menu(){
            add_options_page(
                __( 'Content Restriction', CRPTEXT ),
                __( 'Content Restriction', CRPTEXT ),
                'manage_options',
                'crp',
                array(
                    $this,
                    'crp_settings_page'
                )
            );
        }
        public function crp_settings_page(){
            require_once plugin_dir_path( __FILE__ ) . "settings.php";
        }

    }

    //On plugin install
    register_activation_hook( __FILE__, 'crp_plugin_install' );

    //plugin initialization
    $CRP = new CRP();
    require_once plugin_dir_path( __FILE__ ) . "crp.php";
}