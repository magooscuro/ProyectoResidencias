
$(function () {

    var table = $("#tabla").DataTable({
        "ajax":{
            "url":"http://127.0.0.1:8000/api/productos",
            "dataSrc":"",
            error:function(data){
                alert("No hay conexion");
            }

        },
        "columns":[
            {
                "data":"producto"

            },
            {
                "data":"almacen_id"

            },
            {
                "data":"subcategoria_id"

            },
            {
                "data":"ubicacion_id"

            },
            {
                "data":"unidad_id"

            },
            {
                "data":"cantidad"

            }
        ],
        rowId:"id",
        "columnDefs":[{
            "targets":6,
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
        var almacen  = Number($("#txtAlmacen").val());
        var subCategoria = Number($("#txtSubCategoria").val());
        var ubicacion = Number($("#txtUbicacion").val());
        var unidad = Number($("#txtUnidad").val());
        var cantidad = Number($("#txtCantidad").val());

        var obj ={
            producto:producto,
            almacen_id:almacen,
            subcategoria_id:subCategoria,
            ubicacion_id:ubicacion,
            unidad_id:unidad,
            cantidad:cantidad
        };

        $.ajax({
            type:"POST",
            data: obj,
            url: 'http://127.0.0.1:8000/api/productos',
            ContentType: "application/json",
            beforeSend:function(){
                $('.Agregar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalAgregar').modal('hide');
                $('#Agregar').html('Agregar producto');

                $("#txtProducto").val("");
                $("#txtAlmacen").val("");
                $("#txtSubCategoria").val("");
                $("#txtUbicacion").val("");
                $("#txtUnidad").val("");
                $("#txtCantidad").val("");
            },
            error:function(data){
                alert("no hay conexion");
            }
        }).fail(function($xhr){
            var  data = $xhr.responseJSON;
        });
    });

    $('table').on('click', '#btnEliminarModal', function(){
        var nombre = table.row($(this).parents('tr')).data().producto;
        id = table.row($(this).parents('tr')).id();
        console.log(id);
        $('#lblEliminar').html("¿Quiere eliminar el producto "+nombre+"?");
    });

    $("#btnEliminar").click(function(){

        $.ajax({
            type:"Delete",
            url: 'http://127.0.0.1:8000/api/productos/'+id,
            ContentType: "application/json",
            beforeSend:function(){
                $('.Eliminar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalEliminar').modal('hide');
                $('#Eliminar').html('Eliminar Producto');
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

        var producto = data.producto;
        var almacen  = data.almacen_id;
        var subCategoria = data.subcategoria_id;
        var ubicacion = data.ubicacion_id;
        var unidad = data.unidad_id;
        var cantidad = data.cantidad;

        $("#txtEProducto").val(producto);
        $("#txtEAlmacen").val(almacen);
        $("#txtESubCategoria").val(subCategoria);
        $("#txtEUbicacion").val(ubicacion);
        $("#txtEUnidad").val(unidad);
        $("#txtECantidad").val(cantidad);

    });

    $('#btnActualizar').click(function(){
        var producto = $("#txtEProducto").val();
        var almacen  = Number($("#txtEAlmacen").val());
        var subCategoria = Number($("#txtESubCategoria").val());
        var ubicacion = Number($("#txtEUbicacion").val());
        var unidad = Number($("#txtEUnidad").val());
        var cantidad = Number($("#txtECantidad").val());

        var obj ={
            producto:producto,
            almacen_id:almacen,
            subcategoria_id:subCategoria,
            ubicacion_id:ubicacion,
            unidad_id:unidad,
            cantidad:cantidad
        };

        $.ajax({
            type:"PUT",
            data: obj,
            url: 'http://127.0.0.1:8000/api/productos/'+id,
            ContentType: "application/json",
            beforeSend:function(){
                $('.Actualizar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalEditar').modal('hide');
                $('#Actualizar').html('Actualizar Producto');

                $("#txtEProducto").val("");
                $("#txtEAlmacen").val("");
                $("#txtESubCategoria").val("");
                $("#txtEUbicacion").val("");
                $("#txtEUnidad").val("");
                $("#txtECantidad").val("");
            },
            error:function(data){
                alert("no hay conexion gg");
            }
        }).fail(function($xhr){
            var  data = $xhr.responseJSON;
        });

    });

});
