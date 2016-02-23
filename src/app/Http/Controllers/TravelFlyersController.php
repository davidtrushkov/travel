<?php

namespace App\Http\Controllers;

use App\User;
use App\Flyer;
use App\FlyerBanner;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\FlyerBannerRequest;
use App\Http\Requests\TravelFlyersRequest;

class TravelFlyersController extends Controller {


    /**
     * Create a Authentication middleware for travel flyers.
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
        // Reference the main constructor.
        parent::__construct();
    }


    /**
     * Display a listing of all the travel Flyers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // Get a listing of all Travel Flyers that DON'T exceed the current date
        // -- "published" used in TravelFlyers Model --
        $flyer = Flyer::latest('created_at')->paginate(15);

        // Grt the user who created this Travel Flyer.
        $publicUser = User::all();

        // Return the view
        return view('travelflyers.index', compact('flyer', 'publicUser'));
    }


    /**
     * Create a Travel Flyer.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('travelflyers.create');
    }


    /**
     * Store a new travel flyer in Database.
     *
     * @param TravelFlyersRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TravelFlyersRequest $request) {

        // Get the currently authenticated user
        // and publish a new Travel Flyer to database.
        // -- publish() is from User.php Model --
        $flyer = $this->user->publish(new Flyer($request->all()));

        $user = Auth::user();

        // Fire off this event for when a user creates a Travel Flyer \
        // which awards a user with points for completing this task.
        event('UserCreatedFlyer', $user);

        flash()->success('Success', 'Travel Flyer created successfully! You earned 100 points');

        // Redirect to the created Travel Flyer.
        // -- pathToTravelFlyer located in Flyer.php Model. --
        return redirect($flyer->pathToTravelFlyer());
    }


    /**
     * Show a Travel Flyer in detail.
     * -- with title being the url
     *
     * @param $title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($title) {
        // Set $travelFlyer = TravelFlyerLocatedAt scope in (TravelFlyers Model)
        // = to the title, and fetch the first one first.
        $flyer = Flyer::LocatedAt($title);

        // return a view with the travel Flyer.
        return view('travelflyers.show', compact('flyer'));
    }


    /**
     * Edit the Travel Flyers by showing the Flyers ID.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id) {
        // Get the travel flyer where the user_id on that flyer = the current logged in users id
        $flyer = Flyer::where('user_id', '=', Auth::user()->id)->find($id);

        // If it does not belong to the current user redirect them back to flyers page.
        if (!$flyer) {
            return redirect('travelflyers');
        }

        return view('travelflyers.edit', compact('flyer'));
    }


    /**
     * Update the edited flyer.
     *
     * @param $id
     * @param TravelFlyersRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, TravelFlyersRequest $request) {
        // Find the travel flyer associated with this ID.
        $flyer = Flyer::findOrFail($id);

        // Update the flyer with validation.
        $flyer->update($request->all());

        flash()->success('Success', 'Travel Flyer update successfully!');

        return redirect('travelflyers');
    }


    /**
     * Delete a Travel Flyer.
     *
     * @param $id
     * @param Flyer $flyer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Flyer $flyer) {

        // Find the Travel Flyer.
        $flyer = Flyer::findOrFail($id);

        // Delete the travel Flyer.
        $flyer->delete();

        flash()->success("Success", "Travel Flyer deleted successfully!");

        return redirect()->back();

    }


    /**
     * Add banner photo to a flyer.
     *
     * @param $title
     * @param FlyerBannerRequest $request
     */
    public function addBannerPhoto($title, FlyerBannerRequest $request) {
        // create a new photo instance from a file upload
        $photo = FlyerBanner::fromFile($request->file('photo'))->upload();

        // Set Flyer::LocatedAt() in (Flyer.php Model)
        // = to the title, and add the banner photo.
        // -- Find the flyer and add the banner photo.
        Flyer::LocatedAt($title)->addBannerPhoto($photo);
    }


    /**
     * Delete a banner photo.
     *
     * -- Access delete() in FlyerBanner.php Model --
     */
    public function destroyBannerPhoto($id) {

        // Find and delete a Banner photo.
        FlyerBanner::findOrFail($id)->delete();

        return redirect()->back();

    }


    /**
     * Get the Flyer Like, and store it in DB.
     *
     * @param $flyerId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLike($flyerId) {
        // Find the flyer being liked.
        $flyer = Flyer::find($flyerId);

        // If flyer does not exist, redirect to home.
        if (!$flyer) {
           return redirect('/');
        }

        // Check if the currently signed in user already liked the flyer.
        if (Auth::user()->hasLikedFlyer($flyer)) {
           return redirect()->back();
        }

        // Create the like in the DB.
        $like = $flyer->likes()->create([]);

        // Save the like to the currently signed in user.
        Auth::user()->likes()->save($like);

        return redirect()->back();

    }


    /**
     * Search for Travel Flyers, and also check if any exist.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search() {
        // Get the input words from <input> box in search
        $keyword = Input::get('keyword');

        // Select title or location from table flyers where it matches the <inout> keyword.
        $flyers = Flyer::where('title', 'LIKE', '%' .$keyword. '%')->orWhere('location', 'LIKE', '%' .$keyword. '%')->get();

        // If no results come up, flash info message with no results found message.
        if ($flyers->isEmpty()) {
            flash()->info('Not Found', 'No search results found.');
            return redirect('travelflyers');
        }

        return view('travelflyers.search', ['flyers' => $flyers]);
    }


}
