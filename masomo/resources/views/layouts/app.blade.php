<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('/images/img.ico/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('/images/img.ico/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('/images/img.ico/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('/images/img.ico/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('/images/img.ico/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('/images/img.ico/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('/images/img.ico/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('/images/img.ico/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/img.ico/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ URL::asset('/images/img.ico/img/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/img.ico/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('/images/img.ico/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/img.ico/favicon-16x16.png')}}">
        <link rel="manifest" href="{{ URL::asset('/images/img.ico/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ URL::asset('/images/img.ico/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114351766-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114351766-1');
</script>

        <title>Masomo Trivia</title>
         <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
<!--        <script src="//code.jquery.com/jquery.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<!--        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>-->

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
.list-group .glyphicon {
    float: right;
}
.answerholder {
    border: 1px solid #000000;
    border-radius: 10px;
    padding-right: 5px;
    padding: 10px;
    /* width: 300px !important; */
    margin: 5px 0px;
}
.answerholder:hover {
    background: #d6f5f5;
}
.q/uestion{
    font-size: 50px;
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
                    @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5)
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
                    @endif
                    @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5)
                    <li><a href="{{ url('/question/verification') }}">Verifications</a></li>
                    <li><a href="{{ url('/question/verified') }}">Verified</a></li>
                    @endif
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

        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- App scripts -->
        <script src="{{ URL::asset('src/js/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
@stack('scripts')
    <div id="footer" class="bg-dark">
        <div class="container">
            <div class="pull-left">© <?= date("Y");?> Masomo trivia. All Rights Reserved.</div>
            <div class="pull-right">
                <a href="">Terms</a>   <a href="">Privacy</a>
                <a href="https://www.facebook.com/masomotrivia" target="_blank" class="btn btn-icon btn-rounded btn-primary"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/m_trivia" target="_blank" class="btn btn-icon btn-rounded btn-info"><i class="fa fa-twitter"></i></a>
                <a href="" target="_blank" class="btn btn-icon btn-rounded btn-danger hide"><i class="fa fa-google"></i></a>
            </div>
        </div>
    </div>
    </body>
</html>

<script>
    function addTopic(val){
        if(val =="add"){
            $("#addtopic").modal("show");
        }
    }
    
  function changeClass(id){
        var name = $(".teachername").text();
        $(".teachernamemodal").text("");
        $(".teachernamemodal").text("Change "+name+"'s class");
        $("#changeSubject").modal("show");
    }
    
    function approveSubject(val){
        $("#changescript").attr("onClick", "updateVal("+val+")");
    }
    
        
 var editor_config = {
      path_absolute : "{{ URL::to('/') }}",
      selector : "textarea",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.grtElementByTagName('body')[0].clientHeight;
        var cmsURL = editor_config.path_absolute+'laravel-filemanaget?field_name'+field_name;
        if (type = 'image') {
          cmsURL = cmsURL+'&type=Images';
        } else {
          cmsUrl = cmsURL+'&type=Files';
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizeble : 'yes',
          close_previous : 'no'
        });
      }
    };

    tinymce.init(editor_config);
    
    
        
</script>
<style>
    #footer {
    bottom: 0px;
    color: #707070;
    height: 3em;
    left: 0;
    position: fixed;
    font-size: small;
    width:100%;
}
</style>
<!-- Modal -->
<div class="modal fade" id="changeSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title teachernamemodal" id="myModalLabel"></h4>
      </div>
        <form method="POST" action="{{ url('/users/changeclass') }}">
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="question">Change current class</label>
                      <select id="changeclass" name="section_id" required="" class="form-control">
                          <option value="">--Please select--</option>
                          <option value=4>Four</option>
                          <option value=5>Five</option>
                          <option value=6>Six</option>
                          <option value=7>Seven</option>
                          <option value=8>Eight</option>
                      </select>
                      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
        </form>
    </div>
  </div>
</div>


