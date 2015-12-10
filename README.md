Push Notification Parse
------------
Contributors: kevin.gay
Tags: push notifications, Android, iOS, Parse, Parse.com
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to send Parse Push Notifications from your WordPress site to your Parse.com account.

Description
------------
This plugin allows you to send notifications directly from your WordPress site to your Parse.com account to all devices that i've been registered in it.
Now, go to Installation section to find out how to install and use plugin. 


Installation
------------
This section describes how to install the plugin and get it working.


-1. Upload `push_notifications_parse` to the `/wp-content/plugins/` directory
-2. Activate the plugin through the 'Plugins' menu in WordPress
-3. Go to the Settings section and enter your correct keys of your App of Parse.com
-5. Write you text and click on Send Push!
-4. Enjoy!

Troubleshooting	
------------
- WARNING : It's at your own risk to do that because it cans create security issue 
- Fatal error: Uncaught exception 'Parse\ParseException' with message 'SSL certificate problem: unable to get local issuer certificate' 
- You will have to add a line at the parse-php-sdk-master\src\Parse\ParseClient.php file.
- Under this : $rest = curl_init(); }
- Add : curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, false);

Changelog		
------------

= 0.3 =
- Setting page to easily enter your keys.

= 0.2.2 =
- Fixed "The plugin does not have a valid header"		

= 0.2.1 =
- Fixed Readme Wordpress.

= 0.2 =	
- Auto-Download ParseSDK.

= 0.1.1 =	
- Fixed CSS issue.

= 0.1 =	
- First alpha version send to iOs and Android at the same time.
