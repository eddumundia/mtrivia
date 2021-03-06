@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                          <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Phone number</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('current_class') ? ' has-error' : '' }}">
                            <label for="current_class" class="col-md-4 control-label">Select Class</label>

                            <div class="col-md-6">
                                <select id="current_class" name="currentclass" class="form-control">
                                    <option value="">--Please select--</option>>
                                    <option value="4">Class Four</option>
                                    <option value="5">Class Five</option>
                                    <option value="6">Class Six</option>
                                    <option value="7">Class Seven</option>
                                    <option value="8">Class Eight</option>
                                </select>

                                @if ($errors->has('current_class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="current_class" class="col-md-4 control-label">Roles</label>

                            <div class="col-md-6">
                                <select id="current_class" name="role" class="form-control">
                                    <option value="">--Please select--</option>>
                                    <option value="1">Student</option>
                                    <option value="2">Parent</option>
                                    <option value="4">Teacher</option>
                                </select>

                                @if ($errors->has('current_class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection