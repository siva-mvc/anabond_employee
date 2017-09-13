 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: solid 2px;
        padding: 10px 5px;
      }
      tr {
        text-align: center;
      }
      .container {
        width: 100%;
        text-align: center;
      }
    </style>
  </head>
  <body>
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
        @foreach ($sheets as $key => $s)
            <div class="box-body-inner">
                <div class="box-body-head">
                    <h4><strong>Employee Details :</strong></h4>
                    <ul class="emp-detail-list row">
                        <li class="col-sm-2">
                            Name : <strong>{{ $s['employee']->firstname }} {{ $s['employee']->lastname }}</strong>
                        </li>
                        <li class="col-sm-2">
                            Employee ID : <strong>{{ $s['employee']->employee_reg_id }}</strong>
                        </li>
                        <li class="col-sm-3">
                            Date of Joining: <strong>{{ $s['employee']->date_hired }}</strong>
                        </li>
                    </ul>
                </div>
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
                            @foreach ($s["sheets"] as $key => $value)
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
                                        <input disabled type="text" class="form-control" value="{{ $s['targets'][$key] }}">
                                        <span class="input-group-addon">{{ $value[15]->target }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>Experience</td>
                                <td colspan="8"></td>
                                <td>
                                    <div class="input-group ingroup150">
                                        <input type="text" class="form-control exp_max_5" value="{{ $s['sheet'][0]['experience'] }}" name="experience">
                                        <span class="input-group-addon">5.00</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Future prospects</td>
                                <td colspan="8"></td>
                                <td>
                                    <div class="input-group ingroup150">
                                        <input type="text" class="form-control future_max_5" value="{{ $s['sheet'][0]['future_prospect'] }}" name="future_prospect">
                                        <span class="input-group-addon">5.00</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9">Performance score </td>
                                <td>
                                    <div class="input-group ingroup150">
                                        <input type="text" readonly class="form-control total_score" value="{{ $s['sheet'][0]['total_score'] }}" name="total">
                                        <span class="input-group-addon">50</span>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="breakNow"></div>
        @endforeach    
        </div>
        <!-- /.box-body -->
    </div>
</section>

  </body>
</html>