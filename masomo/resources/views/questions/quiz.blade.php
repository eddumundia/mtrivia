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
        <div class="panel-heading"><b>{{$question->subject->subject_name}}</b> question for class <b>{{$question->section->class}}</b></div>
        <div class="panel-body">
            <p class="question">{!!ucfirst($question->question)!!}</p>
    
 <div class="row">
            <?php
               $numOfCols = 2;
               $rowCount = 0;
               $bootstrapColWidth = 12 / $numOfCols;
               $i = 0;
               $lettes = ["A", "B", "C", "D"];
               foreach ($question->answers as $value) {?>
             
            <a href="{{ url('/question/') }}/{{$question->id}}/proceed/{{$value->id}}/{{$random_id}}"><b><div class="answerholder col-md-<?php echo $bootstrapColWidth; ?>">
                        <?php echo $lettes[$i];?>: <span class="<?= ($value->correct == 1)?'correct':''?>"><?= ucfirst($value->answer);?> <?= ($value->correct == 1)?"<i class=''></i>":"";?></span>
                   
                    </div></b></a>
               <?php  
                $rowCount++;
           if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
               $i++;
               if($i==4) break; }?>
        </div>
   <hr>

</div>
        </div>
    </div>
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">Question information</div>
        <div class="panel-body">
            <p>
                <h5><b>Category:</b> {{$question->subject->category->cat_name}}</h5>
                <h5><b>Subject:</b> {{$question->subject->subject_name}}</h5>
                <h5><b>Class:</b> {{$question->section->class}}</h5>
                <h5><b>Date created:</b> {{$question->created_at->toFormattedDateString()}}</h5>
                <?php if($question->verified == 1){?>
                   <button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Verified</button>
                <?php }else{?>
                   <a href="{{$question->id}}/verify" class="btn btn-default">Not verified</a> 
                <?php }?>

            </p>
        </div>
    </div>
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
</style>


