
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">IACUC</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>                
                
                 <a href="{{url('/user/edit/'.Auth::user()->id)}}">Edit Profile</a></li>
            
                 <a href="{{url('/user/password')}}">Change Password</a></li>
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li> -->
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:15px;">
            <i class="icon-user"></i><strong> {{Auth::check() ? Auth::user()->name : ''}}</strong><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('/user/edit/'.Auth::user()->id)}}">Edit Profile</a></li>
              <li><a href="{{url('/user/password')}}">Change Password</a></li>
              <li><a href="{{url('/logout')}}">Logout</a></li>
            </ul>
          </li>
        </ul>
        <!-- <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form> -->
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>