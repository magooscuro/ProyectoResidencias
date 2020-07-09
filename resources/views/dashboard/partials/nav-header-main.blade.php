<link rel="stylesheet" href="{{asset("css/app.css")}}">


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}">Grupo Razo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  <router-link class="navbar-brand" to="">             @auth             {{ auth()->user()->name}}             @endauth     </router-link>      
<li class="nav-item">
                <a href="{{ route('contact.index')}}" class="nav-link">Contacto</a>
            </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          CRUD
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
     <a class="dropdown-item" dropdown-item href="{{route('post.index')}}">Post</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('user.index')}}">Usuarios</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('category.index')}}">Categorias</a>
        </div>
         
        </div>
      </li>
     
    </ul>

       <ul class="navbar-nav ">
       
            <a class="nav-link" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                   
                 

      </li>
      <ul class="navbar-nav mr-auto">
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Perfil
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
     <a class="dropdown-item" href="<a class="dropdown-item" href="">Perfil</a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     
    </ul>

      </li>
  </div>
</nav>

