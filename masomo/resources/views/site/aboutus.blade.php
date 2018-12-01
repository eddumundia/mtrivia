@extends('layouts.app')

@section('content')
<title>About us, we are dedicated group of teachers and provide questions, answers and explanations for students to revise</title>
<meta name="description" content="" />
   
<div class="container">
    <h2>ABOUT US</h2><hr>
    <p>We offer digital learning platform for students to revise, through randomized questions, joining groups and holding online discussions.</P>
    <p>We are a team of seven teachers, four data clerks, 2 statistician and 2 software developers who came together to offer platform for students to revise and improve their grades.</p>
    <h2>Benefits</h2>
    <ul>
        <li>Access to thousands of questions</li>
        <li>Access answers to questions</li>
        <li>Access your results anywhere</li>
        <li>Parents can monitor progress of their children</li>
        <li>Join groups and attempt questions considered hardest</li>
        <li>Access discussions on each question</li>
    </ul>
    <a  href="{{url('/register')}}" class="btn btn-primary btn-lg btn-block">SIGN UP</a>

</div>

@endsection

