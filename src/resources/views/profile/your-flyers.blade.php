@extends('home')

@section('content')


    @include('pages.partials.profilenavigation')

    <div class="container" id="Your-Travel-Flyers-Container">

        <h2 id="Travel-Badges">Your Travel Flyers</h2>

        @if (!$ProfileTravelFlyers->count())
            You have no Travel Flyers yet.
        @else
            @foreach($ProfileTravelFlyers as $flyer)
                <div class="col-sm-6 col-md-4">
                    <div class="row">
                        <div class="ui link cards" id="Travel-Flyer-Display-Cards">
                            <div class="card" id="Flyer-Card">
                                <div class="image">
                                    <a href="{{ route('travelflyers.show', $flyer->title) }}">
                                        @foreach ($flyer->bannerPhotos as $photo)
                                            <img src="/travel/{{ $photo->thumbnail_path }}" alt="{{ $flyer->owner->username }}" data-id="{{ $photo->id }}">
                                        @endforeach
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{ route('travelflyers.show', $flyer->title) }}">
                                        <h4 class="ui header"> {{ str_limit($flyer->title, $limit = 80, $end = '...') }}</h4>
                                    </a>
                                    <div class="meta"><br>
                                        @foreach ($flyer->owner->Profilephotos as $photo)
                                            <a href="{{ route('users.show', $flyer->id) }}" class="avatar">
                                                <img class="ui avatar image mini" src="/travel/{{ $photo->thumbnail_path }}" alt="{{ $flyer->owner->username }}'s Profile Picture">
                                                <span id="Flyer-Username-Index-Page">{{ $flyer->owner->username }}</span>
                                            </a>
                                        @endforeach
                                    </div><br>
                                    <div class="meta">
                                        <a>{{ str_limit($flyer->excerpt, $limit = 79, $end = '...') }}</a>
                                    </div>
                                </div>
                                <div class="extra content">
                                    <span class="left floated">
                                        <a href="{{ route('travelflyers.show', $flyer->title) }}">
                                            <i class="unhide icon green large"></i>
                                        </a>
                                        <a href="{{ route('travelflyers.edit', $flyer->id) }}">
                                            <i class="edit icon blue large"></i>
                                        </a>
                                        {{ prettyDate($flyer->created_at) }}
                                    </span>
                                    <form method="post" action="{{ route('profile.destroy', ['id' => $flyer->id]) }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <span class="right floated">
                                            <button class="circular ui icon button red mini" onclick="return confirm('Are you sure?')">
                                                <i class="remove icon"></i>
                                            </button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif



    </div>  <!-- Close Container -->

@endsection