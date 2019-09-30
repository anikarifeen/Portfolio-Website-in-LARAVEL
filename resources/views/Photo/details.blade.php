@extends('layouts/main')
@section('content')

<div class="callout primary">
<div class="row column">
    <a class="success button" href="/gallery/show/{{$photo->gallery_id}}">Back to Portfolio</a>
    <h1>{{$photo->title}}</h1>
<p class="lead">{{$photo->description}}</p>
<p>Location: {{$photo->location}}</p>

</div>
</div>
<div class="row small-up-2 medium-up-3 large-up-4">
    <div class="main">
        <img class="proimage" src="/images/{{$photo->image}}"/>
        
        <p style="text-align: center; margin-top: 10px;">
            <?php if(Auth::check()) : ?>
            <a class="button" href="/photo/edit/{{$photo->id}}/">Update Portfolio</a>
        
            <a class="alert button" href="/photo/destroy/{{$photo->id}}/{{$photo->gallery_id}}/" onclick="return confirm('Are you sure you want to delete this item?');">Delete Portfolio</a>
            <?php endif; ?>
        </p>
  
    </div>
</div>
@endsection


