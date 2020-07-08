 var id=-1;
 $(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"/api/unidades",
        "dataSrc":"",
        error:function(data){
        alert("No hay conexion");
        }

      },
      "columns":[
        {
          "data":"unidad"

        },
      ],
      rowId:"id",
      "columnDefs":[{
        "targets":1,
        "data":null,
        "defaultContent":"<button type='button' id='btnEditarModal' class='btn btn-warning' title='Editar' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"+
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

      var unidad = $("#txtUnidad").val();

      var obj ={
        unidad:unidad,
      };

      $.ajax({
        type:"POST",
        data: obj,
        url: '/api/unidades',
        ContentType: "application/json",
        beforeSend:function(){
          $('#Agregar').html('<div class="loading"><img src="/img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalAgregar').modal('hide');
          $('#Agregar').html('Agregar Unidades');

          $("#txtUnidad").val("");
        },
        error:function(data){
        alert("no hay conexion");
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });
    });

    $('table').on('click', '#btnEliminarModal', function(){
      var nombre = table.row($(this).parents('tr')).data().unidad;
      id = table.row($(this).parents('tr')).id();
      $('#lblEliminar').html("¿Quiere eliminar la unidad "+nombre+"?");
    });

    $("#btnEliminar").click(function(){

      $.ajax({
        type:"Delete",
        url: '/api/unidades/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('#Eliminar').html('<div class="loading"><img src="/img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();
          console.log(id);

          $('#modalEliminar').modal('hide');
          $('#Eliminar').html('Eliminar Unidad');
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

      var unidad = data.unidad;

      $("#txtEUnidad").val(unidad);

    });

    $('#btnActualizar').click(function(){
      var unidad = $("#txtEUnidad").val();

      var obj ={
        unidad:unidad
      };

      $.ajax({
        type:"PUT",
        data: obj,
        url: '/api/unidades/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('#Editar').html('<div class="loading"><img src="/img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalEditar').modal('hide');
          $('#Editar').html('Actualizar Unidad');

          $("#txtEUnidad").val("");

        },
        error:function(data){
        alert("no hay conexion");
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });

    });

  });
