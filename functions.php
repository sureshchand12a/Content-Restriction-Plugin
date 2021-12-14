<?php

function crp_plugin_install(){
    global $wpdb;
    $plugin_name_db_version = '1.0';
    $table_name = $wpdb->prefix . "crp"; 
    $charset_collate = $wpdb->get_charset_collate();

    if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name){
        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            ip text NULL,
            post text DEFAULT 0 NOT NULL,
            PRIMARY KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    $options = get_option('crp_settings_data');
    if( empty( $options ) ){
        update_option( 'crp_settings_data', json_encode(get_crp_default_settings()) );
    }
}

function get_crp_settings_json(){
    $settings = get_option("crp_settings_data");
    return stripslashes($settings);
}

function get_crp_default_settings($settings = array()){
    $defaults = array(
        'pluginEnable' => true,
        'numberOfVisits' => 2,
        'redirectURL' => home_url(),
        'restrictionType' => 'message',
        'restrictionMessage' => '<p><strong>This Article is Protected</strong></p><p>You must login to view this content.</p>',
        'modalColor' => '#ff0000',
        'modalClose' => false,
        'loginURL' => wp_login_url(),
        'applyFor' => array("post")
    );

    return (object) wp_parse_args( $settings, $defaults );
}

function get_crp_settings(){
    $settings = get_crp_default_settings(json_decode(get_crp_settings_json(), true));
    return apply_filters( 'CRP/settings', $settings );
}


function hex2rgb( $color, $opacity = 1 ) {

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    list($r, $g, $b) = array_map("hexdec", str_split($color, (strlen( $color ) / 3)));
    return "rgb( $r, $g, $b, $opacity )";
}


function linebreakTop($content){
    return preg_replace("/\n\n/m", '<br />', $content);
}

function crp_login_url($url){
    global $wp;
    $currentURL = home_url( $wp->request );
    $url = str_replace(array("[REDIRECT_URL]"), array($currentURL), $url);
    return apply_filters("CRP/login/url", $url);
}

function crp_get_the_user_ip() {

    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
}

function crp_get_post_types(){
    $args = array(
        'public'   => true,
        '_builtin' => false,
    );
    $output = 'names';
    $operator = 'and';

    $defaults = array( "post", "page", 'archive', 'author', 'category', 'taxonomy');

    $post_types = get_post_types( $args, $output, $operator ); 
    return array_merge($defaults, $post_types);
}


function crp_is_valid_page(){
    $settings = get_crp_settings();
    if( is_page() ){
        if( in_array("page", $settings->applyFor) ){
            return (int) get_the_ID();
        }
    }else if( is_archive(  ) ){
        if( in_array("archive", $settings->applyFor) ){
            return (int) get_queried_object_id();
        }
    }else if( is_category(  ) ){
        if( in_array("category", $settings->applyFor) ){
            return (int) get_queried_object()->term_id;
        }
    }else if( is_tax(  ) ){
        if( in_array("taxonomy", $settings->applyFor) ){
            return (int) get_queried_object()->term_id;
        }
    }else if( is_single(  ) ){
        if( in_array(get_post_type(), $settings->applyFor) ){
            return (int) get_the_ID();
        }
    }
    
    return 0;
}