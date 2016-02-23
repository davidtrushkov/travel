<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\FlyerPhoto;
use App\AddPhotoToTravelFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlyerPhotoRequest;


class FlyerPhotosController extends Controller {


    /**
     * Add photos to a flyer.
     *
     * @param $title
     * @param FlyerPhotoRequest $request
     */
    public function store($title, FlyerPhotoRequest $request) {
        // Set $flyer = Flyer::LocatedAt() in (Flyer.php Model) = to the title
        // -- Find the flyer.
        $flyer = Flyer::LocatedAt($title);

        // Store the photo from the file instance
        // -- ('photo') is coming from "public/js/dropzone.forms.js" --
        $photo = $request->file('photo');

        // Create dedicated class to add photos to travel Flyer, and save the photos.
        (new AddPhotoToTravelFlyer($flyer, $photo))->save();
    }


    /**
     * Delete a photo with this Travel Flyer.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        // Find the photo and delete it.
        FlyerPhoto::findOrFail($id)->delete();
        // Then return back;
        return back();
    }


}