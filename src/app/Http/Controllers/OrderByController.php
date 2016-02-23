<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderByController extends TravelFlyersController {


    /**
     * @param Flyer $flyer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function travelDateAsc(Flyer $flyer)
    {
        $flyer = Flyer::orderBy('created_at', 'asc')->paginate(15);

        return view('travelflyers.index', ['flyer' => $flyer]);
    }


    /**
     * @param Flyer $flyer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function travelDateDesc(Flyer $flyer)
    {
        $flyer = Flyer::orderBy('created_at', 'desc')->paginate(15);

        return view('travelflyers.index', ['flyer' => $flyer]);
    }

}