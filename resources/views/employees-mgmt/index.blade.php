@extends('employees-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-10">
          <h3 class="box-title">List of employees</h3>
        </div>
        <div class="col-sm-1">
          <a class="btn btn-primary" href="{{ route('employee-management.create') }}">Add new employee</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-5"></div>
      </div>
      <form method="POST" action="{{ route('employee-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '', isset($searchingVals) ? $searchingVals['department_name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="3%" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th width="12%"  aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee Name</th>
                <th width="4%"  aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Date of Joining</th>
                <th width="10%"  aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
                <th width="10%"  aria-controls="example2" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending">Designation</th>
                <th width="7%"  aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr role="row" class="odd">
                  <td>
                  @if(trim($employee->picture))
                   <img src="../{{$employee->picture }}" width="50px" height="50px"/>
                  @else  
                   <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}"  width="50px" height="50px">
                  @endif 
                  </td>
                  <td class="sorting_1">{{ $employee->name }}</td>
                  <!-- <td class="hidden-xs">{{ $employee->address }}</td> -->
                  <!-- <td class="hidden-xs">{{ $employee->age }}</td>
                  <td class="hidden-xs">{{ $employee->birthdate }}</td> -->
                  <td class="hidden-xs" align="center">{{ $employee->date_hired }}</td>
                  <td class="hidden-xs">{{ $employee->department_name }}</td>
                  <td class="hidden-xs">{{ $employee->designation_name }}</td>
                  <td align="center">
                    <form class="row" method="POST" action="{{ route('employee-management.destroy', ['id' => $employee->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <a class="btn btn-success btn-margin" title="configure factor" href="{{ route('employee_factor.factors_management', ['employee_id' => $employee->id, 'year' => $year]) }}"><i class="fa fa-cog"></i></a>

                        <a href="{{ route('employee-management.edit', ['id' => $employee->id]) }}" title="Edit" class="btn btn-success btn-margin">
                        <i class="fa fa-pencil"></i>
                        </a>

                        <a href="{{ route('employee_factor.perfromance_sheet', ['employee_id' => $employee->id, 'year'=>2017]) }}" title="perfromance sheet" class="btn btn-success btn-margin">
                        <i class="fa-list-alt"></i>
                        </a>

                        
                         <button class="btn btn-danger btn-margin" title="Delete"  type="submit">
                          <i class="fa fa-trash"></i>
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{count($employees)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $employees->links() }}
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