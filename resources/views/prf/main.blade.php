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
							<h3>Protocol Review</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content">
							@if(isset($_GET['response']))
							@if($_GET['response']== 1)
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol Created</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@elseif($_GET['response']== 3)
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol Deleted</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>  
							@else
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol Updated</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>                    
							@endif
							@endif
					      @if(in_array(2,getUserRole()))
							<div align="right">
								<a class="btn btn-primary" href="{{url('/prf/create-prf')}}"> Create New Protocol </a>
							</div>
							@endif
							<br>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th> Protocol Number </th>
										<th> Primary Investigator </th>
										<th> Protocol Name</th>
										<th> Date Created</th>
										<th> Protocol Status</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
									@if(!$prf->isEmpty())
									@foreach($prf as $p)
									<tr>
										<td> {{$p->protocol_no}} </td>
										<td> {{$p->name}} </td>
										<td> {{$p->protocol_name}}</td>
										<td> {{ date("m/d/Y", strtotime($p->date_created)) }}</td>
										<td style="text-align: center;"> @if($p->status == "REJECTED") {{"RESUBMIT"}} @else {{$p->status}} @endif</td>
										<td class="td-actions" style="text-align:center" align="center">
											<div class="btn-group" role="group"	>
											@if($p->status == "CREATED")	
											<input type="hidden" name="protocol_id" value="{{$p->protocol_id}}">											
												<button type="button" class="btn btn-success btn-medium dropdown-toggle" data-toggle="dropdown" style="margin-right: 20px;">
													Actions
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{{url('/prf/view-prf/'.$p->protocol_id)}}" >VIEW</a></li>
													<li><a id="delete_prf" >DELETE</a></li>
												</ul>
											</div>
											@else
											<a href="{{url('/prf/view-prf/'.$p->protocol_id)}}" class="btn btn-medium btn-success">VIEW</a>
											@endif
										</td>

									</tr>
									@endforeach
									@else

									<tr>
										<td colspan="6" style="text-align: center;">No Data Found</td>
									</tr>
									@endif
									
								</tbody>
							</table>
							<br>
							<br>
						</div> <!-- /widget-content -->
						
					</div> <!-- /widget -->



				</div>
			</div>      

		</div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->

@endsection



@section('content_scripts')

<script type="text/javascript">
	$(document).ready(function() {
		$( "#delete_prf" ).click(function() {
			Swal.fire({
				title: 'Are you sure you want to delete this PRF?',
				showDenyButton: true,
				confirmButtonText: `Delete`,
				denyButtonText: `No`,
			}).then((result) => {			
				if (result.isConfirmed) {
					var id=$(this).closest('tr').find("input").val();
								$.ajax({

						type:'POST',
						url:'{{url("/prf/delete-prf")}}',
						dataType: "json",
						data: { 
							'protocol_id': id,
							'_token' : '<?php echo csrf_token() ?>'
						},
						success:function(html) {
          // alert(html);
          Swal.fire(
          	'PRF Deleted', '', 'success'
          	).then(function(html) {
          		location.href = '{{url("/prf?response=3")}}';
          	});

          }
      });


				} else if (result.isDenied) {
					Swal.fire('Submission Cancelled', '', 'info')
				}
			})
		});
	});
</script>

@endsection