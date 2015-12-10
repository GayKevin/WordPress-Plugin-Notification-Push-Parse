<?php
/*
Plugin Name: Push Notifications Parse
Description: This plugin allows you to send Push Notifications directly from your WordPress site to your Parse.com account.
Author:  Kevin Gay
Version: 0.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

From the plugin Push Notification iOS
Plugin Name: Push Notifications iOS
Description: This plugin allows you to send Push Notifications directly from your WordPress site to your iOS app.
Author:  Amin Benarieb
Version: 0.3
License: GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require 'CurlParse.php';

use Parse\ParseQuery;
use Parse\ParsePush;
use Parse\ParseInstallation;
use Parse\ParseClient;

function push_notifications_css(){
	$array = split('\\\\', dirname(__FILE__));
	$folder = $array[count($array) - 1];
    echo '<link rel="stylesheet" type="text/css" href="'.plugins_url().'/'. $folder .'/styles/pn_style.css'.'">';
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url().'/'. $folder .'/styles/pn_buttons.css'.'">';
	echo '<script src="'.plugins_url().'/' . $folder . '/script.js'.'"></script>';
}

function push_notifications_admin_pages() {
	wp_enqueue_media();
	$array = split('\\\\', dirname(__FILE__));
	$folder = $array[count($array) - 1];
	add_menu_page( 'Push Notifications Parse', 'Parse Push Notifications', 'manage_options', 'push_notifications', 'push_notifications_options_page', plugins_url($folder . '/img/icon.png' ), 40 );
}

/*----------------------------------*/
/*----------------------------------*/


function push_notifications_send($message){

    if (file_exists(dirname(__FILE__).'/parse-php-sdk-master/autoload.php') == false){
        $curl = new CurlParse();
        $curl->download("https://github.com/ParsePlatform/parse-php-sdk/archive/master.zip");
    }
    require('parse-php-sdk-master/autoload.php');

    $app_id     = "";
    $rest_key   = "";
    $master_key = "";

    ParseClient::initialize( $app_id, $rest_key, $master_key );
	$data = array("alert" => $message);

    // Push to Channels
    ParsePush::send(array(
        "channels" => ["PHPFans"],
        "data" => $data
    ));

    // Push to Query
    $query = ParseInstallation::query();
    $query->containedIn("deviceType", ["ios", "android"]);;

    ParsePush::send(array(
        "where" => $query,
        "data" => $data
    ));
}

/*----------------------------------*/
/*----------------------------------*/

function push_notifications_logo(){

	$array = split('\\\\', dirname(__FILE__));
	$folder = $array[count($array) - 1];
	echo "<img width='50' hegiht='50' src='".plugins_url()."/" . $folder . "/img/logo.png'/>";
}


/*----------------------------------*/
/*----------------------------------*/

function push_notifications_create_form(){


	if (isset($_POST['push_notifications_push_btn'])) 
	{   
	   if ( function_exists('current_user_can') && 
			!current_user_can('manage_options') )
				die ( _e('Hacker?', 'push_notifications') );

		if (function_exists ('check_admin_referer') )
			check_admin_referer('push_notifications_form');

        push_notifications_send($_POST['pn_text']);

	}

	echo
		"<div id='pn_form'>
	        <h2>Create push notification</h2>
			<form id='push_form' name='push_notifications' method='post' action='".$_SERVER['PHP_SELF']."?page=push_notifications&amp;updated=true'>
		";
		
		if (function_exists ('wp_nonce_field') )
			wp_nonce_field('push_notifications_form'); 
		?>
						<div>
							<label><input class='pn_radio' type='radio' checked name='pn_push_type' value='default'><span class='overlay'></span></label>
							<p><input type='text' name='pn_text'   placeholder='Text' /></p>
						</div>
						<div>
							<input type='submit' id="push_button" class='pn blue push_button' name='push_notifications_push_btn' value='Send' />
						</div>
			</form>
        </div>
		<?php
}

/*----------------------------------*/
/*----------------------------------*/

function push_notifications_options_page() {

	echo"<center><div id='apns' class='apns_block' >
	<a class='pn_button has-icon help'><i class='icon-help'>Help</i></a>";
	push_notifications_logo();
	push_notifications_create_form();
	echo "</div></center>";
}

/*----------------------------------*/
/*----------------------------------*/
/*----------------------------------*/

add_action('admin_head', 'push_notifications_css');
add_action('admin_menu', 'push_notifications_admin_pages');

?>