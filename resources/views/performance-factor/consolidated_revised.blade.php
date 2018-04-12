
    <style>
      
       .yesprint{
            display: none;
          }

         table {
         border-collapse: collapse;
         width: 100%;
         border: 1px solid black;
         font-size: 15px ;
         }
         td{
         border-left: 1px solid black ;
         border-right: 1px solid black ;
         border-top: 1px solid black !important;
         border-bottom:1px solid black ;
         padding: 2px 2px;

         border-width: thin;
         font-size: 13px ;
         }
         th {
         border-left: 1px solid black ;
         border-right: 1px solid black ;
         border-top: 1px solid black ;
         border-bottom:1px solid black ;
         padding: 2px 2px;
           border-width: thin;
            font-weight: bold; 
            font-size: 15px ;    
         }



  
    
}


       
      </style>

      <style>
         @media print {
          .main-header,.main-sidebar,.main-header,.navbar,.navbar-static-top,.main-sidebar,.noprint,.main-footer{
            display: none;
          }
           .yesprint{
            display: table-cell;
          }

          body {
       display: table;
       table-layout: fixed;
       padding-top: 2.5cm;
       padding-bottom: 2.5cm;
       height: auto;
}

          .printdiv{
            min-height: 850px !important;
          }

         table {
         border-collapse: collapse;
         width: 100%;
         border: 1px solid black;
         font-size: 12px ;
         }
         td{

         padding: 2px 2px;

         border-width: thin;
         font-size: 12px ;
         }
         th {

         padding: 2px 2px;
           border-width: thin;
            font-weight: normal; 
            font-size: 12px ;    
         }

         .content-wrapper, .right-side, .main-footer {
    /* -webkit-transition: -webkit-transform .3s ease-in-out,margin .3s ease-in-out; */
    -moz-transition: -moz-transform .3s ease-in-out,margin .3s ease-in-out;
    -o-transition: -o-transform .3s ease-in-out,margin .3s ease-in-out;
    /* transition: transform .3s ease-in-out,margin .3s ease-in-out; */
     margin-left: 1px !important;
    z-index: 820;
}
       
}
      </style>

@extends('performance-factor.base')
@section('action-content')
<!-- Main content -->
<section class="content">
   <div class="box ">
      <div class="box-header noprint">
         <div class="row noprint">
            <div class="col-sm-8">
               <h3 class="box-title noprint">Consolidted Revised Pay Report</h3>
            </div>
           
         </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
         <table id="example2" class="table" >
            <thead>
              <tr role="row">
                <th width="2%" >S no</th>
                <th width="5%" >Emp Reg#</th>
                <th width="20%" >Employee Name</th>
                <th width="10%" >Team</th>
                <th width="20%" >Department</th>
                <th width="5%" >Score for 50</th>
                <th width="5%" >Total Score</th>
                <th width="5%" >Revised Pay</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($sheets as  $index => $sheet)
                <tr role="row" class="odd">
                  <td style="text-align:right" >{{ $index+1 }}</td>
                  <td style="text-align:right" >{{ $sheet->employee_reg_id }}</td>
                  <td >{{ $sheet->name }}</td>
                  <td>{{ $sheet->Teamname }}</td>
                  <td>{{ $sheet->deptname }}</td>
                  <td style="text-align:right" >{{ $sheet->scroefor50 }}</td>
                  <td style="text-align:right" >{{ $sheet->Totalscore }}</td>
                  <td style="text-align:right" >{{ $sheet->Revisedpay }}</td>
              </tr>
            @endforeach
            </tbody>
            <!-- <tfoot>
              <tr>
                <th width="20%" rowspan="1" colspan="1">City Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">State Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot> -->
          </table>
         
      </div>
      <!-- /.box-body -->
   </div>
</section>
<!-- /.content -->
</div>
@endsection