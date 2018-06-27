@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'subject_id', name: 'subject_id' },
            { data: 'section_id', name: 'section_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script>
@endpush


  <table id="example" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Question</th>
                                <th>Created by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($questions as $question)
                            <tr>
                                <td>{{$question->subject->subj_code}}</td>
                                <td>{{$question->section->class}}</td>
                                <td><a href="question/{{$question->id}}">{{substr($question->question, 0, 50)}}......</a></td>
                                <td>{{$question->created_by}}</td>
                                <td><a href="question/{{$question->id}}/edit" class="btn btn-xs btn-primary">Edit</a> | <a class="btn btn-xs btn-danger">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>