<?php

namespace App\Listeners;

class PointsListener {


    /**
     * when a user creates a Travel Flyer, award them 100 Points.
     * -- awardPoints() in User.php Model --
     *
     * @param $user
     */
    public function whenUserCreatedFlyer($user) {
        $user->awardPoints(100);
    }


    /**
     * when a user completes a lesson award them 50 Points.
     * -- awardPoints() in User.php Model --
     *
     * @param $user
     */
    public function whenUserCompletedLesson($user) {
        $user->awardPoints(50);
    }


}