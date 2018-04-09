@extends('system-mgmt.department.base')
@section('action-content')
<div class="container">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-default">
            <div class="panel-heading">Edit department</div>
            <div class="panel-body">
               <form class="form-horizontal" role="form" method="POST" action="{{ route('department.update', ['id' => $department->id]) }}">
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                     <label for="name" class="col-md-4 control-label">Department Name</label>
                     <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $department->name }}" required autofocus>
                        @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-4 control-label">Head of the Department</label>
                     <div class="col-md-6">
                        <select class="form-control" name="head_of_dept">
                           <option selected >----</option>
                           @forelse ($user as $users)
                           @if ($users->userrole == 'Department head')
                           <option value="{{$users->email}}" {{$users->email == $department->head_of_dept ? 'selected' : ''}}>{{$users->email}} </option>
                           @endif
                           @empty
                           @endforelse
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-4 control-label">Branch Head</label>
                     <div class="col-md-6">
                        <select class="form-control" name="branch_head">
                           <option selected >----</option>
                           @forelse ($user as $users)
                           @if ($users->userrole == 'Branch Head')
                           <option value="{{$users->email}}" {{$users->email == $department->branch_head ? 'selected' : ''}}>{{$users->email}} </option>
                           @endif
                           @empty
                           @endforelse
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-4 control-label">Division Head</label>
                     <div class="col-md-6">
                        <select class="form-control" name="div_head">
                           <option selected >----</option>
                           @forelse ($user as $users)
                           @if ($users->userrole == 'Division head')
                           <option value="{{$users->email}}" {{$users->email == $department->div_head ? 'selected' : ''}}>{{$users->email}} </option>
                           @endif
                           @empty
                           @endforelse
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-4 control-label">Director</label>
                     <div class="col-md-6">
                        <select class="form-control" name="director">
                           <option selected >----</option>
                           @forelse ($user as $users)
                           @if ($users->userrole == 'Director')
                           <option value="{{$users->email}}" {{$users->email == $department->director ? 'selected' : ''}}>{{$users->email}} </option>
                           @endif
                           @empty
                           @endforelse
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-1 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                        Update
                        </button>
                     </div>
                     <div class="col-md-1 col-md-offset-1">
                        <a href="{{ url('system-management/department') }}" class="btn btn-warning">
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