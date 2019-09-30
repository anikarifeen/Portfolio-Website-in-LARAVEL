@extends('layouts/main')
@section('content')
<div class="callout primary">
<div class="row column">
    <h1>Upload portfolio</h1>
<p class="lead">Upload your portfolio here</p>
</div>
</div>
<div class="row small-up-2 medium-up-3 large-up-4">
    <div class="maindiv">
        {!!Form::open(array('action' => 'PhotoController@store', 'enctype' => 'multipart/form-data'))!!}
        {!!Form::label('title', 'Title')!!}
        {!!Form::text('title', $value = null, $attributes=[ 'placeholder' => 'Portfolio Title', 'name' => 'title', 'required' => 'required'])!!}
        
        {!!Form::label('description', 'Description')!!}
        {!!Form::text('description', $value = null, $attributes=[ 'placeholder' => 'Gallery Description', 'name' => 'description', 'required' => 'required'])!!}
        
        {!!Form::label('location', 'Location')!!}
        {!!Form::text('location', $value = null, $attributes=[ 'placeholder' => 'Portfolio Location', 'name' => 'location', 'required' => 'required'])!!}
        
        {!!Form::label('image', 'Portfolio Image')!!}
        {!!Form::file('image')!!}
        
        <input type="hidden" name="gallery_id" value="{{$gallery_id}}">
        
        {!!Form::submit('Submit', $attributes = ['class' => 'button'])!!}


        {!!Form::close()!!}
		
    </div>
</div>
@endsection


