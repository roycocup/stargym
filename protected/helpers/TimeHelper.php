<?php

class TimeHelper 
{

	public function getExtendedTimePicker(){
		$years	= range(1920,date('Y'));
		$years = array_combine($years, $years);
		//$months = range(1,12);
		$months = array(1=>'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$months = array_combine(range(1,12), $months);
		$days	= range(1,31);
		$days = array_combine($days,$days);
		
		return array('years'=>$years, 'months'=>$months, 'days'=>$days);
	} 
	
}