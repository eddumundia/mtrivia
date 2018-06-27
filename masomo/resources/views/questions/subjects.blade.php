@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            <div class="row">
                 @include('layouts.sidemenu')
                 <div class="col-lg-10">
                     <h4><i>Showing results of {{$sub_name}} subject</i></h4><hr>
                   <table id="questions-list" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Question</th>
                                <th>Created by</th>
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
    $('#questions-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('datatables/student')}}/{{Input::get('id')}}",
        columns: [
            { data: 'subject.subject_name', name: 'subject.subject_name' },
            { data: 'section_id', name: 'questions.section_id' },
            { data: 'question', name: 'questions.question' },
            { data: 'user.name', name: 'user.name' }
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