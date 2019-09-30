@extends('layouts/main')
@section('content')
<div class="callout primary">
<div class="row column">
   
    <h1>{{$gallery->name}}</h1>
<p class="lead">{{$gallery->description}}</p>
<a class="alert button" href="/">Back to Portfolio</a>
<?php if(Auth::check()) : ?>
<a class="success button" href="/photo/create/{{ $gallery->id }}">Upload Portfolio</a>
<?php endif ?>
</div>
</div>
<div class="row small-up-2 medium-up-3 large-up-4">
    <?php foreach ($photos as $photo) : ?>
    <div class="column">
        <a href="/photo/details/{{$photo->id}}">
        <img class="thumbnail" src="/images/{{$photo->image}}"/>
        </a>
        <h5>{{$photo->title}}</h5>
        <p>{{$photo->description}}</p>
        <p>{{$photo->location}}</p>
        
    </div>
    <?php endforeach; ?>
</div>
@endsection


