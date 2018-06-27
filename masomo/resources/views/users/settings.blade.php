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
                                <div class="col-lg-1 col-md-4">
                                   @include('layouts.sidesettings')
                                </div>
                                <div class="col-lg-11">
                                     <a href="{{url('/subject/create')}}" class="btn btn-default">Create</a>
                                    <table id="example" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Category name</th>
                                                <th>Subject name</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subjects as $subject)
                                            <tr>
                                                <td>{{$subject->category->cat_name}}</td>
                                                <td>{{$subject->subject_name}}</td>
                                                <td>{{$subject->created_at}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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


