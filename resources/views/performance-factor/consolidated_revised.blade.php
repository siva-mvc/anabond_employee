
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
.box {border-top: 0px solid #d2d6de !important;}
}
</style>


@extends('performance-factor.base')
@section('action-content')
<!-- Main content -->
<section class="content">
   <div class="box ">
      <div class="box-header noprint">
         <div class="row noprint">
            <div class="col-sm-8 ">
               <h3 class="box-title noprint">Consolidted Revised Pay Report</h3>
            </div
         </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">

       <div style="background-color:#d9d9d9" class="box-body noprint">
            <label style="text-align: left; padding-right: 0px; padding-top:5px" class="col-md-2 control-label">Select Department </label>
            <div style="text-align: right; padding-left: 20px;" class="col-md-3">
               <select class="form-control onchenageTrigger"  name="dept_id">
                @if(Auth::user()->email =='admin@rekon.anabond.co.in')
               <option data-url ="{{ route('employee_factor.consolidatedpay', ['dept_id' => 0,'year'=>2017]) }}"  value="0" @if($dept_id == '0') selected @endif>All Depertment</option>
               @endif

               @foreach ($depts as $dept) 
               @if(in_array($dept->id, Session::get('departments')))
               <option data-url ="{{ route('employee_factor.consolidatedpay', ['dept_id' => $dept->id ,'year'=>$year]) }}"  value="{{ $dept->id }}" @if($dept->id == $dept_id) selected @endif>{{ $dept->name }}</option>
               @endif
               @endforeach  
               </select>
            </div>
            <div class="col-sm-2">
               <label style="text-align: right; padding-right: 0px; padding-top:5px" ; class="col-md-5 control-label">Select Year</label>
               <div class="col-md-7">
                  <select class="form-control onchenageTrigger"  name="year">
                  <option data-url ="{{ route('employee_factor.consolidatedpay', ['dept_id' => $dept_id,'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                  <option data-url ="{{ route('employee_factor.consolidatedpay', ['dept_id' => $dept_id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                  </select>
               </div>
            </div>
             <div class="col-sm-4">
               @if (count($sheets)>0) <button class="btn btn-primary" onClick="window.print()">Print Report</button> @endif
            </div>
         </div>
         @if (count($sheets)>0)
         <table id="example2" class="table" >
            <thead>
            <tr>
                <th class="yesprint" colspan="5" style=" border-bottom: 1px solid black;text-align:left; border-right: 0px solid black;"><img src="{{ url('/')}}/Printlogo.png"> </th>
                <th class="yesprint" colspan="3" style=" border-left: 0px solid black; border-bottom: 1px solid black; text-align:right;"><img height="60%" width="75%" src="{{ url('/')}}/rekon.png"> </th>
            </tr>
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
                  <td>{{ $sheet->name }}</td>
                  <td>{{ $sheet->Teamname }}</td>
                  <td>{{ $sheet->deptname }}</td>
                  <td style="text-align:right" >{{ $sheet->scroefor50 }}</td>
                  <td style="text-align:right" >{{ $sheet->Totalscore }}</td>
                  <td style="text-align:right" >{{ $sheet->Revisedpay }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot  >
                  <tr>
                     <td class="yesprint" style="text-align:left;" colspan="8">*This is a computer generated document</td>
                  </tr>
            </tfoot>
          </table>
          @endif
         
      </div>
      <!-- /.box-body -->
   </div>
</section>
<!-- /.content -->
</div>
@endsection