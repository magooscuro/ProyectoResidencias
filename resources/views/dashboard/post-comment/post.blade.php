@extends('dashboard.master')

@section('content')



@if(count($postComments) > 0)

    <div class="card text-center  mt-3 mb-3">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                Listado de comentarios para {{ $post->title }}
            </h4>
            <div class="card-category">
                Aqui encontrarás todos los comentarios de este post
            </div>
        </div>
        
        <div class="card-body ">
            <table class="table table-border table-hover text-center">
                <thead class="text-primary thead-dark">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Título
                        </th>
                        <th>
                            Aprovado
                        </th>
                        <th>
                            Usuario
                        </th>
                        <th>
                            Creación
                        </th>
                        <th>
                            Actualización
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postComments as $postComment)
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
                                {{-- <a href="{{ route('post-comment.show',$postComment->id) }}"
                                class="btn btn-primary">Ver</a> --}}

                                <button data-toggle="modal" data-target="#showModal" data-id="{{ $postComment->id }}"
                                    class="btn btn-primary"><i class="fa fa-eye"></i>Vista General</button>

                                <button data-id="{{ $postComment->id }}"
                                    class="approved btn btn-{{ $postComment->approved == 1 ? "success": "danger" }}">{{ $postComment->approved == 1 ? "Aprobado": "Rechazado" }}</button>

                                <button data-toggle="modal" data-target="#deleteModal"
                                    data-id="{{ $postComment->id }}" class="btn btn-danger"><i class="fa fa-trash"></i>Borrar Comentario</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-3">
                {{ $postComments->links() }}
            </div>
        </div>
    </div>

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

                    <form id="formDelete" method="POST"
                        action="{{ route('post-comment.destroy',0) }}"
                        data-action="{{ route('post-comment.destroy',0) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <p class="message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>


@else

    <h1>No hay comentarios para el post seleccionado</h1>

@endif

<script>
    document.querySelectorAll(".approved").forEach(button => button.addEventListener("click", function () {
        console.log("Hola mundo: " + button.getAttribute("data-id"))

        var id = button.getAttribute("data-id");

        var formData = new FormData();
        formData.append("_token", '{{ csrf_token() }}');

        //fetch("{{ URL::to("/") }}/dashboard/post-comment/proccess/" + id, {
          //      method: 'POST',
            //    body: formData
            //})
            //.then(response => response.json())
            //.then(aprroved => {

//                if (aprroved == 1) {
  //                  button.classList.remove('btn-danger');
    //                button.classList.add('btn-success');
      //              button.innerHTML = "Aprobado";
        //        } else {
          //          button.classList.remove('btn-success');
            //        button.classList.add('btn-danger');
              //      button.innerHTML = "Rechazado";
              //  }
            //});

         $.ajax({
             method: "POST",
             url: "{{ URL::to("/") }}/dashboard/post-comment/proccess/"+id,
             data:{'_token': '{{ csrf_token() }}'}
         })
         .done(function( aprroved ) {
             if(aprroved == 1){
                 $(button).removeClass('btn-danger');
                 $(button).addClass('btn-success');
                 $(button).text("Aprobado")
             }else{
                 $(button).addClass('btn-danger');
                 $(button).removeClass('btn-success');
                 $(button).text("Rechazado")
             }
         });

    }))



    window.onload = function () {

        $('#showModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var modal = $(this)
             $.ajax({
                 method: "GET",
                 url: "{{ URL::to("/") }}/dashboard/post-comment/j-show/"+id
             })
             .done(function( comment ) {
                 modal.find('.modal-title').html(comment.title)
                 modal.find('.message').html(comment)
             });

           // fetch("{{ URL::to("/") }}/dashboard/post-comment/j-show/" + id)
             //   .then(response => response.json())
               // .then(comment => {
                 //   modal.find('.modal-title').text(comment.title)
                  //  modal.find('.message').text(comment.message)
                //});

        });

        $('#deleteModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            action = $('#formDelete').attr('data-action').slice(0, -1)
            action += id
            console.log(action)

            $('#formDelete').attr('action', action)

            var modal = $(this)
            modal.find('.modal-title').text('Vas a borrar el POST: ' + id)
        });

        $("#filterForm").submit(function () {
            //console.log($(this).val())

            var action = $(this).attr('action');
            action = action.replace(/[0-9]/g, $("#filterPost").val());
            console.log(action)
            $(this).attr('action', action)

        });
    }
</script>

@endsection