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
        
        <h4>Enter {{\Auth::user()->subject->subject_name}} question and answers for primary class {{\Auth::user()->section->class}} </h4><hr>
        
        <form method="POST" action="{{ url('/topic') }}/{{$id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-10">
                    <div class="form-group">
                        <label for="question">Topic:</label>
                       <input type="text" class="form-control" id="firstoption" name="topic" placeholder="Add the topic" required>
                    </div>
            </div>
           
            <div class="col-lg-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>  
        </form>
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

