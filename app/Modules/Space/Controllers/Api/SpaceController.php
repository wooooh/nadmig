<?php namespace App\Modules\Space\Controllers\Api;

use App\Modules\Space\Models\Space;
use App\Modules\Session\Models\Session;
use App\Modules\Space\Base\Controllers\ModuleController;
use Carbon\Carbon;
class SpaceController extends ModuleController {

  public function retrive(Space $space)
  {
  	
    if($space){
    	   $space['sessions'] = $space->sessions()->where("status", "!=" ,"deleted")->get()->toArray();
      	return array_only($space->toArray(), array('id', 'working_week_days','working_hours_days', 'in_return_key', 'in_return', 'agreement_text', 'sessions', 'min_type_for_reservation', 'max_type_for_reservation', 'min_time_before_reservation', 'max_time_before_reservation'));
    }
  }
  public function date(Space $space, $year, $month, $day)
  {
  	$date = $year . '/' . $month . '/' . $day;
  	$sessions = Session::where(['space_id' => $space['id'], 'start_date' => $date])->get();
  	foreach ($sessions as $key_1 => $session) {
      	$sessions[$key_1] = array_only($sessions[$key_1]->toArray(), array('id','start_date', 'start_time','period'));
  	} 
  	return $sessions;
  }
  public function check_date(Space $space, $year, $month, $day, $time, $period)
  {
    $date = $year . '/' . $month . '/' . $day;
    
    $session = Session::where(['space_id' => $space['id'], 'start_date' => $date, 'start_time' => $time])->first();
    if ($session) {
      $session = array_only($session->toArray(), array('id','start_date', 'start_time','period'));
      return $session;    
    }else{
      $weekdays = [ 'sun','mon', 'tue', 'wed', 'thu', 'fri','sat'];
      if(in_array($weekdays[Carbon::parse($date)->dayOfWeek],$space->working_week_days)){
        return ['available' => true];    
      }else {
        return ['available' => false];    
      }
    }
    
  }
	/**
     * Returns if a string is json or not
     *
     * @return bool
     */
    protected function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
