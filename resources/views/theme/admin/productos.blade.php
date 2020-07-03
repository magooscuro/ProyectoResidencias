<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FRR</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/admin/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">

    <link rel="stylesheet" href="{{asset("assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper"></div>
@include('theme/admin/header')
<!--Fin Header-->
<!--inicio Aside-->
@include('theme/admin/aside')
    <!--fin Aside-->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Productos</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card" >
                        <div class="card-header">
                            <button type="button" class="btn btn-success" title="Agregar" id="btnNuevo" data-toggle="modal" data-target="#modalAgregar"><i class="fas fa-plus-circle"></i></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabla" class="table " cellspacing="0" width="100%">
                                <thead >
                                <tr>
                                    <th>Producto</th>
                                    <th>Almacen</th>
                                    <th>Subcategoria</th>
                                    <th>Ubicacion<br>
                                    Anaquel / Nivel
                                    </th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="col-12 modal-title text-center ModalLongTitle" id="Agregar">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <div class="col">
                                <label>Producto</label>
                                <input type="text" class="form-control" id="txtProducto" placeholder="Producto">
                            </div >
                            <div class=" col AddAlmacen">
                                <label>Almacen</label>
                                <select  class="form-control" id="AddAlmacen"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col AddSubCategoria">
                                <label>SubCategoria</label>
                                <select  class="form-control" id="AddSubCategoria"></select>
                            </div>
                            <div class=" col AddUbicacion">
                                <label>Ubicacion</label>
                                <select  class="form-control" id="AddUbicacion"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col AddUnidad">
                                <label>Unidad</label>
                                <select  class="form-control" id="AddUnidad"></select>
                            </div>
                            <div class="col">
                                <label>Cantidad</label>
                                <input type="number" class="form-control" id="txtCantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Calcelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="col-12 modal-title text-center ModalLongTitle" id="Eliminar">Eliminar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="loading"></div>
                    <form>
                        <div class="form-group row">
                            <div class="col">
                                <label id="lblEliminar">Quiere eliminar el producto?</label>
                            </div >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Calcelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="col-12 modal-title text-center ModalLongTitle" id="Actualizar">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <div class="col">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="txtEProducto" placeholder="Producto">
                            </div >
                            <div class=" col UpAlmacen">
                                <label>Almacen</label>
                                <select  class="form-control" id="UpAlmacen"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col UpSubCategoria">
                                <label>SubCategoria</label>
                                <select  class="form-control" id="UpSubCategoria"></select>
                            </div>
                            <div class=" col UpUbicacion">
                                <label>Ubicacion</label>
                                <select  class="form-control" id="UpUbicacion"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col UpUnidad">
                                <label>Unidad</label>
                                <select  class="form-control" id="UpUnidad"></select>
                            </div>
                            <div class="col">
                                <label>Cantidas</label>
                                <input type="number" class="form-control" id="txtECantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="btnActualizar">Actualizar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Calcelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Inicio footer-->

@include("theme/admin/footer")

<script src="{{asset("js/productos.js.php")}}" ></script>
<script src="{{asset("assets/admin/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>

</body>
</html>
