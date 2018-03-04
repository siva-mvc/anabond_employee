@extends('users-mgmt.base')
@section('action-content')
<!-- Main content -->
<section class="content">
   <div class="box">
      <div class="box-body">
      <div class="col-sm-4">
       <h4> List of users</h4>
      </div>
      <div class="col-sm-8">
            <form method="POST" action="{{ route('user-management.search') }}">
               {{ csrf_field() }}
               @component('layouts.search', ['title' => 'Search'])
               @component('layouts.two-cols-search-row', ['items' => ['email'], 
               'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
               @endcomponent
               @endcomponent
            </form>
         </div>

         <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
               <div class="col-sm-12" >
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                     <thead>
                        <tr role="row" style="background-color:#d9d9d9">
                           <th width="5%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" ></th>
                           
                           <th width="20%" class=" hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Name</th>

                           <th width="25%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>

                           <th width="20%" class=" hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Role</th>
                           <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">
                              <div class="col-sm-4">
                                 <a class="btn btn-primary" href="{{ route('user-management.create') }}">Add new user</a>
                              </div>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($users as $user)
                        <tr role="row" class="odd" >
                           <td > @if (str_contains($user->picture,'googleusercontent'))
                                  <img src="{{$user->picture }}" width="30px" height="30px"/>  
                                @else
                                  <img src="../../{{$user->picture }}" width="30px" height="30px"/>  
                                @endif</td>
                           <td class="hidden-xs">{{ $user->firstname }}</td>
                           <td>{{ $user->email }}</td>
                           <td class="hidden-xs">{{ $user->userrole }}</td>
                           <td>
                              <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                 <input type="hidden" name="_method" value="DELETE">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 @if ($user->username != Auth::user()->username && $user->email != 'admin@rekon.anabond.co.in')
                                 <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                 Update
                                 </a>
                                 @endif
                                 @if ($user->username != Auth::user()->username && $user->email != 'admin@rekon.anabond.co.in')
                                 <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                 Delete
                                 </button>
                                 @endif
                                
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     <!-- <tfoot>
                        <tr>
                          <th width="10%" rowspan="1" colspan="1">User Name</th>
                          <th width="20%" rowspan="1" colspan="1">Email</th>
                          <th class="hidden-xs" width="20%" rowspan="1" colspan="1">First Name</th>
                          <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Last Name</th>
                          <th rowspan="1" colspan="2">Action</th>
                        </tr>
                        </tfoot> -->
                  </table>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-5">
                  <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
               </div>
               <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                     {{ $users->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.box-body -->
   </div>
</section>
<!-- /.content -->
</div>
@endsection