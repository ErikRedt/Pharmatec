<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pharmatec | Farmacia gardenia</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
          margin-top: 4em;
            font-family: 'Lato';
          background-color:lightgray;
        }
      .navbar{
        background: linear-gradient(#00e64d, #006622);
        
      }
      a{
        color:black;
      }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-fixed-top navbar-default">
        <div class="container">
            <div class="navbar-header">
              

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <img style="float:left; margin: 0 1em" src="/public/favicon.ico" width="50" height="50">

                <!-- Branding Image -->
                <a style="color:white; text-shadow: 0px 2px 10px black;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" class="navbar-brand" href="{{ url('/') }}" >
 
                    <i>Pharmatec | Farmacia Gardenia</i>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                  
                  <li class="dropdown"><a onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" style="color:white; text-shadow: 0px 2px 10px black;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> </span>Inventario<span class="caret"></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/medicamento') }}"><i class="fa-btn glyphicon glyphicon-th-list"></i>Manejo de inventario | Medicamentos</a></li>
                    <li><a href="{{ url('/medicamento/presentacion') }}"><i class="fa-btn glyphicon glyphicon-list-alt"></i>Presentación de Medicamentos</a></li>
                    </ul>
                  </li>
                  
                  <li ><a onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" style="color:white; text-shadow: 0px 2px 10px black;" href="{{ url('/compra') }}">Compras</a></li>
                  <li ><a onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" style="color:white; text-shadow: 0px 2px 10px black;" href="{{ url('/venta') }}">Ventas</a></li> 
                  <li ><a onmouseover="this.style.color='black'" onmouseout="this.style.color='white'" style="color:white; text-shadow: 0px 2px 10px black;" href="{{ url('/reportes') }}">Reportes</a></li> 
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a style="color:black; text-shadow: 0px 2px 10px black;" href=" {{ url('/login') }}">Iniciar sesión</a></li>
                        <li><a style="color:black; text-shadow: 0px 2px 10px black;" href=" {{ url('/register') }}">Registarse</a></li>
                    @else
                        <li class="dropdown">
                            <a onmouseover="this.style.color='darkred'" onmouseout="this.style.color='black'" style="color:black; text-shadow: 0px 2px 10px black;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Salir</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
  <div style="padding:2.5em 0">
    
  </div>

    <!-- JavaScripts -->
  <script src="{{asset('JS/jquery-3.2.1.js')}}"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  @stack('scripts')  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

  <div class="navbar navbar-default navbar-fixed-bottom" style="margin-top:2em; bottom:0;">
    <div class="container">
      <p align="center"class="navbar-text">
           <strong style="color:black">© 2018 Farmacia Gardenia Ubicada en Cda. Calos Goodyear #1 San antonio Tomatlan.</strong>
      </p>
      
      <a class="label label-default pull-right">
      Sistema desarrollado por SoftX team | Pharmatec</a>
    </div>
    
    
  </div>

  
</body>
</html>
