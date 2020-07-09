 var id=-1;
 $(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"/api/es",
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
          },
          {
              "data":"created_at"
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

     var table2 = $("#tabla2").DataTable({
         "ajax":{
             "url":"/api/esh",
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

 });
