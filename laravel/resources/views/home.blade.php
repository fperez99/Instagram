@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="list-group">
        @foreach ($images as $image)
        <li class="list-group-item" style="margin: 2% 0;">
            <div>
                <p><span>{{$image->user->name}}</span>|@<span>{{$image->user->nick}}</span></p>
                <figure class="figure">
                    <img src="{{ route('image.file',['filename'=>$image->image_path])}}" class="img-thumbnail"> 
                    <figcaption class="figure-caption">@<span>{{$image->user->nick}}</span>|<span>{{substr($image->created_at,0,10)}}</span><br><br>
                    <p>{{$image->description}}</p>
                    </figcaption>
                </figure>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection