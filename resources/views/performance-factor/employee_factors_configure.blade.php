@extends('performance-factor.base')
@section('action-content')
    <!-- Main content -->
<section class="content">
  <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
          
          <!-- Ela Code Starts Here-->
        <div class="box-body-inner">
        <div class="box-body-head">
           <h4><strong>Employee Details :</strong></h4>
          <ul class="emp-detail-list row">  
            <li class="col-sm-3">
              Name : <strong>Enose Elisha</strong>
            </li>
            <li class="col-sm-3">
              Employee ID : <strong>ENSA</strong>
            </li>
            <li class="col-sm-3">
              Designation : <strong>UI Developer</strong>
            </li>
            <li class="col-sm-3">
              Department : <strong>HR</strong>
            </li>
            <li class="col-sm-3">
              Birth Date : <strong>1993/08/30</strong>
            </li>
            <li class="col-sm-3">
              Date of Joining: <strong>2014/08/30</strong>
            </li>
          </ul>
          <h4 class="btn btn-success">Month: <strong>January</strong></h4>
        </div>
            <h4>Department: <strong>HR Department</strong></h4>
            <form class="emp-factor-form">
                <div class="table-responsive">
                    <table class="table table-hover">
                         <thead>
                              <tr class="thead-bg">
                                  <th style="width:8%">Select</th>
                                  <th>Factors</th>
                                  <th>Maximum Score</th>
                             </tr>
                        </thead>
                        <tbody>
                             <tr>
                                 <td>
                                   <label>
                                     <input type="checkbox" id="option1">
                                   </label>
                                 </td>
                                 <td>
                                     <label for="option1">Factor 1</label>
                                 </td>
                                 <td><input type="text" class="form-control mw100"></td>
                            </tr>
							
							<tr>
                                 <td>
                                   <label>
                                     <input type="checkbox" id="option2">
                                   </label>
                                 </td>
                                 <td>
                                     <label for="option2">Factor 2</label>
                                 </td>
                                 <td><input type="text" class="form-control mw100"></td>
                            </tr>
							
							<tr>
                                 <td>
                                   <label>
                                     <input type="checkbox" id="option3">
                                   </label>
                                 </td>
                                 <td>
                                     <label for="option3">Factor 3</label>
                                 </td>
                                 <td><input type="text" class="form-control mw100"></td>
                            </tr>
							
							<tr>
                                 <td>
                                   <label>
                                     <input type="checkbox" id="option4">
                                   </label>
                                 </td>
                                 <td>
                                     <label for="option4">Factor 4</label>
                                 </td>
                                 <td><input type="text" class="form-control mw100"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
				
				<div class="text-right">
					<button class="btn btn-danger btn-100">Cancel</button>
					<button class="btn btn-success btn-100">Save</button>
				</div>
            </form>
        </div>
            
          <!--/Ela Code Starts Here-->
          
      </div>
      <!-- /.box-body -->
    </div>
</section>
@endsection