<?php

class LinksHelper
{

	public static function mkLnkLive($str){
		
		$pattern = "/http\:\/\/[\d\w\.\-\/\?\&\=]*/";
		preg_match($pattern, $str, $matches);
		if (empty($matches)) return $str;
		
		$search = $link = trim($matches[0]);
		//if (count($link) > 30) $link = self::shortenUrl($link);
		$replace = '<a href="'.$link.'" target="_blank">'.$link.'</a>';
		$newStr = str_replace($search, $replace, $str);
		return $newStr;
	}
	
	
	public static function shortenUrl($link){
		$tinyUrlApiPrefix = 'http://tinyurl.com/api-create.php?url=';
		$shortLink = RemoteHelper::getRemote($tinyUrlApiPrefix.$link);
		if (!$shortLink) $shortLink = $link;
		return $shortLink;
	}
	
	

}

?>
