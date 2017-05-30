<?php

namespace Adnotare;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag'
    ];

    /**
     * Get the file the user made the tag on.
     */
    public function file()
    {
        return $this->belongsTo('Adnotare\File', 'file_id');
    }
       
}
