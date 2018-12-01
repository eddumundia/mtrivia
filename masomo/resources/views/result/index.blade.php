@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            <div class="row">
                 @include('layouts.sidemenu')
                 <div class="col-lg-10"> 
                    <table id="results-table" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Results</th>
                                <th>Performance</th>
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
    $("#results-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.results') !!}',
        columns: [
            { data: 'subject.subject_name', name: 'subject.subject_name' },
            { data: 'section_id', name: 'section_id' },
            { data: 'trivia_result', name: 'trivia_result' },
            { data: 'perfomance', name: 'perfomance' }
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