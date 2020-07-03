@extends('dashboard.master')
@section('content')

<a class="btn btn-success btn-block mt-3 mb-3" href="{{route('post.create')}}">Crear
</a>


<table class="table table-border table-hover text-center">
  <thead class="thead-dark">
    <tr >
      <th scope="col">Id</th>
      <th scope="col">Titulo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Posteado</th>
      <th scope="col">Fecha de Creacion</th>
      <th scope="col">Fecha de actualizacion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
   
   @foreach($posts as $post )
     <tr class="font-weight-bold text-center">
      <td scope="col">{{$post -> id}}</td>
      <td scope="col">{{$post -> title}}</td>
      <td scope="col">{{$post -> category -> title}}</td>
      <td scope="col">{{$post -> posted}}</td>
      <td scope="col">{{$post -> created_at->format('Y-M-d')}}</td>
      <td scope="col">{{$post -> updated_at->format('Y-M-d')}}</td>
      <td scope="col"> 
        <a href="{{route('post.show',$post->id)}}" class="btn btn-primary ">Ver</a>
         <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary ">Actualizar</a>
         <a href="{{ route('post-comment.post',$post->id) }}" class="btn btn-primary  mt-3 mb-3"><i class="fa fa-comment"></i>Comentarios</a>
        
        
         <button data-toggle="modal" data-target="#deleteModal" data-id="{{$post ->id}}" class="btn btn-block btn-danger ">Eliminar</button>         
       
        
        </td>
      </td>
    </tr>
   @endforeach
   
  </tbody>
</table>

{{$posts ->links()}}


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="p-2 bg-dark text-white">Seguro que desea eliminar este registro seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
        <form id="fromDelete" method="POST" action="{{route('post.destroy',0)}}" data-action="{{route('post.destroy',0)}}">
                @method('DELETE')
                @csrf 
        <button type="submit" class="btn btn-danger">Borrar</button>
        </form>

       
      </div>
    </div>
  </div>
</div>

<script>

window.onload = function(){
$('#deleteModal').on('show.bs.modal', function (event) {
   
  var button = $(event.relatedTarget) 
  var id = button.data('id') 
 
  action = $('#fromDelete').attr('data-action').slice(0,-1)
action +=id
console.log(action)

 $('#fromDelete').attr('action',action)

  var modal = $(this)
  modal.find('.modal-title').text('Vas a bororrar el POST : ' + id)
})
}
</script>

@endsection

