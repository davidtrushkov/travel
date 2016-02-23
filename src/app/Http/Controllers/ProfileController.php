<?php

namespace App\Http\Controllers;

use App\User;
use App\Flyer;
use App\Points;
use App\Status;
use App\ProfilePhoto;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\AddProfilePhotoRequest;


class ProfileController extends Controller {


    /**
     * Get the Dashboard of current signed in user.
     * And get the users statuses
     *
     * @param $username
     * @param Points $points
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboardProfile($username, Points $points) {

        // SELECT from User where username = current username signed in.
        $user = User::where('username', $username)->first();

        // Get a users statuses.
        $statuses = Status::NotReply()->where(function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        })->orderby('created_at', 'desc')->paginate(10);

        // Return view with user.
        return view('profile.index', compact(['user', 'statuses'], ['user', 'statuses']));
    }


    /**
     * Get users Travel Flyers in their Profile Page
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserFlyers($username) {

        // SELECT from User where username = current username signed in.
        $user = User::where('username', $username)->first();

        // Return view with user.
        return view('profile.your-flyers', compact('user'));
    }


    /**
     * Get the Edit profile page.
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditProfile($username) {

        // SELECT from User where username = current username signed in.
        $user = User::where('username', $username)->first();

        // Return view with user.
        return view('profile.edit-profile', compact('user'));
    }


    /*************************************************************************************/


    /**
     * Edit User Profile contents.
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfile(UpdateProfileRequest $request) {

        // Set $user = to the current user
        $user = Auth::user();

        // Access currently Authenticated user and update columns
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'summary' => $request->input('summary'),
        ]);

        flash()->success('Success', 'Profile updated successfully!');

        // Then Redirect to Profile Edit Page
        return redirect()->route('profile.index', $user->username);
    }


    /*************************************************************************************/


    /**
     * Display a Users Travel Flyers in their Profile under Your Flyers section.
     *
     * @param Flyer $flyer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFlyerForProfile(Flyer $flyer) {
        //
        $ProfileTravelFlyers = Flyer::where('user_id', '=', Auth::user()->id)->latest()->get();
        return view('profile.your-flyers', compact('ProfileTravelFlyers'));
    }


    /**
     * Add Profile photo to User.
     *
     * @param $username
     * @param AddProfilePhotoRequest $request
     */
    public function addPhoto($username, AddProfilePhotoRequest $request) {

        // Set $photo to the fromFile() function,
        // and get the $requested file which is set to 'photo',
        // and upload it using the upload function().
        // -- 'photo' comes from the <script> tags in profile/index.blade.php.

        // Create a new photo instance from a file upload.
        $photo = ProfilePhoto::fromFile($request->file('photo'))->upload();

        // Set User::loacatedAt() in (User Model)
        // = to the username, and add the photo.
        // -- Find the user and add the Profile Photo.
        User::locatedAt($username)->addProfilePhoto($photo);

    }


    /**
     * Delete a photo.
     * -- Access delete() in ProfilePhoto.php Model --
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPhoto($id) {

        // Find the ID of the photo and delete it.
        ProfilePhoto::findOrFail($id)->delete();

        return redirect()->back();

    }


    /**
     * Get a users Public Profile with thier information, flyers, and statuses.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPublicProfile ($id) {

        // Locate the users id
        $publicName = User::UserLocatedAt($id);

        // Find the users Travel Flyers.
        $ProfileFlyers = Flyer::where('user_id', '=', $id)->latest()->get();

        // Find the users statuses.
        $statuses = Status::NotReply()->where('user_id', '=', $id)
            ->orderby('created_at', 'desc')->paginate(10);

        // Return a view with ALL users information.
        return view('users.show', compact('publicName', 'ProfileFlyers', 'statuses'));
    }


}
