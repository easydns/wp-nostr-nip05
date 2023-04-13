=== WP-Nostr-Nip05 ===
Contributors: Markjr13, Tejinderb
Tags: Nostr, NIP-05, NIP05, easyNostr
Requires at least: 4.7
Tested up to: 6.2
Stable tag: 1.0.1
Requires PHP: 7.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==

This plugin will enable your WordPress installation to function as a Nostr NIP-05 endpoint / server.

When enabled, it will add a new field to the user profile for their Nostr public key ("npub"), which must be entered in hex format.

To convert the npub key into hexval you can use a utility such as the (NIP-05 key conversion tool) found at [easyNostr](https://easyNostr.com/ "easyNostr"). A future version of this plugin will likely have the conversion built-in.

== Requirements ==

- Cross-Origin Resource Sharing (CORS) must be enabled on your web host.

- The webserver have permission to create or write to the /.well-known/ directory below your document root

- The /.well-known/nostr.json file must be executable as a PHP script

== Installation ==

- Upload the plugin files to the /wp-content/plugins/nostr directory, or install the plugin through the WordPress plugins screen directly. 

- Activate the plugin through the Plugins screen in WordPress.

- Visit the user profile pages and enter the pubkey in under the Nostr NIP-05 Identity section.

- Optionally enter a pubkey for the "root" \(i.e _@example.com\) user in the easyNostr settings page.

- Make sure that your web server is enabled for Cross-Origin Resource Sharing (CORS). You can use a utility like https://cors-test.codehappy.dev/ to check.

== Frequently Asked Questions ==

= How do I enable Cross-Origin Resource Sharing (CORS) for my web server? =

The plugin adds modifies (or creates) an .htaccess file in your /.well-known/ directory that should enable CORS.

cPanel/WHMS has "AllowOverride All" on by default, so the plugin should be able to turn this on when you activate it.

= The .htaccess file was created, but CORS is still not enabled =

Check that the /.well-known/ directory was created, and that it has perms set to 0755

If that's the case but CORS is still not enabled, you may have to manually enable it from your server settings.

If you have access to the server itself, you can follow the instructions on enablng CORS:

- For Apache: https://enable-cors.org/server_apache.html

- For Nginx: https://enable-cors.org/server_nginx.html

If you are using a web hosting provider using cPanel or Plesk then:

- For Plesk: https://support.plesk.com/hc/en-us/articles/12377597400087
- For cPanel: if it didn't enable when you installed the plugin, (it's more complicated)[https://support.cpanel.net/hc/en-us/articles/1500001533562-How-To-add-nosniif-CORS-HSTS-Clickjack-and-X-Xss-Protection-headers?_ga=2.48828454.1039362881.1680543384-1840926562.1678002612].

Failing that, you may need to contact your webserver support people.

== Todo ==

- Add conversion for npub to hexval keys

- Lnurl support. We have to be careful here. If the WP install gets compromised an attacker can hijack future payments that reference your lnurl.

- Integrations into Nostr relays.

== Support == 

- (The easyNostr Github)[https://github.com/easydns/wp-nostr-nip05]

- (Telegram)[https://t.me/easynostr]

- On Nostr via:
  @easyNostr: npub157tuz2760n09vg9362r4chwezxtqrfz7qq2mpxp49kl4g9znzr9qxf6hsp

- Mark Jeftovic in Nostr: markjr@bombthrower.com (NIP-05) 
	npub1elwpzsul8d9k4tgxqdjuzxp0wa94ysr4zu9xeudrcxe2h3sazqkq5mehan
	
If you find this plugin useful, please consider donating to support its development:

- via BTC: bc1qdkaymqtvpus5prx6lsfx4483kvv95mjah2z2wc

- Lightning: lnbc1pjzem7hpp502vefct5jyv4lgjrhr76rstfvgq4tsds7eyhvsts9z6l47exr0fsdqu2askcmr9wssx7e3q2dshgmmndp5scqzpgxqyz5vqsp5hjumlyrmchfvkd0q3tc3q0kktlpnu7d3frjk4ln5uq4n6pjm00zs9qyyssqma8xvjhshaq25aq0p5t85eyq2jjxsygjd97ka0tmrtpaajndwmj4xf5x4mtjalp8xzj8mz8ju6kmyet8l8r59z3a75nu60npglddltspfffw7c
