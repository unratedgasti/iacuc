
<div class="subnavbar" align="center">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<?php
				$parts = parse_url(Request::url());
				$path_parts= explode('/', $parts['path']);
				$url = $path_parts[3];

				$prf=array('prf');
				$approvals=array('approvals');
				$admin=array('user');
				?>
				<!-- <li class="{{ $url=='home' ? 'active' : '' }}"><a href="{{url('/home')}}"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li> -->
				   @if(in_array(2,getUserRole()))
				<li class="{{ in_array($url, $prf) ? 'active' : '' }}"><a href="{{url('/prf')}}"><i class="icon-list-alt"></i><span>PRF</span> </a> </li>
				@endif
               @if(in_array(3,getUserRole()) || in_array(4,getUserRole()) || in_array(1,getUserRole()) )
				<li class="dropdown {{ in_array($url, $approvals) ? 'active' : '' }}"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-facetime-video"></i><span>Approvals</span> <b class="caret"></b></a>
				<ul class="dropdown-menu">
							<li><a href="{{url('/approvals')}}">For Approvals</a></li>
							<li><a href="{{url('/approved')}}">Approved PRF</a></li>
							<li><a href="{{url('/resubmit')}}">Resubmit PRF</a></li>
						
						</ul>
				</li>
				@endif
				
					@if(in_array(1,getUserRole()))
					<li class="dropdown {{ in_array($url, $admin) ? 'active' : '' }}"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Admin Controls</span> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{url('/user')}}">Create User</a></li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
			
		</div>
		
	</div>
