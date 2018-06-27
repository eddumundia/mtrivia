@extends('layouts.app')

@section('content')



<div class="row">
    <div class="page-header">
        <h2>Welcome to analytics</h2>
    </div>

</div>
<div id="chart-div"></div>
      {!! $lava->render('DonutChart', 'IMDB', 'chart-div') !!}



@endsection