
 var id=-1;
 $(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"http://127.0.0.1:8000/api/es",
        "dataSrc":"",
        error:function(data){
        alert("No hay conexion");
        }

      },
      "columns":[

          {
              "data": null, render: function (data, type, row) {
                  return data.salida.nombres+" "+data.salida.apellidos

              }

          },
          {
              "data":"producto.producto"
          },
          {
              "data":"cantidad"
          }
      ],
      rowId:"id",

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

      var salida = $("#txtNombre").val();
      var producto = $("#txtProducto").val();
      var cantidad = $("#txtCantidad").val();
      var autoriza = $("#txtautoriza").val();
      var status = '0';


        var stock =0;

        var dataprod=[];
        $.ajax({
            type:"GET",
            async : false,
            url:'http://127.0.0.1:8000/api/productos/'+producto,
            ContentType: "application/json",
            success:function(data) {
                $(data).each(function(i, v){ // indice, valor
                    stock = v.cantidad
                });
                if(data[0].subcategoria.categorias.categoria == "Herramienta")
                    status="1";

                dataprod = data[0];
            }
        });

        dataprod.cantidad=dataprod.cantidad-cantidad;

        var obj ={
            autorizado_id:autoriza,
            producto_id:producto,
            salida_id:salida,
            cantidad:cantidad,
            status:status
        };
        if(stock>0 && stock>=cantidad) {
            $.ajax({
                type: "POST",
                data: obj,
                url: 'http://127.0.0.1:8000/api/es',
                ContentType: "application/json",
                beforeSend: function () {
                    $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                },
                success: function (data) {
                    console.log(data);
                    table.ajax.reload();
                    table.draw();
                    table2.ajax.reload();
                    table2.draw();

                    $('#modalAgregar').modal('hide');
                    $('.ModalLongTitle').html('Agregar Salida');

                    $("#txtPersona").val("");
                    $("#txtProducto").val("");
                },
                error: function (data) {
                    alert("no hay conexion");
                }
            }).fail(function ($xhr) {
                var data = $xhr.responseJSON;
            });

            $.ajax({
                type:"PUT",
                data: dataprod,
                url: 'http://127.0.0.1:8000/api/productos/'+producto,
                ContentType: "application/json"
            }).fail(function($xhr){
                var  data = $xhr.responseJSON;
            });


        }
        else
            alert("Stock no diponible")
    });

     $("#btnNuevo").click(function () {
         var salida = $(".Addempleado select");
         var producto = $(".Addproducto select");

         $.ajax({
             type:"GET",
             url:'http://127.0.0.1:8000/api/empleados',
             ContentType: "application/json",
             success:function(data) {
                 salida.find('option').remove();
                 $(data).each(function(i, v){ // indice, valor
                     salida.append('<option value="' + v.id + '">' + v.nombres+" "+v.apellidos + '</option>');
                 })
             }
         });

         $.ajax({
             type:"GET",
             url:'http://127.0.0.1:8000/api/productos',
             ContentType: "application/json",
             success:function(data) {
                 producto.find('option').remove();
                 $(data).each(function(i, v){ // indice, valor
                     producto.append('<option value="' + v.id + '">' + v.producto + '</option>');
                 })
             }
         });
     });


     var cantidadx
    $('table').on('click', '#btnEditarModal', function(){

      var data = table.row($(this).parents('tr')).data();
      id = table.row($(this).parents('tr')).id();
      var salida =data.salida_id;
      var producto = data.producto_id;
      cantidadx = data.cantidad

        var salidal = $(".Addeempleado select");
        var productol = $(".Addeproducto select");
        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/empleados',
            ContentType: "application/json",
            success:function(data) {
                salidal.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    if(v.id == salida)
                        salidal.append('<option value="' + v.id + '" selected>' + v.nombres+""+v.apellidos + '</option>');
                    else
                        salidal.append('<option value="' + v.id + '">' + v.nombres+" "+v.apellidos + '</option>');
                })
            }
        });

        $.ajax({
            type:"GET",
            url:'http://127.0.0.1:8000/api/productos',
            ContentType: "application/json",
            success:function(data) {
                productol.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    if(v.id == producto)
                    productol.append('<option value="' + v.id + '" selected>' + v.producto + '</option>');
                    else
                    productol.append('<option value="' + v.id + '">' + v.producto + '</option>');
                })
            }
        });

      $("#txteCantidad").val(cantidadx);



    });

    $('#btnActualizar').click(function(){
        var salida = $("#txteNombre").val();
        var producto = $("#txteProducto").val();
        var cantidad = $("#txteCantidad").val();
        var autoriza = $("#txteautoriza").val();
        var status = '0';

        var stock =0;
        $.ajax({
            type:"GET",
            async : false,
            url:'http://127.0.0.1:8000/api/productos/'+producto,
            ContentType: "application/json",
            success:function(data) {
                $(data).each(function(i, v){ // indice, valor
                    stock = v.cantidad
                });
                if(data[0].subcategoria.categorias.categoria == "Herramienta")
                    status="1";
                dataprod = data[0];
            }
        });

        var obj ={
            autorizado_id:autoriza,
            producto_id:producto,
            salida_id:salida,
            cantidad:cantidad,
            status:status
        };

        stock = stock+cantidadx;
        dataprod.cantidad=stock-cantidad;
        if(stock>0 && stock>=cantidad) {
            $.ajax({
                type: "PUT",
                data: obj,
                url: 'http://127.0.0.1:8000/api/es/' + id,
                ContentType: "application/json",
                beforeSend: function () {
                    $('.ModalLongTitle').html('<div class="loading"><img src="../../img/loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                },
                success: function (data) {
                    console.log(data);
                    table.ajax.reload();
                    table.draw();

                    table2.ajax.reload();
                    table2.draw();

                    $('#modalEditar').modal('hide');
                    $('.ModalLongTitle').html('Actualizar salida');

                    $("#txtEUbicacion").val("");

                },
                error: function (data) {
                    alert("no hay conexion");
                }
            }).fail(function ($xhr) {
                var data = $xhr.responseJSON;
            });

            $.ajax({
                type:"PUT",
                data: dataprod,
                url: 'http://127.0.0.1:8000/api/productos/'+producto,
                ContentType: "application/json"
            }).fail(function($xhr){
                var  data = $xhr.responseJSON;
            });
        }
        else
            alert('Cantidad insuficiente')

    });


     var table2 = $("#tabla2").DataTable({
         "ajax":{
             "url":"http://127.0.0.1:8000/api/esh",
             "dataSrc":"",
             error:function(data){
                 alert("No hay conexion");
             }

         },
         "columns":[

             {
                 "data": null, render: function (data, type, row) {
                     return data.salida.nombres+" "+data.salida.apellidos

                 }

             },
             {
                 "data":"producto.producto"
             },
             {
                 "data":"cantidad"
             }
         ],
         rowId:"id",
         "columnDefs":[{
             "targets":3,
             "data":null,
             "defaultContent":"<button type='button' id='btnentrega' class='btn btn-success' title='Entrega' data-toggle='modal' data-target='#modalRegreso'><i class='fas fa-undo'></i></button>"
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



     $('.table2').on('click', '#btnentrega', function(){

         id = table2.row($(this).parents('tr')).id();
         var data = table2.row($(this).parents('tr')).data();
console.log(data);
         $('#lblentrega').html("Recibio de "+data.salida.nombres+" "+data.salida.apellidos+" la herramienta "+data.producto.producto+"\n Cantidad: "+data.cantidad);
     });

     $("#btnentregado").click(function(){
         var data2 =[];
         $.ajax({
             type:"GET",
             async : false,
             url:'http://127.0.0.1:8000/api/es/'+id,
             ContentType: "application/json",
             success:function(data) {
                 data2 = data[0];
             }
         });
         data2.status = "0";
         $.ajax({
             type:"PUT",
             async : false,
             data: data2,
             url: 'http://127.0.0.1:8000/api/es/'+id,
             ContentType: "application/json",
             success:function (data) {
                 table2.ajax.reload();
                 table2.draw();
                 $('#modalRegreso').modal('hide');
                 $('#Eliminar').html('Entrega');

             }
         }).fail(function($xhr){
             var  data = $xhr.responseJSON;
         });

        var data3 =[];
         $.ajax({
             type:"GET",
             async : false,
             url:'http://127.0.0.1:8000/api/productos/'+data2.producto_id,
             ContentType: "application/json",
             success:function(data) {

                 data3 = data[0];
             }
         });

         data3.cantidad = data3.cantidad + data2.cantidad;

         $.ajax({
             type:"PUT",
             async : false,
             data: data3,
             url: 'http://127.0.0.1:8000/api/productos/'+data2.producto_id,
             ContentType: "application/json",
             success:function (data) {

             }
         }).fail(function($xhr){
             var  data = $xhr.responseJSON;
         });



     });


 });
