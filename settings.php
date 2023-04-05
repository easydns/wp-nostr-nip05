<?php $current_user = wp_get_current_user();?>
<h1>easyNostr NIP-05 Endpoint</h1>

  <table class="form-table tools-privacy-policy-page">
  	 <tr>
      <td>NIP-05 Endpoint:</td>
      <td><a target="_blank" href="<?php echo home_url()?>/.well-known/nostr.json/?name=<?php echo esc_html( $current_user->user_login ) ;?>"><?php echo home_url()?>/.well-known/nostr.json</a></td>
    </tr>
     <tr>
      <td>nostr.json file:</td>
      <td><?php 
      $wellknown_folder = $_SERVER['DOCUMENT_ROOT'] . '/.well-known';
      $filenostr = $wellknown_folder. '/nostr.json';
	if ( !file_exists( $filenostr ) ) {
    echo esc_html( 'Not Installed' ) ; 
	}else{echo esc_html( 'Installed' ) ; } ?>
    </td>
    <tr>
      <td   colspan="2">Additional information and support: <a target="_blank" href="https://easyNostr.com">https://easyNostr.com</a></td>
     
    </td>
    
    </tr>
   
 </table>

