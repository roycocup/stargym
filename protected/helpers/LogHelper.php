<?php

class LogHelper
{

	const SEVERITY_DEBUG	= 'Debug';
	const SEVERITY_INFO		= 'Info';
	const SEVERITY_NOTICE	= 'Notice';
	const SEVERITY_FATAL	= 'Fatal Error';
	
	public $fileName = 'PilotLog';
	public $filePath;
	public $webroot;
	
	public function __construct()
	{
		//note: for web apps the webroot will be inside public_html whereas for cli 
		//the webroot is inside scripts folder. Because of that, we always go back one level to trunk
		$this->webroot = Yii::getPathOfAlias('webroot');
		$this->filePath = dirname($this->webroot)."/logs/";
		$this->fileName = $this->_getFileName();
	}
	
	private function _getFileName()
	{
		$month	= date('m');
		$year	= date('Y');
		$week	= date('W');
		$fileName = $this->fileName."-".$year."-".$month."-".$week.".log";
		return $fileName;
	}

	
	private function _write($payload)
	{
		if($this->_canWriteToFolder($this->filePath))
		{
			$fullFilePath = $this->_getFullFilePath();
			file_put_contents($fullFilePath, $payload."\r\n", FILE_APPEND);
		}
	}
	
	private function _canWriteToFolder($directory)
	{
		if (!is_dir($directory))
		{
			if(!mkdir($directory, 0777, true)){
				return false;
			}
		} 
		return true;
	}
	
	
	private function _getFullFilePath()
	{	
		if(!is_file($this->fileName))
		{
			touch($this->filePath.$this->fileName); 
		}
		return $this->filePath.$this->fileName;
	}
	
	public static function log($message, $severity = self::SEVERITY_INFO)
	{
		$date		= date('Y-m-d H:i:s')." - ";
		$severity	= $severity. " - ";
		$payload	= $date.$severity.$message;
		
		$logger = new LogHelper();
		$logger->_write($payload);
	}
}

?>