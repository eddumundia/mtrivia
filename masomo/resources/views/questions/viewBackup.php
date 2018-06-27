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
    <p>{!!ucfirst($question->question)!!}</p>
    <ol>
        <ol type="A">
            <?php foreach ($question->answers as $value) {?>
                <?php if(\Auth::user()->role_id == 4 || \Auth::user()->role_id == 5){?>
                <a href="{{url('/question')}}/{{$question->id}}/correct/{{$value->id}}"> <li class="<?= ($value->correct == 1)?'correct bg-success':''?>"><?= ucfirst($value->answer);?> <?= ($value->correct == 1)?"<i class='fa fa-check' aria-hidden='true'></i>":"";?></li></a>
                <?php }else{?>
                  <li class="<?= ($value->correct == 1)?'correct bg-success':''?>"><?= ucfirst($value->answer);?> <?= ($value->correct == 1)?"<i class='fa fa-check' aria-hidden='true'></i>":"";?></li>
                <?php }?>
            <?php }?>
        </ol>
    </ol>
    
   <hr>
   <?php if(!empty($question->explanation)){ ?>
     <p class="lead">
         <b>Explanation::</b>{!!$question->detail->explanation!!}
    </p>
    <hr>
   <?php }else if(\Auth::user()->role_id == 4){?>
    <div class="card">
        <div class="card-block">
            <form method="post" action="{{url('saveexplanation', [$question->id])}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                           
                      <label for="topic">Topic</label>
                      <select class="form-control m-bot15" name="topic" id="selectTopic" onChange="addTopic($(this).val())" required>
                            <option value="">--Please select--</option>
                           @foreach($topics as $topic)
                           <option value="{{$topic->id}}">{{$topic->topic}}</option>
                           @endForeach 
                           <option value="add" >Add topic</option>
                        </select>
                        
                </div>
                <div class="form-group">
                      <label for="explanation">Explanation</label>
                      <textarea id="technig" class="form-control" name="explanation" placeholder="Provide some explanation to the question" required novalidate></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add explanation</button>
                    <div class="pull-right">
                        <a href="{{url('/question')}}/savenext/{{$question->id}}" class="btn btn-link">Answer later</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

   <?php };?>
    <?php if(\Auth::user()->role_id == 3 || \Auth::user()->role_id == 5 || ( \Auth::user()->role_id == 4 && !empty($question->explanation))){?>
         <div class="card-block">
                <div class="form-group">
                    <div class="pull-left">
                        <a href="{{url('/question')}}/savenextprev/{{$question->id}}" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>Prev</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{url('/question')}}/savenext/{{$question->id}}" class="btn btn-lg btn-primary">Next<span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                </div>
        </div>
    <?php }?>
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
                <h5><b>Created by:</b> {{$question->user->name}}</h5>
                <?php if($question->verified == 1 ){?>
                   <button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Verified</button>
                <?php }else if(\Auth::user()->role_id == 6){?>
                   <a href="{{$question->id}}/verify" class="btn btn-default">Verify</a> 
                <?php }?>

               <a href="{{url('/question')}}/{{$question->id}}/edit" class="btn btn-primary">Edit</a>
               <?php if($question->created_by == \Auth::user()->role_id || \Auth::user()->role_id == 5){?> <a class="btn btn-danger" href="delete/{{$question->id}}">Delete</a><?php };?>
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



<!-- Modal -->
<div class="modal fade" id="addtopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a new topic</h4>
      </div>
        <form method="POST" action="{{ url('/topic') }}/{{$qid}}">
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="question">Topic:</label>
                      <input type="text" class="form-control" id="firstoption" name="topic" placeholder="Add the topic" required>
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


