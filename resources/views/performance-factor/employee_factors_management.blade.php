@extends('performance-factor.base')
@section('action-content')
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Ela Code Starts Here-->
            <div class="box-body-inner">
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</div>
                @endif
                <div class="box-body-head">
                    <h4><strong>Employee Details :</strong></h4>
                    <ul class="emp-detail-list row">
                        <li class="col-sm-3">
                            Name : <strong>{{ $employee->name }}</strong>
                        </li>
                        <li class="col-sm-3">
                            Employee ID : <strong>{{ $employee->employee_reg_id }}</strong>
                        </li>
                        <li class="col-sm-3">
                            Designation : <strong>{{ $employee->designation_name }}</strong>
                        </li>
                        <li class="col-sm-3">
                            Date of Joining: <strong>{{ $employee->date_hired }}</strong>
                        </li>
                    </ul>
                    <!-- <h4 class="btn btn-success">Month: <strong>{{ Carbon\Carbon::parse($employee->created_at)->format('F') }}</strong></h4> -->
                </div>
                <h4>Department: <strong>{{ $employee->department_name }} </strong></h4>
                <form class="emp-factor-form" role="form" method="POST" action="{{ route('employee_factor.factors_management', ['employee_id' => $employee->id, 'year'=>$year]) }}">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="table-responsive">
                    <div class="form-group">
                    <label class="col-md-3 control-label">Select Year</label>
                         <div class="col-md-6">
                         <select class="form-control onchenageTrigger"  name="year">
                            <option data-url ="{{ route('employee_factor.factors_management', ['employee_id' => $employee->id, 'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                            <option data-url ="{{ route('employee_factor.factors_management', ['employee_id' => $employee->id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                        </select>
                        </div>
                    </div>
                    <br>
                        <table class="table table-hover">
                            <thead>
                                <tr class="thead-bg">
                                    <th style="width:8%">Select</th>
                                    <th>Factors</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factors as $factor)
                                <tr>
                                    <td>
                                        <label>
                                        <input type="checkbox" data-targetid="factorTargerId{{ $factor->id }}" class="factor_checkbox" name="factors[]" value="{{ $factor->id }}" @if($factor->is_selected) checked @endif id="option{{ $factor->id }}">
                                        </label>
                                    </td>
                                    <td>
                                        <label for="option{{ $factor->id }}">{{ $factor->name }}</label>
                                    </td>
                                    <td><input type="text" id="factorTargerId{{ $factor->id }}" name="targets[{{$factor->id}}]" value="{{ $factor->target }}" class="form-control mw100"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    (* Total maximum target should be equal to 50)
                    <div class="text-right">
                        <a href="{{ url('employee-management') }}" class="btn btn-danger btn-100">Cancel</a>
                        <button class="btn btn-success btn-100">Complete</button>
                    </div>
                </form>
            </div>
            <!--/Ela Code Starts Here-->
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection