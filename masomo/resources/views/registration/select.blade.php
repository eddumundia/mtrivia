@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-lg-12">
            <div class="row">
                <a href="{!!url('redirect/1');!!}">
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                         <div class="panel-heading"><h4><i class="glyphicon glyphicon-user i-sm text-white"></i> Student sign up</h4></div>
                            <div class="panel-body">
                                <ul>
                                    <li>Access thousands of questions updated daily</li>
                                    <li>Play Mtrivia daily</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    
                                </ul>
                            </div>
                            </div>
                        
                    </div>
                </a>
                <a href="{!!url('redirect/2');!!}">
                   <div class="col-lg-4">
                        <div class="panel panel-success">
                         <div class="panel-heading"><h4> <i class="glyphicon glyphicon-user i-sm text-white"></i> Parent sign up</h4></div>
                            <div class="panel-body">
                                <ul>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                </ul>
                            </div>
                            </div>
                        
                    </div>
                </a>
                <a href="{!!url('redirect/3');!!}">
                    <div class="col-lg-4">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><h4><i class="glyphicon glyphicon-user i-sm text-white"></i> Teacher sign up</h4></div>
                            <div class="panel-body">
                                <ul>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                    <li>Thousands of questions</li>
                                    <li>Thousands of answers</li>
                                </ul>
                            </div>
                            </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection