@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
@endsection
