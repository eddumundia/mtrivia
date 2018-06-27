<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masomo Trivia</title>
         <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    
      <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        #footer {
            position: absolute;
            right: 0;
            bottom: -10px;
            left: 0;
            padding: 2rem;
            background-color: #222733;
            color: #7a87a7;
            text-align: center;
      }
      .navbar{
    box-shadow: 10px 10px 10px grey;
      }
    </style>
        </style>
    </head>
    <body>
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
                    Masomo Trivia
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                    @else
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li  class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Questions<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/question/listsubject/1') }}">Kiswahili</a></li>
                            <li><a href="{{ url('/question/listsubject/3') }}">English</a></li>
                            <li><a href="{{ url('/question/listsubject/2') }}">Mathematics</a></li>
                            <li><a href="{{ url('/question/listsubject/4') }}">Social Studies and Religion</a></li>
                            <li><a href="{{ url('/question/listsubject/5') }}">Science</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/question/verification') }}">Verifications</a></li>
                     <li  class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/subject') }}">Subjects</a></li>
                            <li><a href="{{ url('/category') }}">Categories</a></li>
                            <li><a href="{{ url('/users') }}">Users</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/signup') }}">Sign up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/users/profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
        

@if(Session::has('success'))
    <div class="alert alert-success"><em> {!! session('success') !!}</em></div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger"><em> {!! session('danger') !!}</em></div>
@endif
            @yield('content')
    <div id="footer" class="bg-dark hide">
        <div class="container">
            <div class="pull-left">© <?= date("Y");?> Masomo trivia. All Rights Reserved.</div>
            <div class="pull-right">
                <a href="">Terms</a>   <a href="">Privacy</a>
                <a href="https://www.facebook.com/masomotrivia" target="_blank" class="btn btn-icon btn-rounded btn-primary"><i class="fa fa-facebook"></i></a>
                <a href="" target="_blank" class="btn btn-icon btn-rounded btn-info"><i class="fa fa-twitter"></i></a>
                <a href="" target="_blank" class="btn btn-icon btn-rounded btn-danger"><i class="fa fa-google"></i></a>
            </div>
        </div>
    </div>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- App scripts -->
        
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

        @stack('scripts')
    </body>
</html>

<script>
    $(document).ready(function() {
            $('#technigW').summernote({
              height:180,
              minHeight: null,             
              maxHeight: null,            
              focus: true,
            });
        });
        
        $('#technig').summernote({
             height:180,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ["insert", ["link", "picture", "video"]],
        ["table", ["table"]]
      ]
  });
</script>