<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Database extends Model
{
    use Eloquence;
    protected $searchableColumns = ['name', 'description', 'url', 'access_mode'];

    // MUTATOR: URL is unique otherwise NULL
    public function setUrlAttribute($value)
    {
    	if ( empty($value) ) {
    		$this->attributes['url'] = NULL;
    	} else {
        	$this->attributes['url'] = $value;
    	}
    }

    public function literature()
    {
        return $this->belongsToMany('App\Literature')->withPivot('date');
    }

    public static function filter($parameters = null, $itemsPerPage = 10)
    {
        return self::where($parameters)->orderBy('name')->paginate($itemsPerPage);
    }

    // <================================================================================>

    public static function getDatabaseAccessModes()
    {
        return self::$accessModes;
    }

    private static $accessModes = ['Subscription', 'Subscription; Limited free access with registration', 'Free', 'Free and Subscription', 'Free abstracts; Subscription full-text', 'Free abstract and preview; Subscription full-text', 'Free searching; Subscription full-text', 'Free online searching; offline use by subscription', 'N/A'];
}
