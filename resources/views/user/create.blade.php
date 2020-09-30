@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Profile</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/user/{{$user->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_level') ? ' has-error' : '' }}">
                            <label for="user_level" class="col-md-4 control-label">User Role</label>

                            <div class="col-md-6">
                                <select class="form-control" name="user_level" id="user_level" required>
                                    <option value="">Select user role</option>
                                    <option value="Super admin" <?= $user->user_level =="Super admin" ? 'selected' : ''?>>Super admin</option>
                                    <option value="Agent" <?= $user->user_level =="Agent" ? 'selected' : ''?>> Agent </option>
                                    <option value="Team lead" <?= $user->user_level =="Team lead" ? 'selected' : ''?>>Team lead </option>
                                    <option value="Manager" <?= $user->user_level =="Manager" ? 'selected' : ''?>>Manager </option>
                                </select>

                                @if ($errors->has('user_level'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}" id="birthday_div" style="<?= $user->user_level =="Super admin" ? 'display: none;' : ''?> ">
                            <label for="birthday" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control" name="birthday" value="{{$user->birthday}}">

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}" id="department_div"  style="<?= $user->user_level =="Super admin" ? 'display: none;' : ''?> ">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="{{$user->department}}">

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
