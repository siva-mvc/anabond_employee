
      <style>
                .main-header,.main-sidebar,.main-header,.navbar,.navbar-static-top,.main-sidebar,.main-footer{
            display: none;
          }
         table {
         border-collapse: collapse;
         width: 100%;
         border: 1px solid black;
         font-size: 10px ;
         }
         td{
          border: 1px solid black;
         padding: 2px 2px;
         text-align:right;
         border-width: thin;
         font-size: 10px ;
         }
         th {
        border: 1px solid black;
         padding: 2px 2px;
           border-width: thin;
            font-weight: normal; 
            font-size: 10px ;    
         }

.content-wrapper, .right-side {
    min-height: 100%;
    background-color: #fff !important;
    z-index: 800;
}


.skin-green .wrapper, .skin-green .main-sidebar, .skin-green .left-side {
     background-color: #fff !important;
}

     .content-wrapper, .right-side, .main-footer {
    /* -webkit-transition: -webkit-transform .3s ease-in-out,margin .3s ease-in-out; */
    -moz-transition: -moz-transform .3s ease-in-out,margin .3s ease-in-out;
    -o-transition: -o-transform .3s ease-in-out,margin .3s ease-in-out;
    /* transition: transform .3s ease-in-out,margin .3s ease-in-out; */
     margin-left: 1px !important;
    z-index: 820;
}
       
      </style>


@extends('performance-factor.base')
@section('action-content')
<section class="content">

         @foreach ($sheets as  $index => $sheet)
         @if ($loop->first)
         <div style="page-break-inside: avoid;" class="col-sm-12">
          <table id="example2" class="table">
                <thead>
                  <tr>
                     <th colspan="14" style=" border-bottom: 1px solid black;text-align:left;"><img src="{{ url('/')}}/Printlogo.png"> </th>
                        <th colspan="3" style=" border-left: 0px solid black; border-bottom: 1px solid black; text-align:right;"><img height="60%" width="75%" src="{{ url('/')}}/rekon.png"> </th>
                     
             <!--         <th colspan="4">Printed on {{date('d-m-Y')}}</th> -->
                    </tr>
                   <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee id: </th>
                     <th colspan="16"  style=" border-left: 0px solid black;border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->employee_reg_id  }}</th>
                  </tr>
                   <tr>
                     <th colspan="1"  style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee name: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;"> Mr/Mrs/Ms., {{ $sheet->NAME }}</th>
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
                    <th style="width:30%;" rowspan="2">Performance Factor</th>
                     <th rowspan="2">Rating for 50</th>
                      <th colspan="3">I st Quarter</th>
                       <th colspan="3">II nd Quarter</th>
                        <th colspan="3">III rd Quarter</th>
                        <th colspan="3" >IV th Quarter</th>
                          <th colspan="3" >Year {{ $sheet->DisplayYear}} Final Score</th>
                  </tr>
                     <tr>
                       <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                  </tr>
               </thead>

                <tfoot>
                    <tr>
                      <td style="text-align:left;" colspan="17">*This is a computer generated document</td>
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
                    
                  </tbody>
                
              </table>
            </div>

        <div style="page-break-inside: avoid;" class="col-sm-12">
          <table id="example2" class="table">
                <thead>
               <tr>
                     <th colspan="14" style=" border-right: 0px solid black; text-align:left;"><img src="{{ url('/')}}/Printlogo.png"> </th>
                        <th colspan="3" style=" border-left: 0px solid black; text-align:right;"><img height="60%" width="75%" src="{{ url('/')}}/rekon.png"> </th>
                     
             <!--         <th colspan="4">Printed on {{date('d-m-Y')}}</th> -->
                    </tr>
                   <tr>
                     <th colspan="1" style=" border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee id: </th>
                     <th colspan="16"  style=" border-left: 0px solid black;border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">{{ $sheet->employee_reg_id  }}</th>
                  </tr>
                   <tr>
                     <th colspan="1"  style="border-right: 0px solid black; border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;">Employee name: </th>
                     <th colspan="16" style="border-left: 0px solid black;  border-bottom: 0px solid black; border-top: 0px solid black; text-align:left;"> Mr/Mrs/Ms., {{ $sheet->NAME }}</th>
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
                    <th style="width:30%;" rowspan="2">Performance Factor</th>
                     <th rowspan="2">Rating for 50</th>
                      <th colspan="3">I st Quarter</th>
                       <th colspan="3">II nd Quarter</th>
                        <th colspan="3">III rd Quarter</th>
                        <th colspan="3" >IV th Quarter</th>
                          <th colspan="3" >Year {{ $sheet->DisplayYear}} Final Score</th>
                  </tr>
                     <tr>
                       <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                        <th>Target</th>
                       <th>Achived</th>
                        <th>Rating</th>
                  </tr>
               </thead>

                <tfoot>
                    <tr>
                      <td style="text-align:left;" colspan="17">*This is a computer generated document</td>
                    </tr>
                  </tfoot>
               @else
               @endif
                  <tbody>
                     <tr>
                        <!-- <td>{{ $index+1}}</td> -->
                        <td style="text-align:left;">{{ $sheet->factor_name  }}</td>
                        <td>{{ $sheet->Rating }}</td>
                        <td>{{ $sheet->Q1AVGTARGET}}</td>
                        <td>{{ $sheet->Q1AVGACHIVED}}</td>
                        <td>{{ $sheet->Q1RATING}}</td>
                        <td>{{ $sheet->Q2AVGTARGET}}</td>
                        <td>{{ $sheet->Q2AVGACHIVED}}</td>
                        <td>{{ $sheet->Q2RATING}}</td>
                        <td>{{ $sheet->Q3AVGTARGET}}</td>
                        <td>{{ $sheet->Q3AVGACHIVED}}</td>
                        <td>{{ $sheet->Q3RATING}}</td>
                        <td>{{ $sheet->Q4AVGTARGET}}</td>
                        <td>{{ $sheet->Q4AVGACHIVED}}</td>
                        <td>{{ $sheet->Q4RATING}}</td>
                        <td>{{ $sheet->YRLYAVGTARGET}}</td>
                        <td>{{ $sheet->YRLYAVGACHIVED}}</td>
                        <td>{{ $sheet->YRLYRATING}}</td>
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
                  </tbody>
                    </table>
                    </div>
                @else
                   @endif
                 @endforeach  

</section>
@endsection
