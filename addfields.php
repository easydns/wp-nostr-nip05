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

add_action( 'show_user_profile', 'enip05_profile_fields' );
add_action( 'edit_user_profile', 'enip05_profile_fields' );

function enip05_profile_fields( $user ) {

	// let's get custom field values
	$hexkey = get_user_meta( $user->ID, 'hexkey', true );
	// what about making a default value?
	//$npub =  get_user_meta( $user->ID, 'npub', true ) ;

	?>
		<h3>Nostr NIP-05 Identity</h3>
		<table class="form-table">
	 		<tr>
				<th><label for="hexkey">hexkey</label></th>
		 		<td>
					<input type="text" name="hexkey" id="hexkey" value="<?php echo esc_attr( $hexkey ) ?>" class="regular-text" />
					<p><?php if($hexkey == ''){
						echo '<a href="https://easynostr.com/utilities" target="_blank">https://easynostr.com/utilities</a> (Need to covert your npub to hexval? Use this utility)';
					} ?></p>
					
				</td>
			</tr>
			<?php /*<tr>
				<th>npub</th>
				<td>
					<input type="text" name="npub" id="npub" value="<?php echo esc_attr( $npub ) ?>" class="regular-text" />
				</td>
							 
				</td>
			</tr> */?>
		</table>
	<?php
}


add_action( 'personal_options_update', 'enip05_save_profile_fields' );
add_action( 'edit_user_profile_update', 'enip05_save_profile_fields' );
 
function enip05_save_profile_fields( $user_id ) {
	
	if( ! isset( $_POST[ '_wpnonce' ] ) || ! wp_verify_nonce( $_POST[ '_wpnonce' ], 'update-user_' . $user_id ) ) {
		return;
	}
	
	if( ! current_user_can( 'edit_user', $user_id ) ) {
		return;
	}
 
	update_user_meta( $user_id, 'hexkey', sanitize_text_field( $_POST[ 'hexkey' ] ) );
	//update_user_meta( $user_id, 'npub', sanitize_text_field( $_POST[ 'npub' ] ) );
 
} ?>
