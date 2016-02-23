<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Points extends Model {

    protected $table = 'points';

    protected $fillable = ['user_id', 'points'];


    /**
     * Pass in $points and increment it.
     *
     * @param $points
     */
    public function award($points) {
        $this->increment('points', $points);
    }


    /**
     * Points belongs to One User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function points() {
        return $this->hasOne('App\User', 'user_id');
    }

}