Push Notification Parse
------------
Contributors: kevin.gay
Tags: push notifications, Android, iOS, Parse, Parse.com
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to send Push Notifications directly from your WordPress site to your Parse.com account.

Description
------------
This plugin allows you to send notifications directly from your WordPress site to your Parse.com account to all devices
that i've been registered in it.

Now, go to Installation section to find out how to install and use plugin. 


Installation
------------
This section describes how to install the plugin and get it working.


1. Upload `push_notifications_parse` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add in your repository the Parse SDK from : https://github.com/parseplatform/parse-php-sdk
4. Edit the 'require' in the function 'push_notifications_send($message)' to add the path of the autoload.php of the Parse.com SDK
5. Edit the line "ParseClient::initialize( $app_id, $rest_key, $master_key );" with your correct key from your App in Parse.com
6. Write
7. Enjoy!

Changelog
------------
= 0.1 =
First alpha version send to iOs and Android at the same time.