@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>
            <div class="panel-body">
                    @include('layouts.sidemenu')
                        <div class="row">
                            <div class="col-lg-9 col-sm-9 col-xs-9">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Group rankings</div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive">
                                            <thead>
                                                <th>Pos</th>
                                                <th>Name</th>
                                                <th>KIS</th>
                                                <th>MAT</th>
                                                <th>ENG</th>
                                                <th>SSR</th>
                                                <th>SCIE</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;?>
                                                <?php foreach ($ranks as $value) {?>
                                                
                                                
                                                <tr>
                                                    <td><?= $count;?></td>
                                                    <td><?= $value->user->name;?></td>
                                                    <td><?php if(!empty($value->KIS)){?><a href="{{url('/group/revise')}}/{{$value->group_id}}">{{$value->KIS}} %</a><?php } else {?><a href=join/1>KIS</a><?php }?></td>
                                                    <td><?php if(!empty($value->MAT)){?><a href="{{url('/group/revise')}}/{{$value->group_id}}">{{$value->MAT}} %</a><?php } else {?><a href=join/2>MAT</a><?php }?></td>
                                                    <td><?php if(!empty($value->ENG)){?><a href="{{url('/group/revise')}}/{{$value->group_id}}">{{$value->ENG}} %</a><?php } else {?><a href=join/3>ENG</a><?php }?></td>
                                                    <td><?php if(!empty($value->SSR)){?><a href="{{url('/group/revise')}}/{{$value->group_id}}">{{$value->SSR}} %</a><?php } else {?><a href=join/4>SSR</a><?php }?></td>
                                                    <td><?php if(!empty($value->SCIE)){?><a href="{{url('/group/revise')}}/{{$value->group_id}}">{{$value->SCIE}} %</a><?php } else {?><a href=join/5>SCIE</a><?php }?></td>
                                                    <td><?= $value->group_results;?>/500</td>
                                                </tr>
                                                
                                                <?php $count ++;?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        
                                        <a href="{{url('/group/join/1')}}" class="btn btn-lg btn-primary">Join group</a>
                                       
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
