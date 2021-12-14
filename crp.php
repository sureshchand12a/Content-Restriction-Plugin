<?php

/**
 * This is the main class to handle content restriction management
 * 
 * @since 1.0
 * @package contentrestriction
 */

if(  ! class_exists( 'crp_control' )  ){

    class crp_control{

        public function __construct(){
            add_filter('the_content', [$this, 'content_alter'], 5000);
            add_action( 'wp_enqueue_scripts', [$this, 'add_scripts'], 5001);
            add_action( 'wp_footer', [$this, 'add_modal_content'], 5);
        }

        /**
         * Add modal content
         * 
         * @since 1.0
         */
        public function add_modal_content(){
            ob_start();
            $settings = get_crp_settings();
            $file = plugin_dir_path( __FILE__ ) . "inc/template/design1.php";
            $file = apply_filters("CRP/template/design", $file);
            require_once $file;
            $content = ob_get_clean();

            $content .= '<script>';
            if( is_user_logged_in(  ) ){
                $content .= 'let crpEnable = false;';
            }else{
                //checking user restriction
                $restrict = $this->check_restriction();
                $content .= sprintf('let crpEnable = %s;', $restrict);
            }
            
            $content .= '</script>';
            echo $content;
        }

        /**
         * Add scripts to wp_content
         * 
         * @since 1.0
         */
        public function add_scripts(){
            $version = filemtime(plugin_dir_path( __FILE__ ) . "assets/js/main.js");
            wp_enqueue_script( 'crp', plugin_dir_url( __FILE__ ) . "assets/js/main.js", array(), $version, true );
            wp_localize_script( 'crp', 'crp', array(
                'settings' => get_crp_settings()
            ) );
        }

        /**
         * Wrap the content with main div
         * 
         * @since 1.0
         */
        public function content_alter($content){
            $content = sprintf('<div class="crp_content_wrapper">%s</div>', $content);
            return $content;
        }

        /**
         * This is the main function to check for restriction
         * 
         * @since 1.0
         */
        public function check_restriction(){

            $settings = get_crp_settings();
            if( ! filter_var( $settings->pluginEnable, FILTER_VALIDATE_BOOLEAN ) ){
                return "false";
            }

            global $wpdb;
            $table = $wpdb->prefix . "crp";

            try{
                $ip = crp_get_the_user_ip();
                $postID = crp_is_valid_page();
                if( (int) $postID > 0 ){
                    global $post;
                    $result = $wpdb->get_results("SELECT * FROM $table WHERE `ip` = '$ip'");
                    
                        if( empty( $result ) ){
                            //give access to user
                            $wpdb->insert($table, array(
                                'ip' => $ip,
                                'post' => $postID
                            ));
                            return "false";
                        }else{

                            //check whether user cross their limit
                            if( count($result) >= (int) $settings->numberOfVisits ){
                                return "true";
                            }else{
                                $result = $wpdb->get_results("SELECT * FROM $table WHERE `ip` = '$ip' AND `post` = '$postID'");
                                if( empty( $result ) ){
                                    $wpdb->insert($table, array(
                                        'ip' => $ip,
                                        'post' => $postID
                                    ));
                                    return "false";
                                }else{
                                    return "false";
                                }
                            }

                        }
                }else{
                    return "false";
                }
            } catch ( \Exception $e ){
                return "false";
            }

        }

    }

    new crp_control();
}