@extends('dashboard.master')
@section('content')

@csrf

<div class="form-group">
    <label for="title">Titulo</label> 
    <input readonly class="form-control" type="text" name="title" id="title" value="{{ $post->title }}"> 
   
    @error('title')
      <small class="text ">{{$message}}</small>
    @enderror

<div class="form-group">
    <label for="url_clean">Url Limpia</label> 
    <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{ $post->url_clean }}"> 



 <div class="form-group">
    <label for="content">Contenido</label>
    <textarea readonly class="form-control" id="content" rows="3" name="content" >{{ $post->content }}</textarea>
  

  </div>



@endsection