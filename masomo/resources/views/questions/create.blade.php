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
        
        <form method="POST" action="{{ url('/question') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-10">
                    <div class="form-group">
                        <textarea class="form-control wyswyg" name="question"  placeholder="Type the Question" ></textarea >
                    </div>
            </div>
            <div class="col-lg-10">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="question">First multiple choice</label>
                      A:<input type="text" class="form-control" id="firstoption" name="firstoption" placeholder="First multiple choice" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="question">Second multiple choice B:</label>
                      <input type="text" class="form-control" id="secondoption" name="secondoption" placeholder="Second multiple choice" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="question">Third multiple choice C:</label>
                      <input type="text" class="form-control" id="thirdoption" name="thirdoption" placeholder="Third multiple choice" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                      <label for="question">Fourth multiple choice D:</label>
                      <input type="text" class="form-control" id="fourthoption" name="fourthoption" placeholder="Fourth multiple choice" required>
                    </div>
                </div>
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

