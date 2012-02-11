<?php

class ImageHelper
{

	/**
	 * Create a thumbnail of an image and returns relative path in webroot
	 *
	 * @param int $width
	 * @param int $height
	 * @param string $img
	 * @param int $quality
	 * @param bool $update - forces overwrite on existing files
	 * @return string $path
	 */
	public static function thumb($width, $height, $img, $update = false, $quality = 75)
	{
		$pathinfo = pathinfo($img);
		if (isset($pathinfo['extension']))
		{

			$thumb_name = "cache_" . $pathinfo['filename'] . '_' . $width . '_' . $height . '.' . $pathinfo['extension'];
			$thumb_path = $pathinfo['dirname'] . '/cache/';
			if (!file_exists($thumb_path))
			{
				mkdir($thumb_path);
			}
			
			//if file does not exist OR if file is newer than existing 
			if (!file_exists($thumb_path . $thumb_name) || filemtime($thumb_path . $thumb_name) < filemtime($img))
			{

				$image = Yii::app()->image->load($img);
				//get the image size
				$_imgSize = getimagesize($img);
				$_imgWidth = $_imgSize[0];
				$_imgHeight = $_imgSize[1];
				//find out which side is bigger
				if ($_imgWidth > $_imgHeight)
				{
					//if width is bigger then rezise to height and crop
					$image->resize(null, $height)->crop($height, $width)->quality($quality);
				} else if ($_imgHeight > $_imgWidth)
				{
					//if height is bigger then rezise to width
					$image->resize($width, null)->crop($height, $width)->quality($quality);
				} else
				{
					//otherwise just rezise
					$image->resize($width, $height, Image::NONE)->quality($quality);
				}

				//save the image
				$image->save($thumb_path . $thumb_name);
			}

			$relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path . $thumb_name);
			return $relative_path;
		}
	}

	/**
	 * Grabs an image on a url and saves it to the image folder
	 * then creates and saves the corresponding thumb file.
	 * It will return the existing thumb path if the file already exists
	 * 
	 * @param type $width
	 * @param type $height
	 * @param type $imageUrl
	 * @param type $userId
	 * @param type $update //forces rewrite of files
	 * @param type $quality
	 * @return type 
	 */
	public static function thumbForFacebook($width, $height, $imageUrl, $userId, $update = false, $quality = 75)
	{
		$image_save_path = YiiBase::getPathOfAlias('webroot') . "/images/users/" . $userId . ".jpg";
		if (!file_exists($image_save_path) || $update)
		{
			//this goes to a url that orders a redirect, 
			//hence using Yii::app()->image->load($url) would not work
			if ($data = RemoteHelper::getRemote($imageUrl)){
				file_put_contents($image_save_path, $data);
			} else {
				return Yii::app()->params['emptyProfilePicPath'];
			}
			
		}
	
		$thumb_path = self::thumb($width, $height, $image_save_path, $update);
			
		return $thumb_path;
	}

	/**
	 * Gets the response header from fb picture 
	 * and returns the id for that image
	 * @param type $url 
	 * @return type String 
	 */
	public static function getFbPictureId($url)
	{
		$server_output = RemoteHelper::getRemote($url, true);
		
		if (!$server_output) return 'xxxxxxxxxx';
		
		//give me everything after the words location and before the new line
		$pattern = "/Location:\shttp:\/\/(.+)*/";
		preg_match($pattern,$server_output,$matches);
		
		
		// in case the file_get_contents on the above method 
		// does not follow redirects for any reason
		// we can always use this as a curl method
		$prefix = "http://";
		$fullpath = $prefix.$matches[1];
		
		$path_parts = explode("/", $fullpath); 
		$last_index = count($path_parts)-1;
		return $path_parts[$last_index];
	}
	
	/**
	 * In this method there is no cropping of the image
	 * 
	 * @param type $targetHeight
	 * @param type $targetWidth
	 * @param type $imagPath 
	 * @return type string $path
	 */
	public static function thumbBestFit($targetWidth, $targetHeight, $imgPath, $id) 
	{
		//load and get info about the image
		if (!file_exists($imgPath) || !$image = Yii::app()->image->load($imgPath)){
			return '/images/causes/blank.gif';
		}
			
		$p = pathinfo($image->file);
		$relative_path = "/cache/cache_".$id."_".$targetWidth."_".$targetHeight.".".$p['extension'];
		$cached_image_path = dirname($imgPath).$relative_path;
		
		$final_path = "/images/causes".$relative_path;   

		$image->resize($targetWidth, $targetHeight, Image::AUTO);
		$image->save($cached_image_path);
		
		return $final_path;
	}

}

?>
