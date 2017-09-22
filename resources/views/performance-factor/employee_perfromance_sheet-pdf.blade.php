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
        border: 1px solid #f4f4f4;
      }
      td, th {
        border: solid 2px;
        padding: 10px 5px;
      }
      /*.input-group{
        width: 100%;
      }*/
      .input-group .input-group-addon{background-color:#f5f5f5;}
      tr {
        text-align: center;
      }
      .container {
        width: 100%;
        text-align: center;
      }
      .emp-detail-list{
        list-style-type: none;
        line-height: 1.5;
      }
      .emp-data-table td,.emp-data-table th{vertical-align:middle !important;text-align:center;}
      .input-group span{
        /*background-color:#f5f5f5; */
      border-radius: 0;
      padding: 6px 10px;
      border: 1px solid #ccc;
      width: 45px !important;
        display: inline-block;
    }
      .btn-margin {
          margin: 2px 10px;
          font-size: 2vw;
          padding: 1px;
          text-align: center;
 }
.emp-factor-form label{display:block;margin-bottom:0;}
.thead-bg >th,.table-hover>tbody>tr:hover{background-color:#fbfbfb;}
.thead-bg >th{text-transform:uppercase;letter-spacing:0.5px;}
.table-border{border:1px solid #f4f4f4;}
.emp-data-table td,.emp-data-table th{vertical-align:middle !important;text-align:center;}
.emp-data-table td  .ingroup150{margin:0 auto;}
.mw600{max-width:600px;}
.mw80{min-width:60px;}

.c_success {
  background-color: #dff0d8;
}
.c_info {
  background-color: #d9edf7;
}
.header{
    background-color: #00A65A;
    font-size: 20px;
    line-height: 50px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: 300;
}
.header-logo {
    background-color: #008d4c;
    color: #fff;
    padding: 0px 0px 20px 50px;
}
div.break-page{ page-break-before: always;}
    </style>
  </head>
  <body>
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
        @foreach ($sheets as $key => $s)
            <header class="header">
                <div class="header-logo"> ANABOND</div> 

            </header>
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
                                <td>{{ $key }}&nbsp;@isset($value['actual_target'])[{{ $value['actual_target']}}]@endisset</td>
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
                                    <input disabled type="text" class="form-control" value="@isset($value['actual_target'])[{{ $value['actual_target']}}]@endisset">
                                    <span class="input-group-addon">@isset($value['actual_target']) {{ $value['actual_target']}}@endisset</span>
                                  </div>
                                </td> 
                              </tr>
                            @endforeach    
                            <input name="raw_total" class="total_bt" type="hidden" value="@isset($sheet['raw_total']){{ $sheet['raw_total'] }}@endisset">
                            <tr>
                              <td>Experience</td>
                              <td colspan="12"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" class="form-control exp_max_5" value="@isset($sheet['experience']){{ $sheet['experience'] }}@endisset" name="experience">
                                    <span class="input-group-addon">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td>Future prospects</td>
                              <td colspan="12"></td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" class="form-control future_max_5" value="@isset($sheet['future_prospect']){{ $sheet['future_prospect'] }}@endisset" name="future_prospect">
                                    <span class="input-group-addon">5.00</span>
                                  </div></td>
                            </tr>
                            <tr>
                              <td colspan="13">Performance score </td>
                              <td><div class="input-group ingroup150">
                                    <input type="text" readonly class="form-control total_score" value="@isset($sheet['total_score']){{ $sheet['total_score'] }}@endisset" name="total">
                                    <span class="input-group-addon">50</span>
                                  </div></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
            </div>
            <br>
            <div class="break-page"></div>
        @endforeach    
        </div>
        <!-- /.box-body -->
    </div>
</section>

  </body>
</html>