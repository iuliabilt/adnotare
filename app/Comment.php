<?php

namespace Adnotare;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    /**
     * Get the user that made the comment.
     */
    public function user()
    {
        return $this->belongsTo('Adnotare\User', 'user_id');
    }

    /**
     * Get the file the user made the comment on.
     */
    public function file()
    {
        return $this->belongsTo('Adnotare\File', 'file_id');
    }
}
