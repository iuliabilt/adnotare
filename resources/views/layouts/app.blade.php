<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Adnotare</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- Styles -->
        <style>
            html, body {
                background-color:#1a75ff;
                color: #000000;

             }
              /* unvisited link */
            a:link {
                color: white;
            }

            /* visited link */
            a:visited {
                color: white;

            }

            /* mouse over link */
            a:hover {
                color: blue;
            }

            /* selected link */
            a:active {
                color: blue;
            } 
            button {
            background: blue;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            }
            input {
                background:#1a75ff ;
                color:white;
                padding: 11px 16px;
                border-radius: 20px;
                opacity: 0.9;   
            }
                    </style>

               
                <!-- Scripts -->
     <script>
             window.Laravel =Laraveln_encode([
             'csrfToken' => csrf_token(),
              ]) !!};
    </script>

     <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

       
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Acasă
                    </a>

                    @if (!Auth::guest())
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{ route('file.create') }}">Adaugă</a></li>
                            <li><a href="{{ route('file.index') }}">Listă</a></li>
                            <li>
                                <form method="GET" action="" class="form-horizontal custm-form" role="form">
                                    <input type="text" name="q" placeholder="Căutare" style="text-align: center;" >
                                    <button type="submit" class="custm-btn btn-primary">Căutare</button>
                                </form>
                            </li> 
                        </ul>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Conectare</a></li>
                            <li><a href="{{ route('register') }}">Înregistrare</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Deconectare
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
