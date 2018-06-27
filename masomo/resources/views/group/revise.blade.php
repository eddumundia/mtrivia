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
                            <div class="panel panel-default">
                            <div class="panel-heading"><b>{!!$question->subject->subject_name!!}</b> question for class <b>{{$question->section->class}}</b></div>
                            <div class="panel-body">
                        <p>{!!ucfirst($question->question)!!}</p>
                        <ol type="A">
                            <?php foreach ($question->answers as $value) {?>
                                <?php if(\Auth::user()->role_id == 4 || \Auth::user()->role_id == 5){?>
                                <a href="{{ url('/group/') }}/{{$question->id}}/correct/{{$value->id}}"> <li class="<?= ($value->correct == 1)?'correct bg-success':''?>"><?= $value->answer;?> <?= ($value->correct == 1)?"<i class='fa fa-check' aria-hidden='true'></i>":"";?></li></a>
                                <?php }else{?>
                                  <li class="<?= ($value->correct == 1)?'correct bg-success':''?>"><?= $value->answer;?> <?= ($value->correct == 1)?"<i class='fa fa-check' aria-hidden='true'></i>":"";?></li>
                                <?php }?>
                            <?php }?>
                        </ol>
                        
                       <?= ($trivia->correct == 1) ? "CONGRATULATIONS!!" :"";?> You selected: <b><blink>" {{$name}}"</blink></b>  which was the <?= ($trivia->correct == 1) ? "<span class='text-success'><u>correct answer</u></span>" :"<span class='text-success'><u>wrong answer</u></span>";?>
                       <hr>
                         <p class="lead">
                            <h4><b>Explanation</b></h4>
                            <pre>{!!$question->detail->explanation!!}</pre>
                        </p>
                        <div class="pull-left">
                            <div class="float-right"><a href="{{ url('/group/') }}/{{$question->id}}/prevrevise/{{$random_id}}" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>Prev</a></div>
                        </div>
                        <div class="pull-right">
                            <div class="float-right"><a href="{{ url('/group/') }}/{{$question->id}}/nextrevise/{{$random_id}}" class="btn btn-primary">Next<span class="glyphicon glyphicon-chevron-right"></span></a></div>
                        </div>
                    </div>
                            </div>
                            <div id="disqus_thread"></div>
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
</style>


