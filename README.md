# easyNostr NIP-05 Identity Server Plugin for WordPress

This is a beta proof-of-concept for a plugin that turns your WordPress installation into a NIP-05 identity server for Nostr (Notes and Other Stuff Transmitted by Relays).

## Description

NOSTR is a relatively young protocol. This plugin is a work in progress. When enabled, this will add a new field to the user profile for their Nostr public key ("npub"), which must be entered in hex format.

To convert the npub key into hexval you can use a utility such as the ([NIP-05 key conversion tool](https://easyNostr.com)) found at easyNostr

## Requirements 

Cross-Origin Resource Sharing (CORS) must be enabled on your web host.

The plugin will try to do that via `.htaccess`, and for most cPanel servers it should work. 
For Plesk servers you may have to log in to your webserver settings and add it there.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/nostr` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Visit the user profile pages and enter the pubkey in under the **Nostr NIP-05 Identity** section
4. Make sure that your web server is enabled for Cross-Origin Resource Sharing (CORS). You can use a utility like https://cors-test.codehappy.dev/ to check. 

## Frequently Asked Questions

### How do I enable Cross-Origin Resource Sharing (CORS) for my web server?

The plugin adds modifies (or creates) an `.htaccess` file in your `/.well-known/` directory that should enable CORS.

cPanel/WHMS has `"AllowOverride All"` on by default, so the plugin should be able to turn this on when you activate it. 

### The .htaccess file was created, but CORS is still not enabled

Check that the `/.well-known/` directory was created, and that it has perms set to `0755`

If that's the case but CORS is still not enabled, you may have to manually enable it from your server settings.

If you have access to the server itself, you can follow the instructions on enablng CORS:

- For Apache: https://enable-cors.org/server_apache.html
- For Nginx: https://enable-cors.org/server_nginx.html

If you are using a web hosting provider using **cPanel** or **Plesk** then:

- For Plesk: https://support.plesk.com/hc/en-us/articles/12377597400087
- For cPanel: if it didn't enable when you installed the plugin, [it's more complicated](https://support.cpanel.net/hc/en-us/articles/1500001533562-How-To-add-nosniif-CORS-HSTS-Clickjack-and-X-Xss-Protection-headers?_ga=2.48828454.1039362881.1680543384-1840926562.1678002612).



Failing that, you may need to contact your webserver support people.

### I've done all this and my Nostr profile still isn't verified

Make sure you're using the hexidecimal representation of your Nostr *public* key, it will look like this:

d911029a00cab80ea7da4a8a82cac4c1dacebd4861b0e70eeb9314fc5a4b3a72

If your public key starts with `npub___` it means you need to convert it to the hexval, there should be a utility at https://easyNostr.com where you can do this.

Make sure you are using the same public key on both the WordPress installation and in your Nostr profile. 

Make sure you put in your Nostr client settings, for NIP-05 Identifier, your actual NIP-05 Identifier, and not your public key, and not your NIP-05 URL

### What does a NIP-05 identifier look like? And how is it formed from my WordPress account?

The NIP-05 id looks like an email address: **&lt;user&gt; @ &lt;domain&gt;**

In this case: user will be the `username` of your WordPress account on the system, and domain will be the `hostname` of the WordPress installation.

## Todo

- Add email forwarder capabilities. In the meantime, set an `MX handler` for your hostname and handle email there.
- Lnurl support. We have to be careful here. If the WP install gets compromised an attacker can hijack future payments that reference your lnurl.
- Integrations into nostr relays.

## Support


You can reach out on Nostr:  
  
- markjr@bombthrower.com (Nip-05)  
- npub1elwpzsul8d9k4tgxqdjuzxp0wa94ysr4zu9xeudrcxe2h3sazqkq5mehan   
- @StuntPope on Twitter  

There are also specific easyNostr points of contact:  
- @easynostr.com (NIP-05)  
- npub157tuz2760n09vg9362r4chwezxtqrfz7qq2mpxp49kl4g9znzr9qxf6hsp  
- Telegram https://t.me/easynostr  

If you find this plugin useful, please consider donating to support its development: 
- via BTC: bc1qdkaymqtvpus5prx6lsfx4483kvv95mjah2z2wc
- Lightning: LNURL1DP68GURN8GHJ7AMPD3KX2AR0VEEKZAR0WD5XJTNRDAKJ7TNHV4KXCTTTDEHHWM30D3H82UNVWQHK6CTWD93KXMMDD4SNGWQP2498293KXMMDD4SNGWQP24982# wp-nostr-nip05
Plugin to turn your Wordpress into a Nostr NIP-05 Identity Server
