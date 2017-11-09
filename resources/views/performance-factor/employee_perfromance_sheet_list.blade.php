@extends('system-mgmt.department.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of departments</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('sheet.pdf', ['dept_id' => $dept_id]) }}">Export PDF</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <div>
      <label class="col-md-2 control-label">Select Department</label>
           <div class="col-md-2">
           <select class="form-control onchenageTrigger"  name="dept_id">
           @if(Auth::user()->email =='admin@rekon.anbond.co.in')
              <option data-url ="{{ route('employee_factor.export_list', ['dept_id' => 0]) }}"  value="0" @if($dept_id == '0') selected @endif>All Depertment</option>
            @endif
            @foreach ($depts as $dept) 

              @if(in_array($dept->id, Session::get('departments')))
                 <option data-url ="{{ route('employee_factor.export_list', ['dept_id' => $dept->id]) }}"  value="{{ $dept->id }}" @if($dept->id == $dept_id) selected @endif>{{ $dept->name }}</option>
              @endif

            @endforeach  
          </select>
          </div>
      </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Employee name</th>
                <th>Employee Id</th>
                <th>Department</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sheets as $sheet)
                <tr role="row" class="odd">
                  <td>{{ $sheet->employee_name }}</td>
                  <td>{{ $sheet->employee_id }}</td>
                  <td>{{ $sheet->department_name }}</td>
                  <td></td>
              </tr>
            @endforeach
            </tbody>
           <!--  <tfoot>
              <tr>
                <th rowspan="1" colspan="1">Department Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot> -->
          </table>
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