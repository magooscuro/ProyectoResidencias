
 var id=-1;
 $(document).ready(function () {

    var table = $("#tabla").DataTable({
      "ajax":{
        "url":"/api/subcategorias",
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

  });
