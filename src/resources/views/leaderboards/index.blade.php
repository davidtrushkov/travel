@extends('home')

@section('content')

    @include('pages.partials.navigation')

    <div class="container" id="LeaderBoard-Container">

        <div class="col-md-2"></div>

        <div class="col-md-8" id="LeaderBoard-Table-Container">
            <table class="ui celled striped selectable inverted table" id="LeaderBoard-Table">
                <thead>
                    <tr>
                        <th colspan="3" class="center aligned">
                            <i class="yellow trophy icon"></i>  Leaderboards
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="center aligned">Username</th>
                        <th class="center aligned"><i class="fa fa-diamond"></i> Points</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach ($points as $point)
                    <tr>
                        <td>
                            <a href="{{ route('users.show', $point->id) }}">
                                <p id="Leader-Board-Number"># {{ $i }}</p>
                            </a>
                        </td>
                        <td class="center aligned">
                            <a href="{{ route('users.show', $point->id) }}">
                                <p id="Leader-Board-Username">{{ $point->username }}</p>
                            </a>
                        </td>
                        <td class="center aligned"><i class="fa fa-diamond"></i> {{ $point->points }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-2"></div>

    </div>

@stop
