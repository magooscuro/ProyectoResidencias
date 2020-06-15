@extends('dashboard.master')
@section('content')



<div class="form-group">
    <label for="title">Titulo</label> 
    <input readonly class="form-control" type="text" name="title" id="title" value="{{ $category->title }}"> 
   


<div class="form-group">
    <label for="url_clean">Url Limpia</label> 
    <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{ $category->url_clean }}"> 


  

  </div>



@endsection