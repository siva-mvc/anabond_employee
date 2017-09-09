@extends('performance-factor.base')
@section('action-content')
<section class="content">
      <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
              
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
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" class="form-control mw80"></td>
                   <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" class="form-control mw80"></td>
                   <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td>{{ $u->target }}</td>
                     <td><input type="text" class="form-control mw80"></td>
                     <td class="total-bg">{{ $u->target }}</td>
                     <td class="total-bg"><input type="text" class="form-control mw80"></td>
                 </tr>
                 @endforeach
                @endforeach
                            </tbody>
                        </table>
                    </div>
                
            </div>
                
              <!--/Ela Code Starts Here-->
              
          </div>
          <!-- /.box-body -->
        </div>
    </section>
@endsection