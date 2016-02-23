<h2 id="Points-Badges">Point Badges</h2>

<div class="row">
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 100)
                <img src="{{ ShowPointsFor100() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 100 Points</h4>
            @else
                <img src="{{ ShowPointsFor100Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 100 Points</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 250)
                <img src="{{ ShowPointsFor250() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 250 Points</h4>
            @else
                <img src="{{ ShowPointsFor250Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 250 Points</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 500)
                <img src="{{ ShowPointsFor500() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 500 Points</h4>
            @else
                <img src="{{ ShowPointsFor500Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 500 points</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 1000)
                <img src="{{ ShowPointsFor1000() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 1000 Points</h4>
            @else
                <img src="{{ ShowPointsFor1000Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 1000 points</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 2500)
                <img src="{{ ShowPointsFor2500() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 2500 Points</h4>
            @else
                <img src="{{ ShowPointsFor2500Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 2500 points</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->points->points >= 5000)
                <img src="{{ ShowPointsFor5000() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You Earned 5000 Points</h4>
            @else
                <img src="{{ ShowPointsFor5000Shaded() }}" class="ui small circular image">
                <h4 id="badges-description">Earn 5000 points</h4>
            @endif
        </div>
    </div>
</div>



<hr><h2 id="Travel-Badges">Travel Flyer Badges</h2>

<div class="row">
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->flyers->count() >= 1)
                <img src="{{ ShowFlyerFor1() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You created your 1st Travel Flyer!</h4>
            @else
                <img src="{{ ShowFlyerFor1Shaded() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">Create Your 1st Travel Flyer</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->flyers->count() >= 5)
                <img src="{{ ShowFlyerFor5() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You created your 5th Travel Flyer!</h4>
            @else
                <img src="{{ ShowFlyerFor5Shaded() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">Create Your 5th Travel Flyer</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->flyers->count() >= 10)
                <img src="{{ ShowFlyerFor10() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You created your 20th Travel Flyer!</h4>
            @else
                <img src="{{ ShowFlyerFor10Shaded() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">Create Your 20th Travel Flyer</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->flyers->count() >= 25)
                <img src="{{ ShowFlyerFor25() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You created your 25th Travel Flyer!</h4>
            @else
                <img src="{{ ShowFlyerFor25Shaded() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">Create Your 25th Travel Flyer</h4>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="row">
            @if ($user->flyers->count() >= 50)
                <img src="{{ ShowFlyerFor50() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">You created your 50th Travel Flyer!</h4>
            @else
                <img src="{{ ShowFlyerFor50Shaded() }}" class="ui small circular image" id="Badge">
                <h4 id="badges-description">Create Your 50th Travel Flyer</h4>
            @endif
        </div>
    </div>
</div>


<hr><h2 id="Travel-Badges">Signed Up Badges</h2>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row">
            @if ($user->userSinceInDays() >= 7)
                <div class="col-xs-6 col-sm-4 col-md-2">
                    <img src="{{ ShowSignedUpFor7Days() }}" class="ui small circular image" id="Badge">
                    <h4 id="badges-description">Signed up for 7 days! </h4>
                </div>
            @else
                <div class="col-xs-6 col-sm-4 col-md-2">
                    <img src="{{ ShowSignedUpFor7DaysShaded() }}" class="ui small circular image" id="Badge">
                    <h4 id="badges-description">Be signed up for 7 days </h4>
                </div>
            @endif

            @if ($user->userSinceInDays() >= 30)
                <div class="col-xs-6 col-sm-4 col-md-2">
                    <img src="{{ ShowSignedUpFor30Days() }}" class="ui small circular image" id="Badge">
                    <h4 id="badges-description">Signed up for 30 days! </h4>
                </div>
            @else
                <div class="col-xs-6 col-sm-4 col-md-2">
                    <img src="{{ ShowSignedUpFor30DaysShaded() }}" class="ui small circular image" id="Badge">
                    <h4 id="badges-description">Be signed up for 30 days </h4>
                </div>
            @endif

                @if ($user->userSinceInDays() >= 183)
                    <div class="col-xs-6 col-sm-4 col-md-2">
                        <img src="{{ ShowSignedUpFor183Days() }}" class="ui small circular image" id="Badge">
                        <h4 id="badges-description">Signed up for 6 months! </h4>
                    </div>
                @else
                    <div class="col-xs-6 col-sm-4 col-md-2">
                        <img src="{{ ShowSignedUpFor183DaysShaded() }}" class="ui small circular image" id="Badge">
                        <h4 id="badges-description">Be signed up for 6 months </h4>
                    </div>
                @endif
        </div>
    </div>
</div>
