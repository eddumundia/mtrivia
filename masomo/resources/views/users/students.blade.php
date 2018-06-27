@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
            <div class="row">
                 @include('layouts.sidemenu')
                 <div class="col-lg-10">
                    <table id="students-table" class="display table table-condensed table-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Class</th>
                            <th>email</th>
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
    $('#students-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.studentlist') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'section_id', name: 'section_id' },
            { data: 'email', name: 'email' }
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