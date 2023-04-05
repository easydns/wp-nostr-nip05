<?php
/*
   Plugin Name: easyNostr Nip-05 Endpoint
   Description: Use your WordPress site as a Nostr NIP-05 Identity Server
   Version: 1.0.0
   Author: easyPress
*/
// Add menu
function nostr_menu() {
    add_menu_page("easyNostr", "easyNostr","manage_options", "nostr-settings", "nostrsettings",'dashicons-rest-api'); 
   
}
add_action("admin_menu", "nostr_menu");
function nostrsettings(){
  include "settings.php";
}
function nostractive(){
	$wellknown_folder = $_SERVER['DOCUMENT_ROOT'] . '/.well-known';

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

$content_write = <<<EOD
#
# Added by easyNostr NIP-05 Plugin
# Creates Nostr NIP-05 identity endpoint 
# See https://easyNostr.com for details
#
<IfModule mime_module>
	AddHandler application/x-httpd-ea-php81 .php .php8 .phtml .json
</IfModule>
<IfModule mod_headers.c>
	Header set Access-Control-Allow-Origin "*"
	Header set Access-Control-Allow-Methods "GET"
</IfModule> 
EOD;

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
register_activation_hook( __FILE__, 'nostractive' );
	require_once "addfields.php";
