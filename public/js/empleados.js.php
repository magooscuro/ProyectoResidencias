$(function () {
    var table = $("#tabla").DataTable({
        "ajax":{
            "url":"http://127.0.0.1:8000/api/empleados",
            "dataSrc":"",
            error:function(data){
                alert("No hay conexion");
            }

        },
        "columns":[

            {
                "data": null, render: function (data, type, row) {
                    return data.nombres+" "+data.apellidos

                }

            },
            {
                "data":"puesto"

            },
            {
                "data":"telefono"

            }
        ],
        rowId:"id",
        "columnDefs":[{
            "targets":3,
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
            }
        }
    });


    jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');



    $('#btnAgregar').click(function(){

        var nombre = $("#txtNombre").val();
        var apellido = $("#txtApellidos").val();
        var puesto = $("#txtPuesto").val();
        var telefono = $("#txtTelefono").val();


        var obj ={
            nombres:nombre,
            apellidos:apellido,
            puesto:puesto,
            telefono:telefono
        };

        $.ajax({
            type:"POST",
            data: obj,
            url: 'http://127.0.0.1:8000/api/empleados',
            ContentType: "application/json",
            beforeSend:function(){
                $('.Agregar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalAgregar').modal('hide');
                $('#Agregar').html('Agregar Empleado');

                $("#txtNombre").val("");
                $("#txtApellidos").val("");
                $("#txtPuesto").val("");
                $("#txtTelefono").val("");
            },
            error:function(data){
                alert("Error");
            }
        }).fail(function($xhr){
            var  data = $xhr.responseJSON;
        });
    });

    $('table').on('click', '#btnEliminarModal', function(){
        var nombre = table.row($(this).parents('tr')).data().nombres +" "+table.row($(this).parents('tr')).data().apellidos;
        id = table.row($(this).parents('tr')).id();
        console.log(id);
        $('#lblEliminar').html("¿Quiere eliminar el empleado "+nombre+"?");
    });

    $("#btnEliminar").click(function(){

        $.ajax({
            type:"Delete",
            url: 'http://127.0.0.1:8000/api/empleados/'+id,
            ContentType: "application/json",
            beforeSend:function(){
                $('.Eliminar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalEliminar').modal('hide');
                $('#Eliminar').html('Eliminar Empleados');
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

        var nombre = data.nombres;
        var apellido = data.apellidos;
        var puesto = data.puesto;
        var telefono = data.telefono;


        $("#txteNombre").val(nombre);
        $("#txteApellidos").val(apellido);
        $("#txtePuesto").val(puesto);
        $("#txteTelefono").val(telefono);


    });

    $('#btnActualizar').click(function(){
        var nombre = $("#txteNombre").val();
        var apellido = $("#txteApellidos").val();
        var puesto = $("#txtePuesto").val();
        var telefono = $("#txteTelefono").val();

        var obj ={
            nombres:nombre,
            apellidos:apellido,
            puesto:puesto,
            telefono:telefono
        };
console.log(obj);
        $.ajax({
            type:"PUT",
            data: obj,
            url: 'http://127.0.0.1:8000/api/empleados/'+id,
            ContentType: "application/json",
            beforeSend:function(){
                $('.Actualizar').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            },
            success:function(data){
                console.log(data);
                table.ajax.reload();
                table.draw();

                $('#modalEditar').modal('hide');
                $('#Actualizar').html('Actualizar Empleado');

            },
            error:function(data){
                alert("Error");
            }
        }).fail(function($xhr){
            var  data = $xhr.responseJSON;
        });

    });

});
