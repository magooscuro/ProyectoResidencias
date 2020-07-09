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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubicaciones</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card" >
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla" class="table " cellspacing="0" width="100%">
                            <thead >
                            <tr>
                                <th>Anaquel</th>
                                <th>Nivel</th>
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
@include("theme/admin/footer")

<script src="{{asset("js/user/ubicaciones.js.php")}}" ></script>
<script src="{{asset("assets/admin/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{asset("assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>

</body>
</html>
