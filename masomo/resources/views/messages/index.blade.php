@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>
            <div class="panel-body">
                <div class="row">
                    @include('layouts.sidemenu')
                    <div class="col-lg-10">
                        <a href="{{url('/question/create')}}" class="btn btn-default ml-auto">Create</a>
                        <table id="example" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                             <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->sms}}</td>
                                    <td>{{$message->created_by}}</td>
                                    <td><a href="message/{{$message->id}}/edit" class="btn btn-xs btn-primary">Edit</a> | <a class="btn btn-xs btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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