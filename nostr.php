<?php
/*
   Plugin Name: easyNostr-Nip05
   Description: Use your WordPress site as a Nostr NIP-05 Identity Server
   Version: 1.0.3
   Author: easyDNS Technologies Inc.
*/

// Add menu
function enip05_menu() {
    add_menu_page("easyNostr", "easyNostr","manage_options", "nostr-settings", "enip05_settings",'dashicons-rest-api'); 
   
}
add_action("admin_menu", "enip05_menu");
function enip05_settings(){
  include "settings.php";
}
function enip05_active(){
	$wellknown_folder = sanitize_file_name($_SERVER['DOCUMENT_ROOT']) . '/.well-known';

	if ( ! is_dir( $wellknown_folder) ) {
		wp_mkdir_p( $wellknown_folder);
		if (substr(sprintf('%o', fileperms($wellknown_folder)), -4) !== '0755') {
        	// Change file permissions to 0755
		$old_umask = umask(0);
        	chmod($wellknown_folder, 0755);
		umask($old_umask);
		}
	}
	
	//add Nostr file
	$filenostr = $wellknown_folder. '/nostr.json';
	if ( !file_exists( $filenostr ) ) {
		$nostrfile=plugin_dir_path( __FILE__ ).'/nostr.json';
		copy($nostrfile, $filenostr);
	}

// htaccess content - need to execute nostr.json as PHP script
//		    - need to enable CORS headers

$htaccess_file = plugin_dir_path(__FILE__).'htaccess_template.txt';
$content_write = file_get_contents($htaccess_file);

	//add htaccess file
	$htaccessfile = $wellknown_folder. '/.htaccess';
	if ( !file_exists( $htaccessfile ) ) {
		 $open = fopen( $htaccessfile, "a+" ); 
		 $write = fputs( $open, $content_write.  PHP_EOL ); 
		 fclose( $open );
	} else{
		$data = file_get_contents($htaccessfile);

		if(strpos($data, '.json') === TRUE)
		{
		// tag not added;
		$open = fopen( $htaccessfile, "a+" ); 
		$write = fputs( $open, $content_write.  PHP_EOL ); 
		fclose( $open );
		}
		 
		
	}
	
		//
}
register_activation_hook( __FILE__, 'enip05_active' );
	require_once "addfields.php";
