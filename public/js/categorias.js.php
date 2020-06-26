
 var id=-1;
 $(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"http://127.0.0.1:8000/api/categorias",
        "dataSrc":"",
        error:function(data){
        alert("No hay conexion");
        }

      },
      "columns":[
        {
          "data":"categoria"

        },
      ],
      rowId:"id",
      "columnDefs":[{
        "targets":1,
        "data":null,
        "defaultContent":"<button type='button' id='btnDetalleModal' class='btn btn-info' title='Ver'><i class='fas fa-eye'></i></button>"+
        "<button type='button' id='btnEditarModal' class='btn btn-warning' title='Editar' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"+
        "<button type='button' id='btnEliminarModal' class='btn btn-danger' title='Eliminar' data-toggle='modal' data-target='#modalEliminar'><i class='fas fa-trash-alt'></i></button>"
      }],
      responsive: true,
      "language": {
        "lengthMenu": "Se muestran _MENU_ resultados por pagina",
        "zeroRecords": "No existen datos",
        "infoEmpty":      "",
        "info": "Se muestra _PAGE_ de _PAGES_",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "paginate": {
          "first":      "First",
          "last":       "Last",
          "next":       "Siguente",
          "previous":   "Anterior"
        },
      },
    });

    jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

    $('#btnAgregar').click(function(){

      var categoria = $("#txtCategoria").val();

      var obj ={
        categoria:categoria,
      };

      $.ajax({
        type:"POST",
        data: obj,
        url: 'http://127.0.0.1:8000/api/categorias',
        ContentType: "application/json",
        beforeSend:function(){
          $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalAgregar').modal('hide');
          $('.ModalLongTitle').html('Agregar Producto');

          $("#txtCategoria").val("");
        },
        error:function(data){
        alert("no hay conexion");
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });
    });

    $('table').on('click', '#btnEliminarModal', function(){
      var nombre = table.row($(this).parents('tr')).data().categoria;
      id = table.row($(this).parents('tr')).id();
      $('#lblEliminar').html("¿Quiere eliminar la categoria "+nombre+"?");
    });

    $("#btnEliminar").click(function(){

      $.ajax({
        type:"Delete",
        url: 'http://127.0.0.1:8000/api/categorias/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalEliminar').modal('hide');
          $('.ModalLongTitle').html('Eliminar Producto');
        },
        error:function(data){
          if(data.status==401){
            alert("La sesion caduco");
            $(location).attr('href','http://192.168.0.13/FRR/login.php')
          }
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });
    });


    $('table').on('click', '#btnEditarModal', function(){

      var data = table.row($(this).parents('tr')).data();
      id = table.row($(this).parents('tr')).id();

      var categoria = data.categoria;

      $("#txtECategoria").val(categoria);

    });

    $('#btnActualizar').click(function(){
      var categoria = $("#txtECategoria").val();

      var obj ={
        categoria:categoria
      };

      $.ajax({
        type:"PUT",
        data: obj,
        url: 'http://127.0.0.1:8000/api/categorias/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalEditar').modal('hide');
          $('.ModalLongTitle').html('Actualizar Producto');

          $("#txtECategoria").val("");

        },
        error:function(data){
        alert("no hay conexion");
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });

    });

  });
