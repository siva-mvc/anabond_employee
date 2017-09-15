@extends('performance-factor.base')
@section('action-content')
<section class="content">
      <div class="box">
        @if(Session::has('message'))
          <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
          @endif
          <!-- /.box-header -->
          <div class="box-body">
           <ul class="emp-detail-list row">
             <li>
                <div class="form-group">
                  <label class="col-md-2 control-label">Select Department</label>
                       <div class="col-md-2">
                       <select class="form-control onchenageTrigger"  name="dept_id">
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit', ['dept_id' => '0', 'year'=>2017]) }}"  value="0" @if($dept_id == '0') selected @endif>All Depertment</option>
                        @foreach ($depts as $dept) 
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit', ['dept_id' => $dept->id, 'year'=>$year]) }}"  value="{{ $dept->id }}" @if($dept->id == $dept_id) selected @endif>{{ $dept->name }}</option>

                        @endforeach  
                      </select>
                      </div>
                  </div>
                   <div class="form-group">
                   <label class="col-md-2 control-label">Select Year</label>
                       <div class="col-md-2">
                       <select class="form-control onchenageTrigger"  name="year">
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit', ['dept_id' => $dept_id, 'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit', ['dept_id' => $dept_id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                      </select>
                      </div>
                  </div>
             </li>
          </ul>
          
          <form method="post" action="{{ route('employee_factor.factor_achivement_credit_save', ['dept_id' => $dept_id, 'year' =>$year]) }}">
           {{ csrf_field() }}
          <button class="pull-right btn btn-success" type="submit">submit</button>
           <!-- Ela Code Starts Here-->
            <div class="box-body-inner">
                 <p class="text-right"> <strong>T - TARGET</strong>, <strong>A - ACHIEVED</strong></p>
                    <div class="table-responsive">
                        <table class="table table-hover emp-data-table table-bordered">
                             <thead>
                                  <tr class="thead-bg">
                                        <th style="width:10%;">&nbsp;</th>
                                        <th colspan="2">Apr</th>
                                        <th colspan="2">May</th>
                                        <th colspan="2">Jun</th>
                                        <th class="total-bg" colspan="2">Q1(TOTAL)</th>
                                        <th colspan="2">Jul</th>
                                        <th colspan="2">Aug</th>
                                        <th colspan="2">Sep</th>
                                        <th class="total-bg" colspan="2">Q2(TOTAL)</th>
                                        <th colspan="2">Oct</th>
                                        <th colspan="2">Nov</th>
                                        <th colspan="2">Dec</th>
                                        <th class="total-bg" colspan="2">Q3(TOTAL)</th>
                                        <th colspan="2">Jan</th>
                                        <th colspan="2">Feb</th>
                                        <th colspan="2">Mar</th>
                                        <th class="total-bg" colspan="2">Q4(TOTAL)</th>
                                    </tr>

                                    <tr class="thead-bg">
                                      <th>&nbsp;</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th class="total-bg">T</th>
                                      <th class="total-bg">A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th class="total-bg">T</th>
                                      <th class="total-bg">A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th class="total-bg">T</th>
                                      <th class="total-bg">A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th>T</th>
                                      <th>A</th>
                                      <th class="total-bg">T</th>
                                      <th class="total-bg">A</th>
                                    </tr>
                            </thead>
                            <tbody>
                @foreach ($lists as $list)                    
                <tr>
                     <td class="ftitle" colspan="33">{{ $list['factor']->name }}</td>
                </tr>
                @foreach ($list['user_factor'] as $u)
                <tr>
                     <td>{{ $u->employee_fname }} {{ $u->employee_lname }} </td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1"  data-target="{{ $u->target }}" name="achived[{{$u->id}}][3]" value="{{ $u->achiveds[3] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1" data-target="{{ $u->target }}"  name="achived[{{$u->id}}][4]" value="{{ $u->achiveds[4] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1" data-target="{{ $u->target }}"  name="achived[{{$u->id}}][5]" value="{{ $u->achiveds[5] }}" class="form-control mw80 validate_credit"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q1" name="achived[{{$u->id}}][13]" value="{{ $u->achiveds[13] }}" class="form-control mw80 validate_credit_sum" readonly></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][6]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[6] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][7]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[7] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][8]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[8] }}" class="form-control mw80 validate_credit"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q2"  name="achived[{{$u->id}}][21]" value="{{ $u->achiveds[21] }}" class="form-control mw80 validate_credit_sum" readonly></td>
                   <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][9]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[9] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][10]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[10] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][11]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[11] }}" class="form-control mw80 validate_credit"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][30]" value="{{ $u->achiveds[30] }}" class="form-control mw80 validate_credit_sum" readonly></td>
                   <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][12]"  data-target="{{ $u->target }}"  value="{{ $u->achiveds[12] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][1]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[1] }}" class="form-control mw80 validate_credit"></td>
                     <td class="c_warning">{{ $u->target }}</td>
                     <td class="c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][2]" data-target="{{ $u->target }}"  value="{{ $u->achiveds[2] }}" class="form-control mw80 validate_credit"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][15]" value="{{ $u->achiveds[15] }}" class="form-control mw80 validate_credit_sum" readonly></td>
                 </tr>
                 @endforeach
                @endforeach
       
                    </tbody>
                </table>
            </div>
            </div>
                
              <!--/Ela Code Starts Here-->
              </form>
          </div>
          <!-- /.box-body -->
        </div>
    </section>
@endsection