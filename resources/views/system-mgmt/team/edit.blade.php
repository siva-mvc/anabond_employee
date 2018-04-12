@extends('system-mgmt.team.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit team</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('team.update', ['id' => $team->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Team Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $team->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('increment2017') ? ' has-error' : '' }}">
                            <label for="increment2017" class="col-md-4 control-label">2017 increment</label>
                        <div class="col-md-6">
                                <input id="increment2017" type="number" class="form-control" name="increment2017" value="{{ $team->increment2017 }}" >

                                @if ($errors->has('increment2017'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('increment2017') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('increment2018') ? ' has-error' : '' }}">
                            <label for="increment2018" class="col-md-4 control-label">2018 increment</label>
                        <div class="col-md-6">
                                <input id="increment2018" type="number" class="form-control" name="increment2018" value="{{ $team->increment2018 }}" >

                                @if ($errors->has('increment2018'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('increment2018') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                             <div class="col-md-1 col-md-offset-1">
                                <a href="{{ url('system-management/team') }}" class="btn btn-warning">
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
