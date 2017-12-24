  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
    <!-- <span class="logo-lg">{{ config('app.name', 'EmployeeManagement') }}</span> -->
     <img src="{{ url('/')}}/logo.png">
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @if(substr( Auth::user()->picture, 0, 7 ) === "avatars")
                <img src="{{ url('/')}}/{{ Auth::user()->picture }}" class="user-image" alt="user">
              @else
               <img src="{{ Auth::user()->picture }}" class="user-image" alt="user">
              @endif 
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
              @if(substr( Auth::user()->picture, 0, 7 ) === "avatars")
                <img src="{{ url('/')}}/{{ Auth::user()->picture }}" class="img-circle" alt="user">
              @else
              <img src="{{ Auth::user()->picture }}" class="img-circle" alt="user">
              @endif    
                <p>
                  Hello {{ Auth::user()->username }} 
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
               @if (Auth::guest())
                  <div class="pull-left">
                    <a href="{{ route('login') }}" class="btn btn-default btn-flat">Login</a>
                  </div>
               @else
                 <div class="pull-left">
                    <!--<a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>-->
                  </div>
                 <div class="text-center">
                    <a class="btn btn-warning btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                    </a>
                 </div>
                @endif
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>