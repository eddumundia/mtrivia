@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="row">
                        @include('layouts.sidemenu')
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="col-lg-4">
                                        <div class="avatar-border shadow-4x m-b" style="width:auto;">
                                              <img class="img-circle" width="128" height="128" src="{{ URL::asset('/images/pp.png')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <h4>{{$user->name}}</h4>
                                        <small>{{$user->email}}</small><hr>
                                        <b>Mobile: </b>{{$user->mobile}}<br>
                                        <b>Date enrolled: </b>{{$user->created_at->diffForHumans()}}<br>
                                        <b>Enrolled as a: </b>{{$user->role->name}}<br>
                                        <b>Current class of entry:</b><button class="btn btn-link" onclick="changeClass({{$user->id}})">{{$user->section->class}}</button>
                                        
                                        <h4>Trivia timeline</h4><hr>
                                        <ul>
                                            <?php foreach ($trivias as $value) {?>
                                                <a href="{{ url('/question/') }}/{{$value->random_id}}/revise">  <li>Scored {{$value->trivia_result}}% on {{$value->subject->subject_name}} subject done  {{ $value->created_at->diffForHumans()}} ,  Ratings:<b> {{ $value->perfomance }}</b></li></a>
                                            <?php }?>
                                        </ul>
                                        <?php if(!empty($pending)){ ?>
                                        <h4> <a href="{{ url('/question/') }}/{{$pending->question_id}}/nextquiz/{{$pending->random_id}}">You have a quiz thats not completed</a></h4>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <b>Subjects</b><hr>
                                    <b>Subscription total:</b><hr>
                                    <b>Subscription expiry date :</b><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection

<style>
.list-group .glyphicon {
    float: right;
}
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






