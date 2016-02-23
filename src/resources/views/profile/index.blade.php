@extends('home')

@section('content')

    @include('pages.partials.profilenavigation')

    <div class="container">

        <div class="col-md-12">
            <div class="col-sm-4 col-md-4">
                <div class="profile-content">
                    <div class="meta">Joined On: {!! prettyDate($user->created_at) !!}</div>
                    <div class="meta">Last Login: {!! prettyDate($user->last_login) !!}</div>
                    <div class="description">
                        @if ($user->first_name == "" && $user->first_last == "")
                            Name Unknown
                        @else
                            Name: {{$user->first_name}} {{ $user->last_name }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="profile-content">
                    <div class="description">
                        @if ($user->country == "")
                            <i class="marker icon"></i>Country Unknown
                        @else
                            <i class="marker icon"></i>{{$user->country}}
                        @endif
                    </div>
                    <div class="description">
                        @if ($user->gender == 'Male')
                            <i class="male icon"></i>{{$user->gender}}
                        @elseif ($user->gender == 'Female')
                            <i class="female icon"></i>{{$user->gender}}
                        @else
                            <i class="question icon"></i>Gender Unknown
                        @endif
                    </div>
                    <div class="description">
                        @if ($user->age > 0)
                            <i class="user icon"></i>{{$user->age}} years old
                        @else
                            <i class="user icon"></i>Age: Unknown
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="profile-content">
                    <div class="description">
                        <i class="travel icon"></i>
                       {{ $user->flyers->count() }} Travel {{ str_plural('Flyer', $user->flyers->count()) }}
                    </div>
                    <div class="description">
                        <i class="fa fa-diamond"></i>
                         &nbsp;{{ $user->points->points }}
                    </div>
                    <div class="description">
                        <i class="thumbs up outline icon"></i>
                        {{ $user->likes->count() }} Flyer-Status likes
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12">
                <div id="Profile-Description">
                    <p id="description-text">DESCRIPTION:</p>
                    @if ($user->summary == "")
                        <p>No Summary</p>
                    @else
                        {{$user->summary}}
                    @endif
                </div>
            </div>

        </div>  <!-- Close col-md-12 -->

        <div class="col-md-12" id="ProfileFormUpload">
            <hr>
            <h5 class="text-center">Upload Profile Photo:</h5>
            <form action="/travel/{{ $user->username }}/photos" method="post" class="dropzone" id="addPhotosForm" enctype="multipart/form-data">
                {{ csrf_field() }}
            </form>
        </div>


        <div class="col-md-12" id="badges-container">
            @include('profile.partials.badges')
        </div>

        <div class="col-md-12">
            @include('profile.partials.profile-status')
        </div>

    </div>  <!-- Close Container -->

@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script type="application/javascript" src="{{ URL::asset('/src/public/js/dropzone.forms.js') }}"></script>
@stop