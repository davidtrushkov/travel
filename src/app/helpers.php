<?php


/**
 * @param null $title
 * @param null $message
 * @return \Illuminate\Foundation\Application|mixed
 * For the flash messages.
 */
function flash($title = null, $message = null) {
    // Set variable $flash to fetch the Flash Class
    // in Flash.php
    $flash = app('App\Http\Flash');

    // If 0 parameters are passed in ($title, $message)
    // then just return the flash instance.
    if (func_num_args() == 0) {
        return $flash;
    }

    // Just return a regular flash->info message
    return $flash->message($title, $message);
}



/**
 * @param $date
 * @return bool|string
 * Format the time to this
 */
function prettyDate($date) {
    return date("M d, Y", strtotime($date));
}

/**
function displayRandomPhotoArea() {
    $photoAreas = array(
        "/travel/src/public/css/images/default-banners/01.png",
        "/travel/src/public/css/images/default-banners/02.png",
        "/travel/src/public/css/images/default-banners/03.png",
        "/travel/src/public/css/images/default-banners/04.jpg",
        "/travel/src/public/css/images/default-banners/05.jpg",
        "/travel/src/public/css/images/default-banners/06.jpg",

    );

    $randomNumber = rand(0, (count($photoAreas) - 1));

    echo '<img src="' . $photoAreas[$randomNumber] . '" id="Flyer-Banner-Default-Image" ">';
}
**/


    /*
    |--------------------------------------------------------------------------
    | Badge Images
    |--------------------------------------------------------------------------
    |
    | These functions are for the User badges. Each function returns an image
    | for a particular badge.
    |
    */


/********************************* Point Badge Images *********************************/

function ShowPointsFor100() {
    return '/travel/src/public/Badges/Point-Badges/100-points.png';
}

function ShowPointsFor100Shaded() {
    return '/travel/src/public/Badges/Point-Badges/100-points-shaded.png';
}

function ShowPointsFor250() {
    return '/travel/src/public/Badges/Point-Badges/250-points.png';
}

function ShowPointsFor250Shaded() {
    return '/travel/src/public/Badges/Point-Badges/250-points-shaded.png';
}

function ShowPointsFor500() {
    return '/travel/src/public/Badges/Point-Badges/500-points.png';
}

function ShowPointsFor500Shaded() {
    return '/travel/src/public/Badges/Point-Badges/500-points-shaded.png';
}

function ShowPointsFor1000() {
    return '/travel/src/public/Badges/Point-Badges/1000-points.png';
}

function ShowPointsFor1000Shaded() {
    return '/travel/src/public/Badges/Point-Badges/1000-points-shaded.png';
}

function ShowPointsFor2500() {
    return '/travel/src/public/Badges/Point-Badges/2500-points.png';
}

function ShowPointsFor2500Shaded() {
    return '/travel/src/public/Badges/Point-Badges/2500-points-shaded.png';
}

function ShowPointsFor5000() {
    return '/travel/src/public/Badges/Point-Badges/5000-points.png';
}

function ShowPointsFor5000Shaded() {
    return '/travel/src/public/Badges/Point-Badges/5000-points-shaded.png';
}



/********************************* Travel Flyer Badge Images *********************************/

function ShowFlyerFor1() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/first-flyer.png';
}

function ShowFlyerFor1Shaded() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/first-flyer-shaded.png';
}

function ShowFlyerFor5() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/fifth-flyer.png';
}

function ShowFlyerFor5Shaded() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/fifth-flyer-shaded.png';
}

function ShowFlyerFor10() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/tenth-flyer.png';
}

function ShowFlyerFor10Shaded() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/tenth-flyer-shaded.png';
}

function ShowFlyerFor25() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/twentyfifth-flyer.png';
}

function ShowFlyerFor25Shaded() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/twentyfifth-flyer-shaded.png';
}

function ShowFlyerFor50() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/fiftieth-flyer.png';
}

function ShowFlyerFor50Shaded() {
    return '/travel/src/public/Badges/Travel-Flyer-Badges/fiftieth-flyer-shaded.png';
}



/********************************* Signed up Badges *********************************/


function ShowSignedUpFor7Days() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-7.png';
}

function ShowSignedUpFor7DaysShaded() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-7-Shaded.png';
}

function ShowSignedUpFor30Days() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-30.png';
}

function ShowSignedUpFor30DaysShaded() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-30-Shaded.png';
}

function ShowSignedUpFor183Days() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-183.png';
}

function ShowSignedUpFor183DaysShaded() {
    return '/travel/src/public/Badges/Time-SignedUp-Badges/SignedUp-For-183-Shaded.png';
}


