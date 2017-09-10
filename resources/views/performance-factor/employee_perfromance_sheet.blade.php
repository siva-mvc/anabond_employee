@extends('performance-factor.base')
@section('action-content')
<section class="content">
      <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
              @if(Session::has('message'))
          <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
          @endif
              <!-- Ela Code Starts Here-->
            <div class="box-body-inner">
        <div class="box-body-head">
           <h4><strong>Employee Details :</strong></h4>
         <ul class="emp-detail-list row">
              <li class="col-sm-2">
                  Name : <strong>{{ $employee->firstname }} {{ $employee->lastname }}</strong>
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
                        <table class="table table-hover emp-data-table table-bordered">
                          <thead>
                            <tr class="thead-bg">
                            <th>Factor</th>
                              <th colspan="2">Q1</th>
                              <th colspan="2">Q2</th>
                              <th colspan="2">Q2</th>
                              <th colspan="2">Q4</th>
                              <th>Total</th>
                            </tr>
                           
                            <tr class="thead-bg">
                            <th></th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                              <th colspan="1" class="c_info">T</th>
                              <th colspan="1" class="c_success">A</th>
                            </tr>
                          </thead>
                            <tbody>
                            @foreach ($sheets as $key => $value) 
                              <tr> 
                                <td>{{ $key }}</td>
                                <td class="c_info">{{ $value[13]->target }}</td>
                                <td class="c_success">{{ $value[13]->achived }}</td>
                                <td class="c_info">{{ $value[21]->target }}</td>
                                <td class="c_success">{{ $value[21]->achived }}</td>
                                <td class="c_info">{{ $value[30]->target }}</td>
                                <td class="c_success">{{ $value[30]->achived }}</td>
                                <td class="c_info">{{ $value[15]->target }}</td>
                                <td class="c_success">{{ $value[15]->achived }}</td>
                                <td>
                                  <div class="input-group ingroup150">
                                    <input disabled type="text" class="form-control" value="{{ $targets[$key] }}">
                                    <span class="input-group-addon">{{ $value[15]->target }}</span>
                                  </div>
                                </td> 
                              </tr>
                            @endforeach    
                            <input name="raw_total" class="total_bt" type="hidden" value="{{ $sheet['raw_total'] }}">
                            <tr>
                              <td>Experience</td>
                              <td colspan="8"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="number" class="form-control exp_max_5" value="{{ $sheet['experience'] }}" name="experience">
                                    <span class="input-group-addon">5</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td>Future prospects</td>
                              <td colspan="8"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="number" class="form-control future_max_5" value="{{ $sheet['future_prospect'] }}" name="future_prospect">
                                    <span class="input-group-addon">5</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td colspan="9">Performance score out of 50 is </td>
                              <td><div class="input-group ingroup150">
                                    <input type="number" class="form-control total_score" value="{{ $sheet['total_score'] }}" name="total">
                                    <span class="input-group-addon">50</span>
                                  </div></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <button class="pull-right btn btn-success" type="submit">Save</button>
            </form>

            </div>
                
              <!--/Ela Code Starts Here-->
              
          </div>
          <!-- /.box-body -->
        </div>
    </section>
@endsection