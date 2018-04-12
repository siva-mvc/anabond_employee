  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
      @if(Auth::user()->userrole =='Sysadmin' || Auth::user()->userrole =='Department head' || Auth::user()->userrole =='Division head' || Auth::user()->userrole =='Branch Head' )
        <li class="{{ preg_match('/employee-management/',Request::path()) ? 'active' : '' }} 
        {{ preg_match('/employee-factors-management/',Request::path()) ? 'active' : '' }}
        {{ preg_match('/employee-perfromance-sheet/',Request::path()) ? 'active' : '' }}" >
        <a  href="{{ url('employee-management') }}"><span>Employee Management</span></a></li>
      @endif
        @if(Auth::user()->userrole =='Sysadmin' || Auth::user()->userrole =='Department head' )
        @if(!empty(Session::get('departments'))) 
        
        <li class="{{ preg_match('/employee-factors-update-credit/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('employee-factors-update-credit') }}/{{ Session::get('departments')[0]}}/2017"> <span>Update Score by Factors</span></a></li>
         @endif
        
        @if(!empty(Session::get('departments'))) 
          <li class="{{ preg_match('/employee-factors-update-byemp/',Request::path()) ? 'active' : '' }}"><a href="{{ url('employee-factors-update-byemp') }}/{{ Session::get('departments')[0]}}/2017"> <span>Update Score by Employee</span></a></li>
         @endif
        
        @endif

        @if(Auth::user()->userrole =='Sysadmin')
        <li class="treeview {{ preg_match('/system-management/',Request::path()) ? 'active' : '' }}">
          <a href="#"></i> <span>System Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="{{ preg_match('/designation/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('system-management/designation') }}">Designation</a></li>
            <li class="{{ preg_match('/department/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('system-management/department') }}">Department</a></li>
            <li class="{{ preg_match('/factor/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('system-management/factor') }}">Performance Factor</a></li>
            <li class="{{ preg_match('/team/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('system-management/team') }}">Team</a></li>

          </ul>
        </li>

         @endif 

    
        <li class="treeview {{ preg_match('/employee-perfromance-pdf-listnew/',Request::path()) ? 'active' : '' }} {{ preg_match('/consolidated-revisedpay/',Request::path()) ? 'active' : '' }}">
          <a href="#"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
          <li class="{{ preg_match('/employee-perfromance-pdf-listnew/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('employee-perfromance-pdf-listnew') }}/{{ Session::get('departments')[0]}}/2017">Performance Reports</a></li> 
          @if(Auth::user()->userrole =='Sysadmin')
          <li class="{{ preg_match('/consolidated-revisedpay/',Request::path()) ? 'active' : '' }}" ><a href="{{ url('consolidated-revisedpay') }}/2017">Consolidted Revised Pay Report</a></li> 
          @endif 
          </ul>
        </li>

         

         @if(Auth::user()->userrole =='Sysadmin')
        <li class="{{ preg_match('/user-management/',Request::path()) ? 'active' : '' }}" ><a href="{{ route('user-management.index') }}"><span>User management</span></a></li>
        @endif 
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>