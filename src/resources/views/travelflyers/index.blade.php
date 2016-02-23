@extends('home')

@section('content')

    @include('pages.partials.navigation')

    <div class="container-fluid" id="Flyers-Search-Fluid-Container">
        <div class="container" id="Flyers-Search-Sub-Container">
            <div class="jumbotron" id="Flyers-Search-Jumbotron">
                <div class="col-sm-9 col-md-9">

                    {!! Form::open(array('url' => 'travelflyers/search')) !!}
                        <div class="typeahead-container">
                            <div class="typeahead-field">

                                <span class="typeahead-query">
                                    {!! Form::text('keyword', null, array('id' => 'flyer-query', 'placeholder' => 'Search Flyers...', 'autocomplete' =>'off')) !!}
                                </span>
                                {!! Form::submit('Search', ['class' => 'ui inverted button', 'id' => 'Search-Button']) !!}

                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
                <div class="col-sm-3 col-md-3">
                    <a href="{{ route('travelflyers.desc') }}" class="ui inverted button">
                        Newest
                    </a>
                    <a href="{{ route('travelflyers.asc') }}" class="ui inverted button">
                        Oldest
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding-bottom: 18%;">

        <div class="col-md-12" id="Flyers-ShowAll-Container">
            @foreach($flyer as $flyers)
                <div class="col-sm-6 col-md-4">
                    <div class="row">
                        <div class="ui link cards" id="Travel-Flyer-Display-Cards">
                            <div class="card" id="Flyer-Card">
                                <div class="image">
                                    <a href="{{ route('travelflyers.show', $flyers->title) }}">
                                        @foreach ($flyers->bannerPhotos as $photo)
                                            <img src="/travel/{{ $photo->thumbnail_path }}" alt="{{ $flyers->owner->username }}" data-id="{{ $photo->id }}">
                                        @endforeach
                                    </a>
                                </div>
                                <div class="content">
                                    <a href="{{ route('travelflyers.show', $flyers->title) }}">
                                        <h4 class="ui header"> {{ str_limit($flyers->title, $limit = 80, $end = '...') }}</h4>
                                    </a>
                                    <div class="meta"><br>
                                        @foreach ($flyers->owner->Profilephotos as $photo)
                                            <a href="{{ route('users.show', $flyers->owner->id) }}" class="avatar">
                                                <img class="ui avatar image mini" src="/travel/{{ $photo->thumbnail_path }}" alt="{{ $flyers->owner->username }}'s Profile Picture">
                                            </a>
                                        @endforeach
                                        <a href="{{ route('users.show', $flyers->owner->id) }}">
                                            <span id="Flyer-Username-Index-Page">{{ $flyers->owner->username }}</span>
                                        </a>
                                    </div><br>
                                    <div class="meta">
                                        <a>{{ str_limit($flyers->excerpt, $limit = 79, $end = '...') }}</a>
                                    </div>
                                </div>
                                <div class="extra content">
                                    <span class="right floated">
                                        {{ prettyDate($flyers->created_at) }}
                                    </span>
                                    <span>
                                        <i class="thumbs up icon"></i>{{ $flyers->likes->count() }}&nbsp;
                                        @if ($user && $user->owns($flyers))
                                            <a href="{{ route('travelflyers.edit', $flyers->id) }}">
                                                <i class="edit icon"></i>
                                            </a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        {!! $flyer->links() !!}
    </div>  <!-- close container -->

@stop


@section('scripts.footer')
    <script type="application/javascript" src="{{ asset('src/public/js/libs/typeahead.js') }}"></script>
    <script>
        $('#flyer-query').typeahead({
            minLength: 1,
            source: {
                data: [
                    @foreach($flyer as $flyers)
                         "{{ $flyers->title }}",
                    @endforeach
                ]
            }
        });
    </script>
@stop
