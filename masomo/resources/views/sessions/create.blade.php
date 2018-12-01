@extends('layouts.app')

@section('content')
<div class="container aside-xl">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
    <div class="text-center">
        <div class="avatar-border shadow-4x m-b" style="width:auto;"><img class="img-circle" width="128" height="128" src="{{ URL::asset('/images/school.jpg')}} "></div>
    </div>
    <section class="m-b-lg"> 
        <div class="wrapper text-center"> 
            <header><b>MASOMO TRIVIA</b> </header> 
            <div><i>Play, have fun and learn</i></div> 
        </div> 
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <div class="errorload"></div> 
            <div class="step1"> 
               
                        {{ csrf_field() }}
             
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                    <input id="password" type="text" placeholder="code" class="form-control input-lg tooltips" name="code">
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div> 
                
            </div> 
           <button type="submit" id="user-signin" class="btn btn-lg btn-primary btn-block m-t-md m-b-sm">
               <i class="i i-login"></i> LOG IN
           </button> 
            <div class="text-center"> <a href="{{url('/signup')}}"><span>Sign up</span></a></div>
           <div class="text-center m-t m-b"><a href="{{url('/forgot')}}"><span>Forgot code? Reset Here</span></a></div> 
        </form> 
    </section>
            </div>
    </div>
</div>
@endsection

<style>
    .aside-xl {
    width: 132px;
}
.avatar-border {
    width: auto !important;
    height: auto !important;
    display: inline-block;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    -khtml-border-radius: 50%;
    padding: 4px;
    background: #fff;
}

.shadow-4x {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    background: #fff;
}

.m-b {
    margin-bottom: 15px;
}
.wrapper {
    padding: 15px;
}

</style>