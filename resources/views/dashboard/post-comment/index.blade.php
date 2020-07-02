@extends('dashboard.master')

@section('content')

@if(count($postComments) > 0) 

<table class="table table-border table-hover mt-3 mb-3" Style=" text-align: center;">
  <thead class="thead-dark ">
    <tr >
      <th scope="col">Id</th>
      <th scope="col">Titulo</th>
      <th scope="col">Aprovado</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha de Creacion</th>
      <th scope="col">Fecha de actualizacion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
    <tbody class="font-weight-bold">
        @foreach ($postComments as $postComment)
        <tr>
            <td>
                {{ $postComment->id }}
            </td>
            <td>
                {{ $postComment->title }}
            </td>
            <td>
                {{ $postComment->approved }}
            </td>
            <td>
                {{ $postComment->user->name }}
            </td>
            <td>
                {{ $postComment->created_at->format('d-m-Y') }}
            </td>
            <td>
                {{ $postComment->updated_at->format('d-m-Y') }}
            </td>
            <td>
                <a href="{{ route('post-comment.show',$postComment->id) }}" class="btn btn-primary">Ver</a>
                <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $postComment->id }}"
                    class="btn btn-danger">Eliminar Comentario</button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $postComments->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Seguro que desea borrar el registro seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" method="POST" action="{{ route('post-comment.destroy',0) }}"
                    data-action="{{ route('post-comment.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>


            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        $('#deleteModal').on('show.bs.modal', function (event) {
                
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        action = $('#formDelete').attr('data-action').slice(0,-1)
        action += id
        console.log(action)

        $('#formDelete').attr('action',action)

        var modal = $(this)
        modal.find('.modal-title').text('Vas a borrar el POST: ' + id)
        });
    };
</script>
@else

    <h1> No hay comentarios para el post seleccionado< /h1>

@endif
@endsection