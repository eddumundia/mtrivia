@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form method="POST" action="{{ url('/subject') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label for="subject_name">Enter subject</label>
                       <input type="text" class="form-control" id="cat_name" name="subject_name" placeholder="Enter the subject" required>
                    </div>
                    <div class="form-group">
                      <label for="category_id">Select the category</label>
                      <select id="fk_category" name="category_id" class="form-control" required>
                          <option value=''>--Please select--</option>
                          <?php
                            foreach ($categories as $category) {
                                echo "<option value=$category->id>$category->cat_name</option>";
                            }
                          ?>
                      </select>
                       </div>
                <div class="form-group">
                     <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
