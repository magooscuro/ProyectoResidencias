 '<?php session_start(); ?>'

 $(document).ready(function(){
    $("#modalAgregar").on('shown.bs.modal', function(){
        $(this).find('#txtUbicacion').focus();
    });
});
 var token = '<?php echo $_SESSION["token"]; ?>';
 var id=-1;
 $(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"http://192.168.0.13/ApiRest/public/index.php/api/es",
        "dataSrc":"",
        "headers": 
        {
          "Authorization": "Bearer "+ token
        },
        error:function(data){
        alert("No hay conexion");
        }

      },
      "columns":[
        {
          "data":"producto_id"

        },
        {
          "data":"salida_id"

        },
      ],
      rowId:"id_es",
      "columnDefs":[{
        "targets":2,
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

      var producto = $("#txtProducto").val();
      var persona = $("#txtPersona").val();

      var obj ={
        producto_id:producto,
        salida_id:persona,
      };
       
      $.ajax({
        type:"POST",
        data: obj,
        url: 'http://192.168.0.13/ApiRest/public/index.php/api/es',
        "headers": 
        {
          "Authorization": "Bearer "+ token
        },
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

          $("#txtPersona").val("");
          $("#txtProducto").val("");
        },
        error:function(data){
        alert("no hay conexion");  
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });
    });

    $('table').on('click', '#btnEliminarModal', function(){

      id = table.row($(this).parents('tr')).id();
      $('#lblEliminar').html("¿Quiere eliminar?"); 
    });

    $("#btnEliminar").click(function(){

      $.ajax({
        type:"Delete",
        url: 'http://192.168.0.13/ApiRest/public/index.php/api/es/'+id,
        "headers": 
        {
          "Authorization": "Bearer "+ token
        },
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

      var producto = data.producto_id;
      var persona = data.salida_id;

      $("#txtEProducto").val(producto);
      $("#txtEPersona").val(persona);

    });

    $('#btnActualizar').click(function(){
      var producto = $("#txtEProducto").val();
      var persona = $("#txtEPersona").val();

      var obj ={
        producto_id:producto,
        salida_id:persona,
      };
       
      $.ajax({
        type:"PUT",
        data: obj,
        url: 'http://192.168.0.13/ApiRest/public/index.php/api/es/'+id,
        ContentType: "application/json",
        "headers": 
        {
          "Authorization": "Bearer "+ token
        },
        beforeSend:function(){            
          $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalEditar').modal('hide');
          $('.ModalLongTitle').html('Actualizar Producto');

          $("#txtEUbicacion").val("");

        },
        error:function(data){
        alert("no hay conexion");  
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });

    });

  });