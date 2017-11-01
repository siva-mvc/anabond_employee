@extends('performance-factor.base')
@section('action-content')
<section class="content">
      <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
              @if(Session::has('message'))
          <div class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</div>
          @endif
              <!-- Ela Code Starts Here-->
            <div class="box-body-inner">
        <div class="box-body-head">
           <h4><strong>Employee Details :</strong></h4>
         <ul class="emp-detail-list row">
              <li class="col-sm-2">
                  Name : <strong>{{ $employee->name }}</strong>
              </li>
              <li class="col-sm-2">
                  Employee ID : <strong>{{ $employee->employee_reg_id }}</strong>
              </li>
              <li class="col-sm-3">
                  Date of Joining: <strong>{{ $employee->date_hired }}</strong>
              </li>
              <li>
               <div class="form-group">
                  <label class="col-md-2 control-label">Select Year</label>
                       <div class="col-md-2">
                       <select class="form-control onchenageTrigger"  name="year">
                          <option data-url ="{{ route('employee_factor.perfromance_sheet', ['employee_id' => $employee->id, 'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                          <option data-url ="{{ route('employee_factor.perfromance_sheet', ['employee_id' => $employee->id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                      </select>
                      </div>
                  </div>
              </li>
          </ul>
        </div>
          <form action="{{ route('employee_factor.perfromance_sheet_save', ['employee_id' => $employee->id, 'year'=>$year]) }}" method="post">
           {{ csrf_field() }}
                    <div class="table-responsive">
                        <table class="table table-hover emp-data-table emp-data-table-onesheet table-bordered">
                          <thead>
                            <tr class="thead-bg">
                            <th>Factor</th>
                              <th colspan="3">Q1</th>
                              <th colspan="3">Q2</th>
                              <th colspan="3">Q3</th>
                              <th colspan="3">Q4</th>
                              <th>Total</th>
                            </tr>
                           
                            <tr class="thead-bg">
                            <th></th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1">R</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1">R</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1">R</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1">R</th>
                            </tr>
                          </thead>
                            <tbody>
                            @foreach ($sheets as $key => $value) 
                              <tr> 
                                <td>{{ $key }}&nbsp;[{{ $value['actual_target']}}]</td>
                                <td class="c_info"> @isset($value[13]->target){{ $value[13]->target }}@endisset</td>
                                <td class="c_success"> @isset($value[13]->achived) {{ $value[13]->achived }} @endisset</td>
                                 <td class="c_success"> @isset($value[13]->rating) {{ $value[13]->rating }} @endisset</td>
                                <td class="c_info"> @isset($value[21]->target ) {{ $value[21]->target }} @endisset</td>
                                <td class="c_success"> @isset($value[21]->achived) {{ $value[21]->achived }} @endisset</td>
                                <td class="c_success"> @isset($value[21]->rating) {{ $value[21]->rating }} @endisset</td>
                                <td class="c_info"> @isset($value[30]->target ) {{ $value[30]->target }} @endisset</td>
                                <td class="c_success"> @isset($value[30]->achived) {{ $value[30]->achived }} @endisset</td>
                                <td class="c_success"> @isset($value[30]->rating) {{ $value[30]->rating }} @endisset</td>
                                <td class="c_info"> @isset($value[15]->target ) {{ $value[15]->target }} @endisset</td>
                                <td class="c_success"> @isset($value[15]->achived) {{ $value[15]->achived }} @endisset</td>
                                <td class="c_success"> @isset($value[15]->rating) {{ $value[15]->rating }} @endisset</td>
                                <td>
                                  <div class="input-group ingroup150">
                                    <input disabled type="text" class="form-control form-control-empsheet" value="{{ $targets[$key] }}">
                                    <span class="input-group-addon input-group-addon-sheets ">@isset($value['actual_target']) {{ $value['actual_target']}}@endisset</span>
                                  </div>
                                </td> 
                              </tr>
                            @endforeach    
                            <input name="raw_total" class="total_bt" type="hidden" value="{{ $sheet['raw_total'] }}">
                            <tr>
                              <td>Experience</td>
                              <td colspan="12"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" class="form-control form-control-empsheet exp_max_5" value="{{ $sheet['experience'] }}" name="experience">
                                    <span class="input-group-addon input-group-addon-sheets ">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td>Future prospects</td>
                              <td colspan="12"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" class="form-control form-control-empsheet future_max_5" value="{{ $sheet['future_prospect'] }}" name="future_prospect">
                                    <span class="input-group-addon input-group-addon-sheets ">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td colspan="13">Performance score </td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" readonly class="form-control form-control-empsheet total_score" value="{{ $sheet['total_score'] }}" name="total">
                                    <span class="input-group-addon input-group-addon-sheets ">50.00</span>
                                  </div></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">History</button>
                    <button class="pull-right btn btn-success" type="submit">Save</button>

            </form>

            </div>
                
              <!--/Ela Code Starts Here-->
              
          </div>
          <!-- /.box-body -->
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Performance sheet list</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <td>Experience</td>
                <td>Future prospects</td>
                <td>Performance score</td>
                <td>Issued by</td>
                <td>Issued date</td>
              </tr>
              @foreach ($history as $key => $v)
                <tr>
                <td>{{ $v['experience'] }}</td>
                <td>{{ $v['future_prospect'] }}</td>
                <td>{{ $v['total_score'] }}</td>
                <td>{{ $v['created_by'] }}</td>
                <td>{{ $v['created_at']->format('d/m/Y')}} </td>
              </tr>
              @endforeach

            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
@endsection