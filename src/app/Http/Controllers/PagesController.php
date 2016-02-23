<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PagesController extends Controller {


    /**
     * Show Flyer Banner and title in the google maps on the front-page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        // Select ALL from 'flyers', join 'flyer_banner' table where the 'flyers "id" = "flyer_id" in 'flyer_banner' table.
        $flyer = DB::table('flyers')
            ->join('flyer_banner', function ($join) {
                $join->on('flyers.id', '=', 'flyer_banner.flyer_id');
            })->get();

        // Return view.
        return view('pages.index', compact('flyer'));
    }


    /**
     * Show Points leader boards for all signed up users on website.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leaderBoards() {

        // SELECT ALL from 'points' table, join 'users', where "user_id" in 'points' table = "id" on 'users' table,
        // order by "points" maximum.
        $points = DB::table('points')
            ->join('users', function ($join) {
                $join->on('points.user_id', '=', 'users.id');
            })->orderby('points', 'max')->get();


        // Return view with points.
        return view('leaderboards.index', compact('points'));
    }


}