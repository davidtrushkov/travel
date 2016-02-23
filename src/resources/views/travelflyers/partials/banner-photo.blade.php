
@foreach ($flyer->bannerPhotos as $photo)
        <div class="img-wrap-flyer">
            <form method="post" action="{{ route('flyer.delete.banner', ['id' => $photo->id]) }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                @if ($user && $user->owns($flyer))
                    <button type="submit" class="close">&times;</button>
                @endif
                <img src="/travel/{{ $photo->thumbnail_path }}" alt="{{ $flyer->owner->username }}" data-id="{{ $photo->id }}" id="Banner-image" class="test">
            </form>
        </div>
@endforeach





@if ($user && $user->owns($flyer))
    <div class="col-md-12" id="FlyerBannerFormUpload">
        <h5 class="text-center">Upload Photo Banner:</h5>
        <form action="/travel/{{ $flyer->title }}/banner" method="post" class="dropzone" id="addBannerForm" enctype="multipart/form-data">
            {{ csrf_field() }}
        </form>
    </div>
@endif
