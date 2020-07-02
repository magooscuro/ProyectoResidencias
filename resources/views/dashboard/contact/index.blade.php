@extends('dashboard.master')

@section('content')

<table class="table table-border table-hover mt-3 mb-3" Style=" text-align: center;">
  <thead class="thead-dark ">
    <tr >
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Email/th>
      <th scope="col">Fecha de Creacion</th>
      <th scope="col">Fecha de actualizacion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
    <tbody class="font-weight-bold">
        @foreach ($contacts as $contact)
        <tr>
            <td>
                {{ $contact->id }}
            </td>
            <td>
                {{ $contact->name }}
            </td>
            <td>
                {{ $contact->surname }}
            </td>
            <td>
                {{ $contact->email }}
            </td>
            <td>
                {{ $contact->created_at->format('d-m-Y') }}
            </td>
            <td>
                {{ $contact->updated_at->format('d-m-Y') }}
            </td>
            <td>
                <a href="{{ route('contact.show',$contact->id) }}" class="btn btn-primary">Ver</a>
                <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $contact->id }}"
                    class="btn btn-danger">Eliminar Comentario</button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $contacts->links() }}

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

                <form id="formDelete" method="POST" action="{{ route('contact.destroy',0) }}"
                    data-action="{{ route('contact.destroy',0) }}">
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

@endsection