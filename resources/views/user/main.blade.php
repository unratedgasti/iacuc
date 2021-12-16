@extends('layouts/index')
@section('content_body')
<div class="main">
	
	<div class="main-inner">

		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="widget">
						
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>User Maintenance</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content">
							@if(isset($_GET['response']))
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>User Created</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>                    
							@endif
							<div align="right">
								 @if(in_array(1,getUserRole()))
								<a class="btn btn-primary" href="{{url('/user/create')}}"> Create New User </a>
								@endif
							</div>
							<br>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>										
										<th class="td-actions"> </th>
										<th> Title </th>
										<th> Name </th>
										<th> Email </th>
										<th> Contact Number</th>
										<th> Roles</th>
										<th> Status</th>
									</tr>
								</thead>
								<tbody>
									
									@foreach($users as $u)
									<tr>
										<td>
											<div class="btn-group ">
												<div class="btn-group ">
													<button type="button" class="btn btn-default dropdown-toggle btn-success" data-toggle="dropdown">
														Action
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="{{url('/user/edit/'.$u->id)}}">Edit</a></li>
														<li><a href="{{url('/user/userPassword/'.$u->id)}}">Change Password</a></li>
													</ul>
												</div>
											</div>
										</td>
										<td> {{$u->honorifics}} </td>
										<td> {{$u->name}} </td>
										<td> {{$u->email}} </td>
										<td> {{$u->contact_number}}</td>
										<td>@foreach($u->roles as $r)
											{{$r->name}}<br>
											@endforeach
										</td>
										<td> @if($u->status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-warning">Inactive</span> @endif</td>
									</tr>
									@endforeach
									
								</tbody>
							</table>
						</div> <!-- /widget-content -->
						
					</div> <!-- /widget -->



				</div>
			</div>      

		</div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->

@endsection



@section('content_scripts')

