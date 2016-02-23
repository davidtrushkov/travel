<?php

namespace App;

use Auth;
use App\Flyer;
use App\Points;
use App\Status;
use Carbon\Carbon;
use App\ProfilePhoto;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.

     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'country',
        'gender',
        'age',
        'summary',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Make a boot function to listen
     * to any model events that are fired below.
     */
    public static function boot() {
        // Reference the parent class.
        parent::boot();

        // When we are creating a record (for user registration),
        // then we want to set a token column to some random string.
        static::creating(function($user) {
            $user->token = str_random(30);
        });

    }


    /**
     * Confirm the users email by
     * setting verified to true,
     * token to a NULL value,
     * then save the results.
     */
    public function confirmEmail() {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }



    /**
     * Make sure that the user ID =
     * the current ID of the user.
     *
     * @param $relation
     * @return bool
     */
    public function owns($relation) {
        return $relation->user_id == $this->id;
    }


    /**
     * One user can have many Profile photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Profilephotos() {
        return $this->hasMany('App\ProfilePhoto');
    }


    /**
     * One user can have many Travel Flyers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers() {
        return $this->hasMany('App\Flyer');
    }


    /**
     * Assign the user id and save the travel flyer.
     *
     * @param \App\Flyer $flyer
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function publish(Flyer $flyer) {
        return $this->flyers()->save($flyer);
    }


    /**
     * Find the User.
     *
     * @param $username
     * @return mixed
     */
    public static function LocatedAt($username) {
        // Return username, and give me the first result.
        return static::where(compact('username'))->firstOrFail();
    }


    /**
     * Find a Users ID.
     * -- Used to get users public profile.
     *
     * @param $id
     * @return mixed
     */
    public static function UserLocatedAt($id) {
        // Return username, and give me the first result.
        return static::where(compact('id'))->firstOrFail();
    }



    /**
     * Add ProfilePhoto
     *
     * @param \App\ProfilePhoto $photo
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addProfilePhoto(ProfilePhoto $photo) {
        return $this->Profilephotos()->save($photo);
    }


    /**
     * One user can have many likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes() {
       return $this->hasMany('App\Like', 'user_id');
    }


    /**
     * Check to see if a User has Liked a Flyer once, if they
     * did, put in place a solution so users cant like a status again.
     *
     * @param \App\Flyer $flyer
     * @return bool
     */
    public function hasLikedFlyer(Flyer $flyer) {
        // Return a boolean with $flyer set to likes
        // where the 'likeable_id' = the flyer ID
        // and where the 'likeable_type' = to the class name to the flyer we pass in
        return (bool) $flyer->likes
            ->where('likeable_id', $flyer->id)
            ->where('likeable_type', get_class($flyer))
            ->where('user_id', $this->id)
            ->count();
    }



    public function hasLikedStatus(Status $status) {
        // Return a boolean with $status set to likes
        // where the 'likeable_id' = the status ID
        // and where the 'likeable_type' = to the class name to the status we pass in
        return (bool) $status->likes
            ->where('likeable_id', $status->id)
            ->where('likeable_type', get_class($status))
            ->where('user_id', $this->id)
            ->count();
    }


    /**
     * One User can have many statuses.
     * -- Foreign key is 'user_id' --
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses() {
       return $this->hasMany('App\Status', 'user_id');
    }


    /**
     * One user is related to one points system.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function points() {
       return $this->hasOne('App\Points', 'user_id');
    }


    /**
     * Award Points.
     *
     * @param $points
     * @return mixed
     */
    public function awardPoints($points) {
       return $this->points->award($points);
    }


    /**
     * Calculate how long a user has been registered, to show  badges.
     *
     * @return mixed
     */
    public function userSinceInDays(){

        // Set $created = to "created_at" in 'users' table.
        $created = $this->created_at;

        // Get the current date right now.
        $now = Carbon::now();

        // Set $difference = to calculate the time passed in days from when a user registered to the current date.
        $difference = $created->diff($now)->days;

        // Return $difference.
        return $difference;

    }


}
