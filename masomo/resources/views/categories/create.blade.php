@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form method="POST" action="{{ url('/category') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label for="cat_name">Enter category</label>
                       <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Enter the category" required>
                    </div>
                <div class="form-group">
                     <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
