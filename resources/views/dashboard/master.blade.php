

<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  
  <title>Modulo Admin</title>
  
  <link rel="stylesheet" href="{{asset("css/app.css")}}">
  <link rel="icon" href="{{{ asset('images/GRR.png') }}}">
  

</head>

<body Style="background-color:#EEEEEE"  >
 @include('dashboard.partials.nav-header-main')

<div class="container table"> 

@include('dashboard.partials.session-flash-status')

  @yield('content')

</div> 
<script src="{{asset("js/app.js")}}"> </script>
</body>
</html>
