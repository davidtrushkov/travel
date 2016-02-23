@extends('home')




@section('content')

    @include('pages.partials.navigation')

    <div class="container" id="Create-Edit-Container">

        <h2 class="ui center aligned icon header">
            <i class="circular travel icon"></i>
            Create New Travel Flyer
        </h2>

        <hr>

        <form method="post" action="{{ URL('travelflyers') }}" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="col-md-6">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title Of Travel Flyer:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Title of Travel Flyer...">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group{{ $errors->has('excerpt') ? ' has-error' : '' }}">
                    <label for="excerpt">Excerpt:</label>
                    <input type="text" name="excerpt" id="excerpt" class="form-control" value="{{ old('excerpt') }}" placeholder="Short Description Of Travel Flyer...">
                    @if($errors->has('excerpt'))
                        <span class="help-block">{{ $errors->first('excerpt') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Travel Flyer Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="10" placeholder="Travel Flyer Description..." maxlength="3000">{{ old('description') }}</textarea>
                    <div id="textarea_count"></div>
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

            </div>  <!-- Close col-md-12 -->


                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                        <label>Enter Travel FLyer Locations Here:</label>
                        <input type="text" name="location" class="form-control" id="pac-input" placeholder="Search Places..." value="{{ old('location') }}" >
                        @if($errors->has('location'))
                            <span class="help-block">{{ $errors->first('location') }}</span>
                        @endif
                    </div><div id="map"></div>
                </div>

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                        <label for="lat">Lat:</label>
                        <input type="text" class="form-control input-sm" name="lat" id="lat" value="{{ old('lat') }}">
                        @if($errors->has('lat'))
                            <span class="help-block">{{ $errors->first('lat') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                        <label for="lng">Lng:</label>
                        <input type="text" class="form-control input-sm" name="lng" id="lng" value="{{ old('lng') }}">
                        @if($errors->has('lng'))
                            <span class="help-block">{{ $errors->first('lng') }}</span>
                        @endif
                    </div>
                </div>

                <p><i>You can upload photos after you create the Travel Flyer</i></p>

                <div class="col-md-12">
                    <hr>
                    <div class="form-group">
                        <button class="ui inverted green button">Create</button>
                        <a href="{{ route('travelflyers.index') }}" class="ui inverted red button">Cancel</a>
                    </div>
                </div>

        </form>

    </div>  <!-- close container -->

    <br><br>

@stop

@section('scripts.footer')
    <script type="application/javascript" src="{{ URL::asset('src/public/js/maps/create-google-map.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaB_9hgeARViVKIT6O1pFKXRCSuYaol2A&libraries=places&callback=initAutocomplete"></script>
@stop

