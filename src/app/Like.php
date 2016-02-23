<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likeable';


    /**
     * Set method likeable to return a polymorphic relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable() {
        // "morphTo" means to can be applied to any Model
       return $this->morphTo();
    }


    /**
     * A like belongs to a user.
     * Set a relationship to see who liked something
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whatUserLiked()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}