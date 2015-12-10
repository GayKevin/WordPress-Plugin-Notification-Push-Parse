<?php

/**
 * Created by PhpStorm.
 * User: thieg
 * Date: 10/12/2015
 * Time: 01:50
 */
class CurlParse {

	/**
	 * @param $url
	 * Download from Curl
	 */
	function download($url){
		$zipFile = dirname(__FILE__)."\\master.zip"; // Local Zip File Path
		$zipResource = fopen($zipFile, "w");
		// Get The Zip File From Server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FILE, $zipResource);
		$page = curl_exec($ch);
		//Close Resource
		fclose($zipResource);
		///Check Curl
		if(!$page) {
			echo "Error :- ".curl_error($ch);
		}else{
			$this->extractZip($zipFile);
		}

		curl_close($ch);
	}

	/**
	 * @param $zipFile
	 * Extract Zip
	 */
	function extractZip($zipFile){
		$zip = new ZipArchive;
		$extractPath = dirname(__FILE__);
		if($zip->open($zipFile) != "true"){
			echo "Error :- Unable to open the Zip File";
		}
		/* Extract Zip File */
		$zip->extractTo($extractPath);
		$zip->close();

		error_log("=========> ".$zipFile);
		chmod($zipFile,0777);
		unlink($zipFile);
	}
}