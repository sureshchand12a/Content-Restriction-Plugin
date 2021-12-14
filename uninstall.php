<?php
    if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
    
    global $wpdb;
    $table_name = $wpdb->prefix . "crp";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
    
    delete_option("crp_settings_data");
?>