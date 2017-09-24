  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">




      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li><a href="{{ url('employee-management') }}"><i class="fa fa-link"></i> <span>Employee Management</span></a></li>

        @if(!empty(Session::get('departments'))) 
        <li><a href="{{ url('employee-factors-update-credit') }}/{{ Session::get('departments')[0] }}/2017"><i class="fa fa-link"></i> <span>Employee Factors Credit</span></a></li>
         @endif
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>System Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           @if(Auth::user()->email =='admin@gmail.com')
            <li><a href="{{ url('system-management/designation') }}">Designation</a></li>
            <li><a href="{{ url('system-management/department') }}">Department</a></li>
            <li><a href="{{ url('system-management/factor') }}">Performance Factor</a></li>
            <li><a href="{{ url('system-management/team') }}">Team</a></li>
            <li><a href="{{ url('system-management/report') }}">Report</a></li>
           @endif 
            <!-- 
            <li><a href="{{ url('system-management/country') }}">Country</a></li>
            <li><a href="{{ url('system-management/state') }}">State</a></li> -->
            <li><a href="{{ url('employee-perfromance-sheet-pdf') }}">Generate PDF</a></li> 
          </ul>
        </li>
        @if(Auth::user()->email =='admin@gmail.com')
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li>
        @endif 
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>