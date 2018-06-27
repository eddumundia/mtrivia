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
                                <div class="col-lg-1">
                                   @include('layouts.sidesettings')
                                </div>
                                <div class="col-lg-11">
                                  <table id="example" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Assigned subject</th>
                                            <th>Assigned class</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date created</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->subject->subject_name}}</td>
                                            <td>{{$user->section->class}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->active}}</td>
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






