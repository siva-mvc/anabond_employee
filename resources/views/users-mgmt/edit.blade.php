@extends('users-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update user</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user-management.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       

                        <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <select class="form-control" name="userrole">
                                      <option selected >----</option>
                                   @foreach ($roleslist as $roles)
                                        <option value="{{$roles->Role}}" {{$roles->Role == $user->userrole ? 'selected' : ''}}>{{$roles->Role}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        @if (!str_contains($user->picture,'googleusercontent'))

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label" >Picture</label>
                            <div class="col-md-6">
                                @if (str_contains($user->picture,'googleusercontent'))
                                  <img src="{{$user->picture }}" width="50px" height="50px"/>  
                                @else
                                  <img src="../../{{$user->picture }}" width="50px" height="50px"/>  
                                @endif
                                 
                                <input type="file" id="picture" name="picture" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                            <div class="col-md-1 col-md-offset-1">
                                <a href="{{ url('user-management') }}" class="btn btn-warning">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
