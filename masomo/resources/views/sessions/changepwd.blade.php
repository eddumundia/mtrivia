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
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/reset') }}">
            <div class="errorload"></div> 
            <div class="step1"> 
               
                        {{ csrf_field() }}
             
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                    <input id="text" type="text" placeholder="Enter you phone number" class="form-control input-lg tooltips" name="phonenumber">
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div> 
                
            </div> 
           <button type="submit" id="user-signin" class="btn btn-lg btn-primary btn-block m-t-md m-b-sm">
               <i class="i i-login"></i> Reset
           </button> 
        </form> 
    </section>
            </div>
    </div>
</div>
@endsection

