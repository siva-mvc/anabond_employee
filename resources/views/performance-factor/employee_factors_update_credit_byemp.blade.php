@extends('performance-factor.base')
@section('action-content')
<section class="content">
      <div class="box">

        @if(Session::has('message'))
          <div class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</div>
          @endif
          <!-- /.box-header -->
          <div class="box-body">
           <ul class="emp-detail-list row">
             <li>
                <div>
                  <label class="col-md-2 control-label">Select Department</label>
                       <div class="col-md-2">
                        <select class="form-control onchenageTrigger"  name="dept_id">
                       @if(Auth::user()->email =='admin@rekon.anabond.co.in')
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit_byemp', ['dept_id' => '0', 'year'=>2017]) }}"  value="0" @if($dept_id == '0') selected @endif>All Depertment</option>
                        @endif
                        @foreach ($depts as $dept) 

                          @if(in_array($dept->id, Session::get('departments')))
                             <option data-url ="{{ route('employee_factor.factor_achivement_credit_byemp', ['dept_id' => $dept->id, 'year'=>$year]) }}"  value="{{ $dept->id }}" @if($dept->id == $dept_id) selected @endif>{{ $dept->name }}</option>
                          @endif

                        @endforeach  
                      </select>
                      </div>
                  </div>
                   <div>
                   <label class="col-md-2 control-label">Select Year</label>
                       <div class="col-md-2">
                       <select class="form-control onchenageTrigger"  name="year">
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit_byemp', ['dept_id' => $dept_id, 'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                          <option data-url ="{{ route('employee_factor.factor_achivement_credit_byemp', ['dept_id' => $dept_id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                      </select>
                      </div>
                  </div>
             </li>
          </ul>
          
          <form method="post" action="{{ route('employee_factor.factor_achivement_credit_save_byemp', ['dept_id' => $dept_id, 'year' =>$year]) }}">
           {{ csrf_field() }} &nbsp;
           <!-- Ela Code Starts Here-->
            <button class="pull-right btn btn-success btn-sm" type="update">Save</button>
            <div class="box-body-inner">
                 <p class="text-right"> <strong>T - TARGET</strong>, <strong>A - ACHIEVED</strong></p>
                    <div class="table-responsive">
                        <table class="table table-hover emp-data-table table-bordered">
                            @if (count($lists) >= 1)
                             <thead>
                                  <tr class="thead-bg">
                                        <th style="width:10%;">&nbsp;</th>
                                        <th colspan="2">Apr</th>
                                        <th colspan="2">May</th>
                                        <th colspan="2">Jun</th>
                                        <th style="width:4%" class="total-bg" colspan="2">Q1(Avg.)</th>
                                        <th colspan="2">Jul</th>
                                        <th colspan="2">Aug</th>
                                        <th colspan="2">Sep</th>
                                        <th style="width:4%"  class="total-bg" colspan="2">Q2(Avg.)</th>
                                        <th colspan="2">Oct</th>
                                        <th colspan="2">Nov</th>
                                        <th colspan="2">Dec</th>
                                        <th style="width:4%"  class="total-bg" colspan="2">Q3(Avg.)</th>
                                        <th colspan="2">Jan</th>
                                        <th colspan="2">Feb</th>
                                        <th colspan="2">Mar</th>
                                        <th style="width:4%"  class="total-bg" colspan="2">Q4(Avg.)</th>
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
                     <td align="left" class="tuncate-text" title="{{ $u->factor_name }}">{{ $u->factor_name }} </td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q1_max" name="target[{{$u->id}}][3]" value="@isset($u->targets[3]){{$u->targets[3] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1"  data-maximum="target[{{$u->id}}][3]" name="achived[{{$u->id}}][3]" value="{{ $u->achiveds[3] }}" class="form-control form-control-emptable mw80 validate_credit"></td>


                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q1_max" name="target[{{$u->id}}][4]" value="@isset($u->targets[4]){{$u->targets[4] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1" data-maximum="target[{{$u->id}}][4]"  name="achived[{{$u->id}}][4]" value="{{ $u->achiveds[4] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                      <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q1_max" name="target[{{$u->id}}][5]" value="@isset($u->targets[5]){{$u->targets[5] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q1" data-maximum="target[{{$u->id}}][5]"   name="achived[{{$u->id}}][5]" value="{{ $u->achiveds[5] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                      <td class="total-bg c_width c_warning"><input type="text" data-target-sum="qid_{{ $u->id }}_q1_max" name="target[{{$u->id}}][13]" readonly value="@isset($u->targets[13]){{$u->targets[13] }}@endisset" class="form-control form-control-emptable mw80"></td>

                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q1" name="achived[{{$u->id}}][13]" value="{{ $u->achiveds[13] }}" class="form-control form-control-emptable validate_credit_sum mw80" readonly></td>


                      <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q2_max" name="target[{{$u->id}}][6]" value="@isset($u->targets[6]){{$u->targets[6] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>


                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][6]" data-maximum="target[{{$u->id}}][6]" value="{{ $u->achiveds[6] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q2_max" name="target[{{$u->id}}][7]" value="@isset($u->targets[7]){{$u->targets[7] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][7]" data-maximum="target[{{$u->id}}][7]" value="{{ $u->achiveds[7] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q2_max" name="target[{{$u->id}}][8]" value="@isset($u->targets[8]){{$u->targets[8] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q2" name="achived[{{$u->id}}][8]" data-maximum="target[{{$u->id}}][8]" value="{{ $u->achiveds[8] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="total-bg c_width c_warning"><input type="text" data-target-sum="qid_{{ $u->id }}_q2_max" name="target[{{$u->id}}][21]" readonly value="@isset($u->targets[21]){{$u->targets[21] }}@endisset" class="form-control form-control-emptable mw80"></td>

                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q2"  name="achived[{{$u->id}}][21]" value="{{ $u->achiveds[21] }}" class="form-control form-control-emptable validate_credit_sum mw80" readonly></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q3_max" name="target[{{$u->id}}][9]" value="@isset($u->targets[9]){{$u->targets[9] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][9]" data-maximum="target[{{$u->id}}][9]"  value="{{ $u->achiveds[9] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q3_max" name="target[{{$u->id}}][10]" value="@isset($u->targets[10]){{$u->targets[10] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][10]" data-maximum="target[{{$u->id}}][10]"  value="{{ $u->achiveds[10] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                    <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q3_max" name="target[{{$u->id}}][11]" value="@isset($u->targets[11]){{$u->targets[11] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][11]" data-maximum="target[{{$u->id}}][11]" value="{{ $u->achiveds[11] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="total-bg c_width c_warning"><input type="text" data-target-sum="qid_{{ $u->id }}_q3_max" name="target[{{$u->id}}][30]" readonly value="@isset($u->targets[30]){{$u->targets[30] }}@endisset" class="form-control form-control-emptable mw80"></td>

                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q3" name="achived[{{$u->id}}][30]" value="{{ $u->achiveds[30] }}" class="form-control form-control-emptable validate_credit_sum mw80" readonly></td>

                    <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q4_max" name="target[{{$u->id}}][12]" value="@isset($u->targets[12]){{$u->targets[12] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][12]" data-maximum="target[{{$u->id}}][12]" value="{{ $u->achiveds[12] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q4_max" name="target[{{$u->id}}][1]" value="@isset($u->targets[1]){{$u->targets[1] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][1]" data-maximum="target[{{$u->id}}][1]"  value="{{ $u->achiveds[1] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="c_width c_warning"><input type="text" data-qids="qid_{{ $u->id }}_q4_max" name="target[{{$u->id}}][2]" value="@isset($u->targets[2]){{$u->targets[2] }}@endisset" class="form-control form-control-emptable mw80 validate_target"></td>

                     <td class="c_ac_width c_success"><input type="text" data-qids="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][2]" data-maximum="target[{{$u->id}}][2]" value="{{ $u->achiveds[2] }}" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="total-bg c_width c_warning"><input type="text" data-target-sum="qid_{{ $u->id }}_q4_max" name="target[{{$u->id}}][15]" readonly value="@isset($u->targets[15]){{$u->targets[15] }}@endisset" class="form-control form-control-emptable mw80 validate_credit"></td>

                     <td class="total-bg"><input type="text" data-sum="qid_{{ $u->id }}_q4" name="achived[{{$u->id}}][15]" value="{{ $u->achiveds[15] }}" class="form-control form-control-emptable validate_credit_sum mw80" readonly></td>
                 </tr>
                 @endforeach
                @endforeach

                @else
                  <tr>
                     <td style="text-align: center"colspan="33">No records found</td>
                </tr>
                @endif
       
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