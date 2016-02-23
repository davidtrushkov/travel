<br>
<!-- If NOT signed in, show Login to post status link -->
@if (!$signedIn)
<a href="{{ url('/login') }}">Login to reply and post statuses</a>
@endif

<br><h3 class="ui dividing header">{{ $publicName->username }}'s Statuses</h3>

<!-- If NOT signed in, don't show Post status box -->
@if (!$signedIn)

@elseif ($user->id === $publicName->id)
    <div class="row">
        <div class="col-sm-8 col-lg-6">
            <br>
            <form role="form" action="{{ route('status.post') }}" method="post">
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <div class="ui form">
                        <div class="field">
                            <textarea placeholder="Post a status..." name="status" class="form-control" rows="4"></textarea>
                            @if($errors->has('status'))
                                <span class="help-block">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default">Post Status</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </form>
            <hr>
        </div>
    </div>

@endif


<div class="row">
    <div class="col-sm-8 col-lg-6">
        @if (!$statuses->count())
            <p>There is nothing in {{ $publicName->username }}'s statuses timeline yet.</p>
        @else
            @foreach($statuses as $status)
                <div class="media">
                    @foreach ($publicName->Profilephotos as $photo)
                        <div class="ui comments" id="Public-ui-comments">
                            <div class="comment">
                                <a class="avatar">
                                    <img alt="" src="/travel/{{ $photo->thumbnail_path }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="media-body" id="Public-media-body">
                        <h4 class="media-heading">{{ $status->user->username }}</h4>
                        <p>{{ $status->body }}</p>
                        <ul class="list-inline">
                            <li>{{ $status->created_at->diffForHumans() }}</li>
                            <li>
                                <a href="{{ route('status.like', ['statusId' => $status->id])}}" id="thumbs-like-popup">
                                    <i class="thumbs outline up icon small"></i> {{ $status->likes->count() }}
                                </a>
                            </li>
                        </ul>

                        @foreach ($status->replies as $reply)
                            <div class="media" id="Public-media">
                                @foreach ($reply->user->Profilephotos as $photo)
                                    <div class="ui comments" id="Public-ui-comments">
                                        <div class="comment">
                                            <a class="avatar">
                                                <img alt="" src="/travel/{{ $photo->thumbnail_path }}">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="media-body" id="Public-media-body">
                                    <h5 class="media-heading">{{ $reply->user->username }}</h5>
                                    <p>{{ $reply->body }}</p>
                                    <ul class="list-inline">
                                        <li>{{ $reply->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <!-- If NOT signed in, don't show replies text box -->
                        @if (!$signedIn)

                        @else
                            <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post"  id="Public-reply-form">
                                <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
                                    <div class="ui form">
                                        <div class="field">
                                            <textarea name="reply-{{ $status->id }}" class="form-control" rows="3" placeholder="Reply to this status"></textarea>
                                            @if($errors->has("reply-{$status->id}"))
                                                <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default">Reply</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            {!! $statuses->render() !!}
        @endif

    </div>
</div>



