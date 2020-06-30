<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="">


    Grupo Razo
  </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <router-link class="navbar-brand" to="">
        
           @auth
            {{ auth()->user()->name}}
            @endauth
    </router-link>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <router-link to="/" class=" text-white">  
                Inicio

            </router-link>
            </li>
        </ul>


        <ul class="navbar-nav">
            <li class="nav-item">

                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            
            </li>
           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Perfil
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Perfil</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>

    </div>
</nav>