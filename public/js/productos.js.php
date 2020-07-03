
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
                "data":"almacenes.almacen"

            },
            {
                "data":"subcategoria.subCategoria"

            },
            {
                "data": null, render: function (data, type, row) {
                    return data.ubicacion.anaquel+"/"+data.ubicacion.nivel

                }

            },
            {
                "data":"unidad.unidad"

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
        var almacen  = Number($("#AddAlmacen").val());
        var subCategoria = Number($("#AddSubCategoria").val());
        var ubicacion = Number($("#AddUbicacion").val());
        var unidad = Number($("#AddUnidad").val());
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

    $("#btnNuevo").click(function () {
        var almacen = $(".AddAlmacen select");
        var subcategoria = $(".AddSubCategoria select");
        var ubicacion = $(".AddUbicacion select");
        var unidad = $(".AddUnidad select");

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/almacenes',
            ContentType: "application/json",
            success:function(data) {
                almacen.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    almacen.append('<option value="' + v.id + '">' + v.almacen + '</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/subcategorias',
            ContentType: "application/json",
            success:function(data) {
                subcategoria.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    subcategoria.append('<option value="' + v.id + '">' + v.subCategoria + '</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/ubicaciones',
            ContentType: "application/json",
            success:function(data) {
                ubicacion.find('option').remove();
                $(data).each(function(i, v){
                    ubicacion.append('<option value="' + v.id + '">' + v.anaquel + '/' +v.nivel +'</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/unidades',
            ContentType: "application/json",
            success:function(data) {
                unidad.find('option').remove();
                $(data).each(function(i, v){
                    unidad.append('<option value="' + v.id + '">' + v.unidad + '</option>');
                })
            }
        });
    });


    $('table').on('click', '#btnEditarModal', function(){

        var data = table.row($(this).parents('tr')).data();
        id = table.row($(this).parents('tr')).id();

        var producto = data.producto;
        var almacen_id  = data.almacen_id;
        var subCategoria_id = data.subcategoria_id;
        var ubicacion_id = data.ubicacion_id;
        var unidad_id = data.unidad_id;
        var cantidad = data.cantidad;

        var almacen = $(".UpAlmacen select");
        var subcategoria = $(".UpSubCategoria select");
        var ubicacion = $(".UpUbicacion select");
        var unidad = $(".UpUnidad select");

        $("#txtEProducto").val(producto);

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/almacenes',
            ContentType: "application/json",
            success:function(data) {
                almacen.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    if(v.id == almacen_id)
                        almacen.append('<option value="' + v.id + '" selected>' + v.almacen + '</option>');
                    else
                        almacen.append('<option value="' + v.id + '">' + v.almacen + '</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/subcategorias',
            ContentType: "application/json",
            success:function(data) {
                subcategoria.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    if(v.id == subCategoria_id)
                        subcategoria.append('<option value="' + v.id + '" selected>' + v.subCategoria + '</option>');
                    else
                        subcategoria.append('<option value="' + v.id + '">' + v.subCategoria + '</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/ubicaciones',
            ContentType: "application/json",
            success:function(data) {
                ubicacion.find('option').remove();
                $(data).each(function(i, v){
                    if(v.id == ubicacion_id)
                        ubicacion.append('<option value="' + v.id + '"selected>' + v.anaquel + '/' +v.nivel +'</option>');
                    else
                        ubicacion.append('<option value="' + v.id + '">' + v.anaquel + '/' +v.nivel +'</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/unidades',
            ContentType: "application/json",
            success:function(data) {
                unidad.find('option').remove();
                $(data).each(function(i, v){
                    if(v.id == unidad_id)
                    unidad.append('<option value="' + v.id + '"selected>' + v.unidad + '</option>');
                    else
                    unidad.append('<option value="' + v.id + '">' + v.unidad + '</option>');
                })
            }
        });

        $("#txtECantidad").val(cantidad);

    });

    $('#btnActualizar').click(function(){
        var producto = $("#txtEProducto").val();
        var almacen  = Number($("#UpAlmacen").val());
        var subCategoria = Number($("#UpSubCategoria").val());
        var ubicacion = Number($("#UpUbicacion").val());
        var unidad = Number($("#UpUnidad").val());
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
