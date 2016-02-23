<?php

namespace App;

use App\User;
use App\FlyerBanner;
use App\FlyerPhoto;
use Illuminate\Database\Eloquent\Model;

class Flyer extends Model {

    protected $table = "flyers";


    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'excerpt',
        'description',
        'location',
        'lat',
        'lng'
    ];


    /**
     * Show a Travel Flyer when clicked on.
     *
     * @param $title
     * @return mixed
     */
    public static function LocatedAt($title) {
        return static::where(compact('title'))->firstOrFail();
    }


    /**
     * Show a Users Profile connected with a Travel Flyer when clicked on.
     *
     * @param $id
     * @return mixed
     */
    public static function LocatedAtID($id) {
        return static::where(compact('id'))->firstOrFail();
    }


    /**
     * Save a flyer to the Flyer Photo instance
     *
     * @param \App\FlyerPhoto $FlyerPhoto
     * @return Model
     */
    public function addPhoto(FlyerPhoto $FlyerPhoto) {
        return $this->photos()->save($FlyerPhoto);
    }


    /**
     * One Travel Flyer can have many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany('App\FlyerPhoto');
    }


        /**
         * Save a flyer to the Flyer Banner instance
         *
         * @param \App\FlyerBanner $FlyerBanner
         * @return Model
         */
        public function addBannerPhoto(FlyerBanner $FlyerBanner) {
            return $this->bannerPhotos()->save($FlyerBanner);
        }

        /**
         * One Travel Flyer can have many Banners.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function bannerPhotos() {
            return $this->hasMany('App\FlyerBanner');
        }



    /**
     * A Travel Flyer belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }


    /**
     * Determine if the given user created a flyer.
     * @param User $user
     * @return boolean
     */
    public function ownedBy(User $user) {
        // Check to see if the user id = the user id passed in.
        return $this->user_id == $user->id;
    }


    /**
     *  This is used to redirect back to the travel flyer
     *  that has just been created.
     *
     * @return mixed
     */
    public function pathToTravelFlyer() {
        return $this->title;
    }


    /**
     *  Grab who liked a Flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes() {
       return $this->morphMany('App\Like', 'likeable');
    }

}