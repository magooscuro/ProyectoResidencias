
 var id=-1;
 $(document).ready(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"http://127.0.0.1:8000/api/subcategorias",
        "dataSrc":"",
        error:function(data){
        alert("No hay conexion");
        }

      },
      "columns":[
          {
            "data":"subCategoria"
          },
          {
              "data":"categorias.categoria"
          }
      ],
      rowId:"id",
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

      var subcategoria = $("#txtsubcategoria").val();
      var categoria = $("#Addcategoria").val();

      var obj ={
          subcategoria:subcategoria,
          categoria_id:categoria
      };

      $.ajax({
        type:"POST",
        data: obj,
        url: 'http://127.0.0.1:8000/api/subcategorias',
        ContentType: "application/json",
        beforeSend:function(){
          $('#Agregar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalAgregar').modal('hide');
          $('#Agregar').html('Agregar Subcategoria');

          $("#txtsubcategoria").val("");
        },
        error:function(data){
        alert("no hay conexion");
        }
      }).fail(function($xhr){
         var  data = $xhr.responseJSON;
      });
    });

    $('table').on('click', '#btnEliminarModal', function(){
      var nombre = table.row($(this).parents('tr')).data().subCategoria;
      id = table.row($(this).parents('tr')).id();
      $('#lblEliminar').html("¿Quiere eliminar la Subcategoria "+nombre+"?");
    });

    $("#btnEliminar").click(function(){

      $.ajax({
        type:"Delete",
        url: 'http://127.0.0.1:8000/api/subcategorias/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('#Eliminar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          console.log(data);
          table.ajax.reload();
          table.draw();

          $('#modalEliminar').modal('hide');
          $('#Eliminar').html('Eliminar Subcategoria');
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

    $("#btnNuevo").click(function () {
        var categorias = $(".Addcategoria select");

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/categorias',
            ContentType: "application/json",
            success:function(data) {
                categorias.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    categorias.append('<option value="' + v.id + '">' + v.categoria + '</option>');
                })
            }
        });
    });

    $('table').on('click', '#btnEditarModal', function(){

      var data = table.row($(this).parents('tr')).data();
      id = table.row($(this).parents('tr')).id();

      var subcategoria = data.subCategoria;
        var categoria_id = data.categoria_id;

      $("#txtEsubcategoria").val(subcategoria);

      var categorias = $(".categoria select");

      $.ajax({
         type:"GET",
          url:'http://127.0.0.1:8000/api/categorias',
          ContentType: "application/json",
          success:function(data) {
             categorias.find('option').remove();
             $(data).each(function(i, v){ // indice, valor
                 if(v.id == categoria_id)
                    categorias.append('<option value="' + v.id + '" selected>' + v.categoria + '</option>');
                 else
                    categorias.append('<option value="' + v.id + '">' + v.categoria + '</option>');
             })
          },
          });

    });


    $('#btnActualizar').click(function(){
      var subcategoria = $("#txtEsubcategoria").val();
      var categoria_id = $("#Scategoria").val();

      console.log(subcategoria);

      var obj ={
          subcategoria:subcategoria,
          categoria_id:categoria_id
      };

      $.ajax({
        type:"PUT",
        data: obj,
        url: 'http://127.0.0.1:8000/api/subcategorias/'+id,
        ContentType: "application/json",
        beforeSend:function(){
          $('#Editar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        },
        success:function(data){
          table.ajax.reload();
          table.draw();

          $('#modalEditar').modal('hide');
          $('#Editar').html('Actualizar Subcategoria');

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
