<?php

##
# WP-Nostr-NIP05 released under GPLv2 License
#
# Copyright (c) 2023 EasyDNS Technologies Inc 
#                    https://easydns.com
#
# Devs: Tejinder Singh
#       Mark E. Jeftovic
#
# Project: easyNostr      https://easyNostr.com
#
# Github: https://github.com/easydns/wp-nostr-nip05
##

$current_user = wp_get_current_user();

global $wpdb;
 
if(isset($_POST['bcbh_but_submit'])){
    $nostr_hexkey = sanitize_text_field($_POST['nostr_hexkey']);
    update_option("nostr_hexkey", $nostr_hexkey);
  }
    $b_nostr_hexkey =  get_option( 'nostr_hexkey' );  ?>
<h1>Nostr NIP-05 Settings</h1>

  <table class="form-table tools-privacy-policy-page">
  	 <tr>
      <td>NIP-05 Endpoint:</td>
      <td><a target="_blank" href="<?php echo home_url();?>/.well-known/nostr.json/?name=<?php echo esc_html( $current_user->user_login ) ;?>"><?php echo home_url()?>/.well-known/nostr.json</a></td>
    </tr>
     <tr>
      <td>nostr.json file:</td>
      <td><?php 
      $wellknown_folder = sanitize_file_name($_SERVER['DOCUMENT_ROOT']) . '/.well-known';
      $filenostr = $wellknown_folder. '/nostr.json';
	if ( !file_exists( $filenostr ) ) {
    echo esc_html( 'Not Installed' ) ; 
	}else{echo esc_html( 'Installed' ) ; } ?>
    </td>
    </tr>
   
    <tr>
      <td>CORS Status:</td>
      <td> 
      <?php
 $url =   home_url(). "/.well-known/nostr.json/"; // Replace with the URL you want to fetch headers for

// Fetch the headers for the URL
  $headers = get_headers($url);
 
// Loop through the headers and look for "access-control-allow-origin" header
foreach ($headers as $header) {
  if (strpos(strtolower($header), 'access-control-allow-origin') !== false) {
    // Check if the "access-control-allow-origin" header contains an asterisk (*)
    if (strpos($header, '*') !== false) {
      //echo "The URL $url has an access-control-allow-origin header with an asterisk (*)"; 
      echo '<span class="dashicons dashicons-saved " style="color: green;font-size: 28px;line-height: 24px;"></span>';
    } else {
     // echo "The URL $url has an access-control-allow-origin header, but it doesn't contain an asterisk (*)";
      echo '<span class="dashicons dashicons-no-alt style="color:red; font-size:28px;line-height: 24px;"></span>';
    }
    break;
  }
}  
?>

      </td>
    </tr>

    <tr>
      <td>Root NIP-05 id:</td>
     <td> <form  class="widefat fixed" cellspacing="0" method='post' action=''>
 <input type="text" id="nostr_hexkey" name="nostr_hexkey"  value="<?php echo esc_html($b_nostr_hexkey); ?>">
 <input class="button" type='submit' name='bcbh_but_submit' value='Update'>
</form> </td>
    </td>
    
    </tr>
    <tr>
      <td   colspan="2">Additional information and support: <a target="_blank" href="https://easyNostr.com">https://easyNostr.com</a></td>
     
    </td>
    </tr>
 </table>
