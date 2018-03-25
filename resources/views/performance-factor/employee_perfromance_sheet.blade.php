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
                            <th rowspan="2">Factor</th>
                             <th rowspan="2">Rating <br> for 50</th>
                              <th colspan="3">Q1</th>
                              <th colspan="3">Q2</th>
                              <th colspan="3">Q3</th>
                              <th colspan="3">Q4</th>
                              <th>Total</th>
                            </tr>
                           
                            <tr class="thead-bg">
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


                              @if(count($sheets)>0)
                              @foreach ($sheets as $index => $sheet) 

                              <tr> 
                                <td>{{ $sheet->factor_name }}</td>
                                <td>{{ $sheet->Rating }}</td>
                                <td class="c_info"> @isset($sheet->Q1AVGTARGET){{ $sheet->Q1AVGTARGET }}@endisset</td>
                                <td class="c_success"> @isset($sheet->Q1AVGACHIVED){{ $sheet->Q1AVGACHIVED }}@endisset</td>
                                 <td class="c_success">  @isset($sheet->Q1RATING){{ $sheet->Q1RATING }}@endisset</td>                                
                                 <td class="c_info"> @isset($sheet->Q2AVGTARGET){{ $sheet->Q2AVGTARGET }}@endisset</td>
                                <td class="c_success"> @isset($sheet->Q2AVGACHIVED){{ $sheet->Q2AVGACHIVED }}@endisset</td>
                                 <td class="c_success">  @isset($sheet->Q2RATING){{ $sheet->Q2RATING }}@endisset</td>                                
                                 <td class="c_info"> @isset($sheet->Q3AVGTARGET){{ $sheet->Q3AVGTARGET }}@endisset</td>
                                <td class="c_success"> @isset($sheet->Q3AVGACHIVED){{ $sheet->Q3AVGACHIVED }}@endisset</td>
                                 <td class="c_success">  @isset($sheet->Q3RATING){{ $sheet->Q3RATING }}@endisset</td>                                
                                 <td class="c_info"> @isset($sheet->Q4AVGTARGET){{ $sheet->Q4AVGTARGET }}@endisset</td>
                                <td class="c_success"> @isset($sheet->Q4AVGACHIVED){{ $sheet->Q4AVGACHIVED }}@endisset</td>
                                 <td class="c_success">  @isset($sheet->Q4RATING){{ $sheet->Q4RATING }}@endisset</td>
                                <td>
                                  <div class="input-group ingroup150">
                                    <input disabled type="text" class="form-control form-control-empsheet" value="@isset($sheet->YRLYRATING){{ $sheet->YRLYRATING }}@endisset">
                                    <span class="input-group-addon input-group-addon-sheets ">@isset($sheet->Rating){{ $sheet->Rating }}@endisset</span>
                                  </div>
                                </td> 
                              </tr>
                            @endforeach
                          
                            <input name="raw_total" class="total_bt" type="hidden" value="{{ $sheets[0]->TOTALSCORE}}">
                            <tr>
                              <td>Experience</td>
                              <td colspan="13"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text"  class="form-control form-control-empsheet exp_max_5" value="{{ $sheets[0]->experience }}" name="experience">
                                    <span class="input-group-addon input-group-addon-sheets ">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td>Future prospects</td>
                              <td colspan="13"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" class="form-control form-control-empsheet future_max_5" value="{{ $sheets[0]->future_prospect}}" name="future_prospect">
                                    <span class="input-group-addon input-group-addon-sheets ">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td colspan="14">Performance score </td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" readonly class="form-control form-control-empsheet total_score" value="{{ $sheets[0]->TOTALSCORE}}" name="total">
                                    <span class="input-group-addon input-group-addon-sheets ">50.00</span>
                                  </div></td>
                            </tr>

                            </tbody>
                            @endif
                            @empty($sheet)
                            <tr>
                              <td colspan="15" style="text-align: center; font-weight: bold;"> No Records found </td>
                         
                            </tr>

                            @endempty

                        </table>
                        @if(count($sheets)>0)
                        <div class="form-group">
                        <label class="col-md-2 control-label"></label>.
                       <div class="col-md-8">
                    
                        <textarea maxlength="900" placeholder="Enter Notes here.. " rows="4" cols="100" class="form-control" value="notes" name="notes">{{ $sheets[0]->notes }}</textarea>                          
                      </div>
                      @endif
                  </div>
                       
                    </div>
                      @isset($sheet)
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">History</button>
                    <button class="pull-right btn btn-success" type="submit">Save</button>
                    @endisset

                   

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
              @empty(!$history)
              @foreach ($history as $key => $v)
                <tr>
                <td>{{ $v['experience'] }}</td>
                <td>{{ $v['future_prospect'] }}</td>
                <td>{{ $v['total_score'] }}</td>
                <td>{{ $v['created_by'] }}</td>
                <td>{{ $v['created_at']->format('d/m/Y')}} </td>
              </tr>
              @endforeach
              @endempty
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
@endsection