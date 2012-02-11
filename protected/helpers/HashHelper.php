<?php

class HashHelper 
{

	public static function encrypt($str){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "123123123";
		$text = $str;
		$crypttext = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv));
		$crypttext = rawurlencode($crypttext);		
		return $crypttext; 
	}
	
	public static function decrypt($str){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$str = rawurldecode($str);	
		$key = "123123123";
		$text = base64_decode($str);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
		$decrypted = str_replace("\0", "",$decrypted);
		return $decrypted;
	}
	
}