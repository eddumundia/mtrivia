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
                            <div class="col-lg-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Kiswahili group</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($marks['Kiswahili'] as $value) {?>
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?= $value->trivia_result;?>%</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="{{url('/group/join/1')}}">Join Kiswahili group</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="panel panel-warning">
                                    <div class="panel-heading">Mathematics group</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                            </thead>
                                             <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($marks['Mathematics'] as $value) {?>
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?= $value->trivia_result;?>%</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="{{url('/group/join/2')}}">Join Mathematics group</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                 <div class="panel panel-success">
                                    <div class="panel-heading">English group</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($marks['English'] as $value) {?>
                                                <?php $enlishgroup = $value->group_id;?>
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?= $value->trivia_result;?>%</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="{{url('/group/join/3')}}/$enlishgroup">Join English group</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="panel panel-danger">
                                    <div class="panel-heading">Social studies and religion group</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                            </thead>
                                             <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($marks['Social Studies and Religion'] as $value) {?>
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?= $value->trivia_result;?>%</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="{{url('/group/join/4')}}">Join social studies and religion group</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">Science group</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                            </thead>
                                           <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($marks['Science'] as $value) {?>
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?= $value->trivia_result;?>%</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="{{url('/group/join/5')}}">Join Science group</a>
                                    </div>
                                </div>
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
