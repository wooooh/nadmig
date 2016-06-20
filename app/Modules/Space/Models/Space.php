<?php namespace App\Modules\Space\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Space extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'slug',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['manager_id', 'name', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'links', 'in_return_key', 'in_return', 'status', 'working_week_days', 'working_houre_days', 'space_type', 'space_equipment', 'agreement_text', 'capacity', 'smoking', 'organization_id', 'min_type_for_reservation', 'max_type_for_reservation', 'min_time_before_reservation', 'max_time_before_reservation', 'min_time_before_usage_to_edit', 'change_fees', 'min_to_cancel', 'cancel_fees', 'max_to_confirm', 'reset_time', 'max_event_per_time', 'logo','working_hours_days', 'slug'];
	
    public function organization()
    {
        return $this->belongsTo('App\Modules\Organization\Models\Organization');
    }	
    public function sessions()
    {
        return $this->hasMany('App\Modules\Session\Models\Session');
    }

}
