
<style>
      
       .yesprint{
            display: none;
          }

         table {
         border-collapse: collapse;
         width: 100%;
         border: 1px solid black;
         font-size: 10px ;
         }
         td{
         border-left: 1px solid black ;
         border-right: 1px solid black ;
         border-top: 1px solid black !important;
         border-bottom:1px solid black ;
         padding: 2px 2px;
         text-align:right;
         border-width: thin;
         font-size: 12 px ;
         }
         th {
         border-left: 1px solid black ;
         border-right: 1px solid black ;
         border-top: 1px solid black ;
         border-bottom:1px solid black ;
         padding: 2px 2px;
           border-width: thin;
            font-weight: normal; 
            font-size: 12px ;    
         }
}  
</style>


<style>
         @media print {
          .main-header,.main-sidebar,.main-header,.navbar,.navbar-static-top,.main-sidebar,.noprint,.main-footer,.box-header{
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
         text-align:right;
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
            <div class="col-sm-8">
               <h3 class="box-title noprint">Performance Reports Preview</h3>
            </div>
           
         </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">

         <div style="background-color:#d9d9d9" class="box-body noprint">
            <label style="text-align: left; padding-right: 0px; padding-top:5px" class="col-md-2 control-label">Select Department </label>
            <div style="text-align: right; padding-left: 20px;" class="col-md-3">
               <select class="form-control onchenageTrigger"  name="dept_id">
                @if(Auth::user()->email =='admin@rekon.anabond.co.in')
               <option data-url ="{{ route('employee_factor.export_listnew', ['dept_id' => 0,'year'=>2017]) }}"  value="0" @if($dept_id == '0') selected @endif>All Depertment</option>
               @endif

               @foreach ($depts as $dept) 
               @if(in_array($dept->id, Session::get('departments')))
               <option data-url ="{{ route('employee_factor.export_listnew', ['dept_id' => $dept->id ,'year'=>$year]) }}"  value="{{ $dept->id }}" @if($dept->id == $dept_id) selected @endif>{{ $dept->name }}</option>
               @endif
               @endforeach  
               </select>
            </div>
            <div class="col-sm-2">
               <label style="text-align: right; padding-right: 0px; padding-top:5px" ; class="col-md-5 control-label">Select Year</label>
               <div class="col-md-7">
                  <select class="form-control onchenageTrigger"  name="year">
                  <option data-url ="{{ route('employee_factor.export_listnew', ['dept_id' => $dept_id,'year'=>2017]) }}"  value="2017" @if($year == '2017') selected @endif>2017-2018</option> 
                  <option data-url ="{{ route('employee_factor.export_listnew', ['dept_id' => $dept_id, 'year'=>2018]) }}" value="2018" @if($year == '2018') selected @endif>2018-2019</option>     
                  </select>
               </div>
            </div>
             <div class="col-sm-4">
               @if (count($sheets)>0) <button class="btn btn-primary" onClick="window.print()">Print Report</button> @endif
            </div>
         </div>
       <div class="box-body table-responsive printpage"> 
         @foreach ($sheets as  $index => $sheet)
         @if ($loop->first)
         <div style="page-break-after:always" class="printdiv col-sm-12">
            <table id="example2" class="table">
               <thead>
                  <tr>
                     <th class="yesprint" colspan="14" style=" border-bottom: 1px solid black;text-align:left; border-right: 0px solid black;"><img src="{{ url('/')}}/Printlogo.png"> </th>
                     <th class="yesprint" colspan="3" style=" border-left: 0px solid black; border-bottom: 1px solid black; text-align:right;"><img height="60%" width="75%" src="{{ url('/')}}/rekon.png"> </th>
                     <!--         <th colspan="4">Printed on {{date('d-m-Y')}}</th> -->
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee id: </th>
                     <th colspan="16"  style=" border-left: 0px solid black;border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->employee_reg_id  }}</th>
                  </tr>
                  <tr>
                     <th colspan="1"  style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee name: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;"> {{ $sheet->NAME }}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Department: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->DEPTNAME}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Designation: </th>
                     <th colspan="16" style="border-left: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->DESIGNAME}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style="border-right: 0px solid black; border-bottom: 0px solid black;border-top: 0px solid black;  text-align:left;">Annual Year:  </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black;border-top: 0px solid black; text-align:left;">{{ $sheet->DisplayYear}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Printed on:</th>
                     <th colspan="16" style="border-left: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{date('d-m-Y')}}</th>
                  </tr>
                  <tr>
                     <th style="width:30%; border: 1px solid black;" rowspan="2">Performance Factor</th>
                     <th style="border: 1px solid black;" rowspan="2">Rating for 50</th>
                     <th style="border: 1px solid black;" colspan="3">I st Quarter</th>
                     <th style="border: 1px solid black;" colspan="3">II nd Quarter</th>
                     <th style="border: 1px solid black;" colspan="3">III rd Quarter</th>
                     <th style="border: 1px solid black;" colspan="3" >IV th Quarter</th>
                     <th style="border: 1px solid black;" colspan="3" >Year {{ $sheet->DisplayYear}} Final Score</th>
                  </tr>
                  <tr>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                  </tr>
               </thead>
               <tfoot  >
                  <tr>
                     <td class="yesprint" style="text-align:left;" colspan="17">*This is a computer generated document</td>
                  </tr>
               </tfoot>
               @elseif( $sheets[$index-1]->employee_reg_id != $sheet->employee_reg_id )
               <tbody>
                  @if( ! empty($sheets[$index-1]->experience) && $sheets[$index-1]->experience>0)
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td style="text-align:left;">Experience</td>
                     <td>Max 5.00</td>
                     <td colspan="14"></td>
                     <td>{{ $sheets[$index-1]->experience}}</td>
                  </tr>
                  @endif
                  @if( ! empty($sheets[$index-1]->future_prospect) && $sheets[$index-1]->future_prospect>0 )
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td style="text-align:left;">Future Prospects</td>
                     <td>Max 5.00</td>
                     <td colspan="14"></td>
                     <td>{{ $sheets[$index-1]->future_prospect}}</td>
                  </tr>
                  @endif
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td colspan="16" style="text-align:right;  font-size: 16px; font-weight: bold;">Performance score for the year {{ $sheets[$index-1]->DisplayYear}}</td>
                     <td style="text-align:right;  font-size: 16px; font-weight: bold;" >{{ $sheets[$index-1]->TOTALSCORE}}</td>
                  </tr>
                  @if( ! empty($sheets[$index-1]->notes))
                  <tr>
                        <td colspan="17"  style="text-align:left; font-size: 12px; " >Comments: {{ $sheets[$index-1]->notes}}</td>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
         <div style="page-break-inside:avoid;" class=" printdiv col-sm-12">
            <table id="example2" class="table">
              <thead>
                  <tr>
                     <th class="yesprint"  colspan="14" style=" border-bottom: 1px solid black;text-align:left; border-right: 0px solid black;"><img src="{{ url('/')}}/Printlogo.png"> </th>
                     <th class="yesprint"  colspan="3" style=" border-left: 0px solid black; border-bottom: 1px solid black; text-align:right;"><img height="60%" width="75%" src="{{ url('/')}}/rekon.png"> </th>
                     <!--         <th colspan="4">Printed on {{date('d-m-Y')}}</th> -->
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee id: </th>
                     <th colspan="16"  style=" border-left: 0px solid black;border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->employee_reg_id  }}</th>
                  </tr>
                  <tr>
                     <th colspan="1"  style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee name: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;"> {{ $sheet->NAME }}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Department: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->DEPTNAME}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Designation: </th>
                     <th colspan="16" style="border-left: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->DESIGNAME}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style="border-right: 0px solid black; border-bottom: 0px solid black;border-top: 0px solid black;  text-align:left;">Annual Year:  </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black;border-top: 0px solid black; text-align:left;">{{ $sheet->DisplayYear}}</th>
                  </tr>
                  <tr>
                     <th colspan="1" style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Printed on:</th>
                     <th colspan="16" style="border-left: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{date('d-m-Y')}}</th>
                  </tr>
                  <tr>
                     <th style="width:30%; border: 1px solid black;" rowspan="2">Performance Factor</th>
                     <th style="border: 1px solid black;" rowspan="2">Rating for 50</th>
                     <th style="border: 1px solid black;" colspan="3">I st Quarter</th>
                     <th style="border: 1px solid black;" colspan="3">II nd Quarter</th>
                     <th style="border: 1px solid black;" colspan="3">III rd Quarter</th>
                     <th style="border: 1px solid black;" colspan="3" >IV th Quarter</th>
                     <th style="border: 1px solid black;" colspan="3" >Year {{ $sheet->DisplayYear}} Final Score</th>
                  </tr>
                  <tr>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                     <th style="border: 1px solid black;" >Target</th>
                     <th style="border: 1px solid black;" >Achived</th>
                     <th style="border: 1px solid black;" >Rating</th>
                  </tr>
               </thead>
               <tfoot >
                  <tr>
                     <td  class="yesprint" style="text-align:left;" colspan="17">*This is a computer generated document</td>
                  </tr>
               </tfoot>
               @else
               @endif
               <tbody>
                  <tr>
                     <td style="border: 1px solid black; text-align:left;">{{ $sheet->factor_name  }}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Rating }}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q1AVGTARGET}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q1AVGACHIVED}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q1RATING}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q2AVGTARGET}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q2AVGACHIVED}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q2RATING}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q3AVGTARGET}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q3AVGACHIVED}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q3RATING}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q4AVGTARGET}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q4AVGACHIVED}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->Q4RATING}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->YRLYAVGTARGET}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->YRLYAVGACHIVED}}</td>
                     <td style="border: 1px solid black;">{{ $sheet->YRLYRATING}}</td>
                  </tr>
               </tbody>
               @if ($loop->last)
               <tbody>
                  @if( ! empty($sheet->experience) && $sheet->experience>0)
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td style="text-align:left;">Experience</td>
                     <td>Max 5.00</td>
                     <td colspan="14"></td>
                     <td>{{ $sheet->experience}}</td>
                  </tr>
                  @endif
                  @if( ! empty($sheet->future_prospect) && $sheet->future_prospect>0)
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td style="text-align:left;">Future Prospects</td>
                     <td>Max 5.00</td>
                     <td colspan="14"></td>
                     <td>{{ $sheet->future_prospect}}</td>
                  </tr>
                  @endif
                  <tr>
                     <!-- <td>{{ $index+1}}</td> -->
                     <td colspan="16" style="text-align:right; font-size: 16px; font-weight: bold;">Performance score for the year {{ $sheets[$index-1]->DisplayYear}}</td>
                     <td style="text-align:right;  font-size: 16px; font-weight: bold;" >{{ $sheet->TOTALSCORE}}</td>
                  </tr>
                  @if( ! empty($sheets[$index-1]->notes))
                  <tr>
                        <td colspan="17"  style="text-align:left; font-size: 12px; " >Comments: {{ $sheets[$index-1]->notes}}</td>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>
         @else
         @endif
         @endforeach  
      </div>
      <!-- /.box-body -->
   </div>
</section>
<!-- /.content -->
</div>
@endsection