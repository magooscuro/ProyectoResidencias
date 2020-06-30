

<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  
  <title>Grupo Razo</title>
  
  <link rel="stylesheet" href="{{asset("css/app.css")}}">
  <link rel="icon" href="./favicon.ico">
  

</head>

<body>
 @include('dashboard.partials.nav-header-main')

<div class="container"> 

@include('dashboard.partials.session-flash-status')

  @yield('content')

</div> 
<script src="{{asset("js/app.js")}}"> </script>
</body>
</html>
