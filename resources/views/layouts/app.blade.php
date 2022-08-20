<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Appointment</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- for datepicker  -->
     <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{asset('template/dist/css/theme.min.css')}}"> -->
    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Booking
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(auth()->check() && auth()->user()->role->name === 'patient')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my.booking') }}">{{ __('Appointments') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my.prescription') }}">{{ __('My Prescriptions') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('user-profile')}}">{{ __('My Profile') }}</a>
                            </li>   
                        @endif


                        @if (auth()->check() && auth()->user()->role->name === 'patient')
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                            </a>
                        </li>
                        @endif

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if(auth()->check() && auth()->user()->role->name === 'patient')

                                        <a href="{{url('user-profile')}}" class="dropdown-item">Profile </a>
                                        
                                    @else

                                        <a href="{{url('dashboard')}}" class="dropdown-item">
                                        Dashboard </a>

                                    @endif
                                   
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
<script>
        var dateToday= new Date();
  $( function() {
    $("#datepicker").datepicker({
        dateFormat:"mm-dd-yy", 
        showButtonPanel:true,
        numberOfMonths:2,
        minDate:dateToday,
    });
   
  });
  
</script>

<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

<style type="text/css">

    body{
        background: #fff;
    }

    .ui-corner-all{
        background: orange;
        color:#fff;

    }
    label.btn{
        padding:0;
    }
    label.btn input{
        opacity:0;
        position:absolute;
    }
    label.btn span{
        text-align:center;
        padding:6px  12px;
        display:block;
        min-width:80px;
    }
    label.btn input:checked+span{
        background-color:rgb(80,110,228);
        color:#fff;
    }
</style>

</body>

</html>
