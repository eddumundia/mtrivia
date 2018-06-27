@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            <div class="row">
                 @include('layouts.sidemenu')
                 <div class="col-lg-10">
                      <?php if(\Auth::user()->role_id == 3 || \Auth::user()->role_id == 5){?>
                    <a href="{{url('/question/create')}}" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
                    <a href="{{url('/question/upload')}}" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a>
                      <?php }?>
                    <table id="questions-table" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Question</th>
                                <th>Created by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                 </div>
                 
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#questions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'subject.subject_name', name: 'subject.subject_name' },
            { data: 'section_id', name: 'questions.section_id' },
            { data: 'question', name: 'questions.question' },
            { data: 'user.name', name: 'user.name' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush


<style>
.list-group .glyphicon {
    float: right;
}
</style>