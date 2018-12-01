@extends('layouts.app')

@section('content')
<title>How it works, we are dedicated group of teachers and provide questions, answers and explanations for students to revise</title>
<meta name="description" content="" />
<div class="container">
    <h2>HOW IT WORKS</h2><hr>
    <div class="row">
        <div class="col-lg-4">
            <h2>For students</h2><hr>
            <ol>
                <li>Sign up to access the system</li>
                <li>Provide user details</li>
                <li>Select student as a role</li>
                <li>The system will send a code to the registered mobile number</li>
                <li>Use the code to login</li>
                <li>Randomize questions and answer them</li>
                <li>Join active groups to compete</li>
                <li>Revise on questions attempted</li>
                <li>Have discussions on each question</li>
            </ol>
        </div>
        <div class="col-lg-4">
            <h2>For parents</h2><hr>
             <ol>
                <li>Sign up to access the system</li>
                <li>Provide user details</li>
                <li>Select parent as a role</li>
                <li>The system will send a code to the registered mobile number</li>
                <li>Use the code to login</li>
                <li>Add children and you will receive their code</li>
                <li>Monitor children progress on attempted questions anytime anywhere</li>
                <li>Revise with the children</li>
            </ol>
        </div>
        <div class="col-lg-4">
            <h2>For teachers</h2><hr>
             <ol>
                <li>Sign up to access the system</li>
                <li>Provide user details</li>
                <li>Select parent as a role</li>
                <li>The system will send a code to the registered mobile number</li>
                <li>Use the code to login</li>
                <li>Our team will have to vet the teacher for them to;
                    <ol>
                        <li>Answers questions</li>
                        <li>Provide an explanation</li>
                        <li>Address reported questions with issues</li>
                        <li>Get paid for the number of questions attempted</li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>
     <a href="{{ url('/register') }}" class="btn btn-primary btn-lg btn-block">Sign up</a>
     
     <a href="{{ url('/login') }}" class="btn btn-default btn-lg btn-block">Login</a>
</div>


@endsection
