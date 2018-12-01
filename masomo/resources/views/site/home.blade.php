@extends('layouts.app')

@section('content')
<title>Online game applications for students to revise</title>
<meta name="description" content="Primary questions are available, there is no need to download question paper, rhater ypu can access the questions online, attempt them and get rated, revise and hold discussions online" />
   
<div id="headerMsg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>MASOMO TRIVIA</h2>
                <p><i>Awesome place to play, learn, revise and have fun</i></p>
                <p  class="textSite">
                    We provide platform for students to revise as they prepare for their exams. 
                </p>
                <p  class="textSite">
                   
                </p>
               <p  class="textSite">
                   Access upto 100000 questions with answers and explanations, weekly competition of the hottest questions with others in a virtual classroom, discuss and share ideas 
               </p>
               <p  class="textSite">
                   Parents/Guardian can monitor their children performace wherever they are, revise together with their children on the questions they did.
               </p>
               <p   class="textSite">
                   We have a dedicated team thats adds questions, answers and explanation on daily basis.
               </p>
              
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg btn-block">Sign up</a>
            </div>
            <div class="col-lg-6">
                <img class="responsiveImage" src="{{ URL::asset('/images/banners/2.png')}}">
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .responsiveImage{
        max-width: 100%; 
        display:block; 
        height: auto;
    }
    .textSite{
        font-size: 23.0pt;
        line-height: 107%;
        font-family: 'Open Sans','sans-serif';
    }
    
    #headerMsg{
        width: 100%;
        height: 765px;
        color: #000000;
       background: rgba(255,255,255,1);
background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 20%, rgba(240,240,240,1) 86%, rgba(237,237,237,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(20%, rgba(255,255,255,1)), color-stop(86%, rgba(240,240,240,1)), color-stop(100%, rgba(237,237,237,1)));
background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 20%, rgba(240,240,240,1) 86%, rgba(237,237,237,1) 100%);
background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 20%, rgba(240,240,240,1) 86%, rgba(237,237,237,1) 100%);
background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 20%, rgba(240,240,240,1) 86%, rgba(237,237,237,1) 100%);
background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 20%, rgba(240,240,240,1) 86%, rgba(237,237,237,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
    }
</style>