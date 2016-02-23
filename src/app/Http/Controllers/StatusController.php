<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller {


    /**
     * Save a status into the Database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStatus(Request $request) {

        // Check if status exits
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);

        // create status in DB
        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        // then redirect back.
        return redirect()->back();
    }


    /**
     * Post a reply into the database.
     *
     * @param Request $request
     * @param $statusId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postReply(Request $request, $statusId) {
        // validate
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
            'required' => 'The reply body is required.'
        ]);

        // Set $status to Status::notReply, also find the status ID we need to reply to.
        // -- "notReply" located in Status.php Model --
        $status = Status::NotReply()->find($statusId);

        // check if status exists.
        if (!$status) {
            return redirect()->back();
        }

        // Insert status in Database, and associate it with the current user signed in.
        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        // Save the replies.
        // -- "replies" located in Status.php Model --
        $status->replies()->save($reply);

        return redirect()->back();
    }


    /**
     * Get the status Like, and store it in DB.
     *
     * @param $statusId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLike($statusId) {
        // Find the status being liked.
        $status = Status::find($statusId);

        // If status does not exist, redirect to home.
        if (!$status) {
            return redirect('/');
        }

        // Check if the currently signed in user already liked the status.
        if (Auth::user()->hasLikedStatus($status)) {
            return redirect()->back();
        }

        // Create the like in the DB.
        $like = $status->likes()->create([]);

        // Save the like to the currently signed in user.
        Auth::user()->likes()->save($like);

        return redirect()->back();

    }

}