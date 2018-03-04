@extends('system-mgmt.department.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">

  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('department.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row" >
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row" style="background-color:#d9d9d9" >
                <th width="20%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" ">Department Name</th>
                <th width="20%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" ">Department Head</th>
                <th width="20%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" ">Division Head</th>
                <th width="20%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" ">Director</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="">  <a class="btn btn-primary" href="{{ route('department.create') }}">Add Department</a></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($departments as $department)
                <tr role="row" class="odd">
                  <td>{{ $department->name }}</td>
                  <td>{{ $department->head_of_dept }}</td>
                  <td>{{ $department->div_head }}</td>
                  <td>{{ $department->director }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('department.destroy', ['id' => $department->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('department.edit', ['id' => $department->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                        Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
           <!--  <tfoot>
              <tr>
                <th width="20%" rowspan="1" colspan="1">Department Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($departments)}} of {{count($departments)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $departments->links() }}
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