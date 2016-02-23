<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Status extends Model {

    protected $table = 'statuses';

    protected $fillable = [
        'body'
    ];


    /**
     * A status belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Set up a reply relationship
     * One post can have many replies with the parent_id in status table
     */
    public function replies() {
        return $this->hasMany('App\Status', 'parent_id');
    }


    /**
     * Select statuses that are not replies.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotReply($query) {
       return $query->whereNull('parent_id');
    }


    /**
     * Grab who liked the status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes() {
        // This will morph Many likes to pick up what Model and ID you are talking about.
        // -- "likeable" is coming from the Like model with public function "likeable"
       return $this->morphMany('App\Like', 'likeable');
    }

}