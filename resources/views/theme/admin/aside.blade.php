<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{{ asset('images/GRR.png') }}}" alt="AdminLTE Logo" class="brand-image"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Grupo Razo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("assets/admin/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} {{auth()->user()->surname}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview ">
                    <a href="{{ action('AdminController\productosController@index') }}" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ action('AdminController\categoriasController@index') }}" class="nav-link">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>
                            Categorias
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ action('AdminController\almacenesController@index') }}" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Almacenes
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ action('AdminController\ubicacionesController@index') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-pin"></i>
                        <p>
                            Ubicaciones
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ action('AdminController\unidadesController@index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ruler-combined"></i>
                        <p>
                            Unidades
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="http://192.168.0.13/FRR/admin/es" class="nav-link">
                        <i class="nav-icon fas fa-arrows-alt-h"></i>
                        <p>
                            Salidas
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>
