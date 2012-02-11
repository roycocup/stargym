<?php

class RemoteHelper
{

	public static function getRemote($url, $getHeader = false, $followRedirect = true){
		$browser_id = "Chrome";
		$curl_handle = curl_init();
		$options = array
		(
			CURLOPT_URL => $url,
			CURLOPT_HEADER => $getHeader,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => $followRedirect,
			CURLOPT_USERAGENT => $browser_id,
			CURLOPT_TIMEOUT => 10,
		);
		curl_setopt_array($curl_handle, $options);
		try{
			$server_output = curl_exec($curl_handle);
		} catch(Exception $e){
			return false;
		}
		curl_close($curl_handle);
		return $server_output;
	}

}

?>
