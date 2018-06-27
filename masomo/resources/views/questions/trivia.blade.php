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
                            <h4>Select the subject</h4><hr>
                             <form action="{{ url('/question/randomize') }}" method="post">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <select class="form-control" name="subject">
                                     <option value="">--Please select--</option>
                                     <option value="1">Kiswahili</option>
                                     <option value="2">Mathematics</option>
                                     <option value="3">English</option>
                                     <option value="4">Social Studies and Religion</option>
                                     <option value="5">Science</option>
                                 </select><br>
                                      
                                      
                                 
                                <input type="submit" class="btn btn-primary" value="Randomize" name="submit">
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

