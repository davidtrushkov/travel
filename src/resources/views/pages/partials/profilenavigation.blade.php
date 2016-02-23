
<nav id="tf-menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Travel Share</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (!$signedIn)
                    <li><a href="{{ url('/') }}" class="page-scroll">Home</a></li>
                    <li><a href="{{ route('travelflyers.index') }}" class="page-scroll">Travel Flyers</a></li>
                    <li><a href="{{ route('travelflyers.create') }}" class="page-scroll"> <i class="inverted blue world icon big"></i></a></li>
                    <li><a href="{{ url('/login') }}" class="page-scroll">Login</a></li>
                    <li><a href="{{ url('/register') }}" class="page-scroll">Register</a></li>
                @else
                    <li><a href="{{ url('/') }}" class="page-scroll">Home</a></li>
                    <li><a href="{{ route('travelflyers.index') }}" class="page-scroll">Travel Flyers</a></li>
                    <li><a href="{{ route('travelflyers.create') }}" class="page-scroll"> <i class="inverted blue world icon big"></i></a></li>
                    <li><a href="{{ route('profile.index', $user->username) }}" class="page-scroll">{{ $user->username }}</a></li>
                    <li><a href="{{ route('leaderboards.index') }}" class="page-scroll"><i class="fa fa-diamond"></i> {{ $user->points->points }}</a></li>
                    <li><a href="{{ url('/logout') }}" class="page-scroll"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<!-- Home Page
    ==========================================-->
<div id="tf-home-profile" class="text-center">
    <div class="overlay">
        <div class="content-profile">
                @foreach ($user->Profilephotos as $photo)
                        <div class="img-wrap">
                            <form method="post" action="{{ route('profile.delete', ['id' => $photo->id]) }}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                @if(Auth::check() == $user->username)
                                    <button type="submit" class="close">&times;</button>
                                @endif
                                <img class="ui small circular image" src="{{ asset($photo->thumbnail_path) }}" alt="{{$user->username}}'s profile photo" data-id="{{ $photo->id }}" id="Profile-image">
                            </form>
                        </div>
                @endforeach
            <div class="card-info">{{ $user->username }}</div>
        </div>
    </div>
</div>

<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a href="{{ route('profile.index', $user->username) }}">
            <button type="button" id="stars" class="btn btn-primary"><i class="dashboard icon"></i>
                <div class="hidden-xs">Dashboard</div>
            </button>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('users.show', $user->id) }}">
            <button type="button" id="stars" class="btn btn-primary"><i class="users icon"></i>
                <div class="hidden-xs">Public Profile</div>
            </button>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('profile.your-flyers', $user->username) }}">
            <button type="button" id="favorites" class="btn btn-primary"><i class="book icon"></i>
                <div class="hidden-xs">Your Travel Flyers</div>
            </button>
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('profile.edit-profile', $user->username) }}">
            <button type="button" id="following" class="btn btn-primary"><i class="settings icon"></i>
                <div class="hidden-xs">Edit Profile</div>
            </button>
        </a>
    </div>
</div>

<br><br>