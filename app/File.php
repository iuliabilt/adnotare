<?php

namespace Adnotare;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path', 'rank' 
    ];

    /**
	 * Get the user that owns the phone.
	 */
	public function user()
	{
	    return $this->belongsTo('App\User', 'user_id');
	}
}
