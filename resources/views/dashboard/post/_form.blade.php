





@csrf

<div class="form-group">
    <label for="title">Titulo</label> 
    <input class="form-control" type="text" name="title" id="title" value="{{ old('title',$post -> title) }}"> 
   
    @error('title')
      <small class="text ">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    <label for="url_clean">Url Limpia</label> 
    <input class="form-control" type="text" name="url_clean" id="url_clean" value="{{ old('url_clean',$post -> url_clean ) }}"> 

</div>

<div class="form-group">
    <label for="category_id">Categorias</label> 
    <select class="form-control"  name="category_id" id="category_id">
    
    @foreach($categories as $title => $id)
      <option {{$post->category_id == $id ? 'selected="selected"' : ''}} value="{{$id}}">{{$title}}</option> //validar que despues de editar se quede en pantalla lo editado 
    @endforeach

    </select>

</div>

<div class="form-group">
    <label for="posted">Posteado</label> 
    <select class="form-control"  name="posted" id="posted">
   
   @include('dashboard.partials.option-yes-not',['val' => $post -> posted])

    </select>

</div>

 <div class="form-group">
    <label for="content">Contenido</label>
    <textarea class="form-control" id="content" rows="3" name="content" >{{ old('title',$post -> content) }}</textarea>
  

  </div>
<input type="hidden" id="token" value="{{ csrf_token() }}">
<input type="submit" value="Enviar" class="btn btn-primary mt-3 mb-3 btn-block">


