<?php
class SFacebook {
	
	private $appid;
	private $secret;
	private $_fb;
	/**
	* Initalisation 
	*/
	public function SFacebook() 
	{
		//include facebook SDK
		Yii::import('application.vendors.*');
		require_once('facebook/src/facebook.php');
		
		//Get the appid and secret from config
		if ( isset(Yii::app()->params['fbAppId']) )
		{
			$this->appid = Yii::app()->params['fbAppId'];
		} else {
			throw new Exception('No Facebook App ID');
		}
		if ( isset(Yii::app()->params['fbsecret']) )
		{
			$this->secret = Yii::app()->params['fbsecret'];
		} else {
			throw new Exception('No Facebook Secret');
		}
		
		//get the Facebook Object and set $_fb
		$fb = new Facebook(array(
			'appId'  => $this->appid,
		  	'secret' => $this->secret,
		  	'cookie' => true,
		));
		
		if($fb)
		{
			$this->_fb = $fb;
		} else {
			throw new Exception('Unable to retrieve facebook SDK object');	
		}
	}
	
	/**
	* Return the instance of Facebook Class
	*
	* @return Facebook Facebook object
	*/
	public function getObject()
	{
		if(!empty($this->_fb))
		{
			return $this->_fb;	
		}
	}

	/**
	* Get the login URL for the app with appropriate permissions
	*
	* @param string $redirect_url 	The URL to redirect back too after authorisation at facebook
	* @param string $display	The type of screen facebook should display
	* @return string $url	The facebook login URL 
	*/
	public function getLoginUrl($redirect_url,$display='popup')
	{
		if(!empty($this->_fb))
		{
			return $this->_fb->getLoginUrl(array(
				'scope'         => 'publish_stream,offline_access,email',
				'redirect_uri'	=>	$redirect_url,
				'display'		=>	$display,
			));
		} else {
			return false;
		}
	}
	
	/**
	* Get the logout URL for the app
	*
	* @param string $redirect_url 	The URL to redirect back too after facebook logout
	* @return string $url 	The facebook logout URL 
	*/
	public function getLogoutUrl($redirect_url)
	{
		return $this->_fb->getLogoutUrl(array(
			'next' => $redirect_url,
		));
	}
	
	/**
	* Get a users facebook friends 
	*
	* @param int $userID
	* @return array $friends	array of users facebook friends 
	*/
	public function getFriends($id)
	{
		$user = User::model()->findByPk($id);
		if($user)
		{
			//check for fb user and access token
			if($user->facebook_user && $user->facebook_token)
			{
				if(!empty($this->_fb))
				{
					$this->_fb->setAccessToken($user->facebook_token);
					$friends = $this->_fb->api("/me/friends");
					if(count($friends['data']) > 0)
					{
						return $friends['data'];
					} else {
						return false;
					}
				} else {
					return false;
				}
						
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function getFriend($id,$fbFriendID, $detailed = false)
	{
		$user = User::model()->findByPk($id);
		if($user)
		{
			//check for fb user and access token
			if($user->facebook_user && $user->facebook_token)
			{
				if(!empty($this->_fb))
				{
					$this->_fb->setAccessToken($user->facebook_token);
					$data = $this->_fb->api("/$fbFriendID");
					if ($detailed)$data = $this->_fb->api("/$fbFriendID?metadata=1");
					if(!empty($data))
					{
						return $data;
					} else {
						return false;
					}
				} else {
					return false;
				}
						
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	/**
	 *
	 * @param string $accessToken
	 * @param array $args - array of arrays
	 */
	public function wallPost($accessToken,$args)
	{	
		$message		= !empty($args['message']) ? $args['message'] : '';
		$link			= !empty($args['link']) ? $args['link'] : 'http://www.sunshinebank.co.uk';
		$name			= !empty($args['name'])	? $args['name'] : '';
		$caption		= !empty($args['caption']) ? $args['caption'] : '';
		$image			= !empty($args['picture']) ? $args['picture'] : '';
		$description	= !empty($args['description']) ? $args['description'] : '';
		$actionlink		= !empty($args['actionLink']) ? $args['actionLink'] : array(array('name'=>'Go to site','link'=>'http://www.sunshinebank.co.uk/'));
		
		//set the access token
		$this->_fb->setAccessToken($accessToken);
		try{
			//check we can get the user
			$user = $this->_fb->getUser();
			if($user == 0)
			{
				$user = 0;
				Yii::app()->user->setFlash('warn','Unable to get facebook user, wall post not published');	
			}
		} catch (FacebookApiException $e)
		{
			$user = 0;
			Yii::app()->user->setFlash('warn','Facebook Error, wall post not published');
		}
		
		
		//echo $user;
		if($user != 0)
		{
			
			$fbArgs = array(
    			'message'		=> $message,
				'link'			=> $link,
				'name'			=> $name,
				'caption'		=> $caption,
				'picture'		=> $image,
				'description'	=> $description,
				'actions'		=> $actionlink
			);
			
			//print_r($args); die;
			$this->_fb->api("/feed", "post", $fbArgs);
		}
		
	}
	
	
	public function getFieldsForFriend($id,$fbFriendID, $fields)
	{
		$user = User::model()->findByPk($id);
		if($user)
		{
			//check for fb user and access token
			if($user->facebook_user && $user->facebook_token)
			{
				if(!empty($this->_fb))
				{
					$this->_fb->setAccessToken($user->facebook_token);
					$data = $this->_fb->api("/$fbFriendID","get", array("fields"=>$fields));
					if(!empty($data))
					{
						return $data;
					} else {
						return false;
					}
				} else {
					return false;
				}
						
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	

	public function postFriendWall($friendID, $args)
	{
		$appAccessToken = $this->_fb->getAccessToken();
		$this->_fb->setAccessToken($appAccessToken);
		
		$message		= !empty($args['message']) ? $args['message'] : '';
		$link			= !empty($args['link']) ? $args['link'] : 'http://www.sunshinebank.co.uk';
		$name			= !empty($args['name'])	? $args['name'] : '';
		$caption		= !empty($args['caption']) ? $args['caption'] : '';
		$image			= !empty($args['picture']) ? $args['picture'] : '';
		$description	= !empty($args['description']) ? $args['description'] : '';
		$actionlink		= !empty($args['actionLink']) ? $args['actionLink'] : array(array('name'=>'Go to site','link'=>'http://www.sunshinebank.co.uk/'));
		
		
		//setting facebooks arguments
		$fbArgs = array(
    			'message'		=> $message,
				'link'			=> $link,
				'name'			=> $name,
				'caption'		=> $caption,
				'picture'		=> $image,
				'description'	=> $description,
				'actions'		=> $actionlink
			);
		
		$this->_fb->api("/{$friendID}/feed", "post", $fbArgs);
	}
	
	public function getUserInfo($fbId)
	{
		$userInfo = json_decode(file_get_contents('https://graph.facebook.com/'.$fbId));
		return $userInfo;
	}
	
	public function getTestUsersAjax(){
		$fbString = json_decode($this->getTestUsers());
		foreach ($fbString->data as $testUserInfo){
			//print_r($testUserInfo); die;
			$userExtraInfo = json_decode(file_get_contents('https://graph.facebook.com/'.$testUserInfo->id));
			//print_r($userExtraInfo); die;
			echo "<p>".$userExtraInfo->name."<br/>";
			echo "<a href=".$testUserInfo->login_url." target='_blank'>login here</a></p>";
		}
	}
	
	public function getTestUsers(){
		$url = "https://graph.facebook.com/138901729527943/accounts/test-users?access_token=138901729527943|K6EDMxd7SkCzhqjV-HNzO-NOqpU";
		$data = file_get_contents($url);
		return $data;
	}
	
	
}
?>