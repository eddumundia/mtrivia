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

                                  <h4>Upload the excel with questions </h4><hr>

                         <form action="{{ url('/question/uploadexcel') }}" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="questions" id="fileToUpload">
                            <input type="submit" class="btn btn-primary" value="Upload Excel" name="submit">
                        </form>
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

