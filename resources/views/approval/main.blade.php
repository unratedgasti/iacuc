@extends('layouts/index')
@section('content_body')
<div class="main">
	
	<div class="main-inner">

		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="widget" style="min-height: 500px;">
						
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>Protocol Approvals</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content" >
							@if(isset($_GET['response']))
								@if($_GET['response'] == 3)
								<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol # Updated</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>     
								@elseif($_GET['response'] == 4)
								<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Category Updated</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>     
								@else
								<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol Created</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>     
								@endif               
							@endif
							<br>
							<div align="center"><h3>FOR APPROVAL</h3></div>
							@if(in_array(1,getUserRole()) || in_array(4,getUserRole()))
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th> Protocol Number </th>
										<th> Category </th>
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
										<td> {{$p->category}} </td>
										<td> {{$p->name}} </td>
										<td> {{$p->protocol_name}}</td>
										<td> {{ date("m/d/Y", strtotime($p->date_created)) }}</td>
										<td style="text-align: center;"> {{$p->status}}</td>
										<td class="td-actions" style="text-align:center;width: 15%;">
										<!-- Modal -->
											<div class="modal fade" id="myModal{{$p->protocol_id}}" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">UPDATE PROTOCOL #</h4>
														</div>
														<div class="modal-body">
														{{ Form::open(array('url' => '/prf/updateProtocolNo', 'method' => 'post', 'class'=>'form-label-left')) }}
														<input type="hidden" name="text" id="text" value="Are you Sure to update Protocol #">
															<fieldset class="">
																<div class="control-group" id="check">											
																	<label class="control-label" for="firstname">Protocol # :</label>
																	<div class="controls">
																		<input type="hidden" name="protocol_id" id="protocol_id" value="{{$p->protocol_id}}">
																		<input type="text" class="form-control" id="protocol_no" name="protocol_no" required>
																		<label class="hidden" style="color:red" id="labelerror">* Protocol # is required</label>
																	</div> <!-- /controls -->			
																</div> <!-- /control-group -->
																<input type="hidden" name="update" id="text" value="1">
															</fieldset>
															
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" >Save</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
														{{ Form::close() }}
													</div>

												</div>
											</div>
											<div class="modal fade" id="category{{$p->protocol_id}}" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">UPDATE Category</h4>
														</div>
														<div class="modal-body">
														{{ Form::open(array('url' => '/prf/updateCategory', 'method' => 'post', 'class'=>'form-label-left')) }}
														<input type="hidden" name="text" id="text" value="Are you Sure to update Protocol #">
															<fieldset class="">
																<div class="control-group" id="check">											
																	<label class="control-label" for="firstname">Category :</label>
																	<div class="controls">
																		<input type="hidden" name="protocol_id" id="protocol_id" value="{{$p->protocol_id}}">
																		<input type="number" class="form-control" id="category" name="category" required>
																		<label class="hidden" style="color:red" id="labelerror">* Category is required</label>
																	</div> <!-- /controls -->			
																</div> <!-- /control-group -->
																<input type="hidden" name="update" id="text" value="1">
															</fieldset>
															
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" >Save</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
														{{ Form::close() }}
													</div>

												</div>
											</div>
												<div class="btn-group" role="group"	>
																							
												<button type="button" class="btn btn-success btn-medium dropdown-toggle" data-toggle="dropdown" style="margin-right: -20px;">
													Actions
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{{url('/approvals/review-prf/'.$p->protocol_id)}}" >VIEW</a></li>
													
													<li><a data-toggle="modal" data-target="#myModal{{$p->protocol_id}}">Update Protocol #</a></li>
													<li><a data-toggle="modal" data-target="#category{{$p->protocol_id}}">Update Category</a></li>
													
												</ul>
											</div>
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
							@elseif(in_array(3,getUserRole()) )

							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th> Protocol Number </th>
										<th> Category </th>
										<th> Primary Investigator </th>
										<th> Protocol Name</th>
										<th> Date Created</th>
										<th> Protocol Status</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
									@if(!$prfmain->isEmpty())
									@foreach($prfmain as $p)
									<tr>
										<td> {{$p->protocol_no}} </td>
										<td> {{$p->category}} </td>
										<td> {{$p->name}} </td>
										<td> {{$p->protocol_name}}</td>
										<td> {{ date("m/d/Y", strtotime($p->date_created)) }}</td>
										<td style="text-align: center;"> {{$p->status}}</td>
										<td class="td-actions" style="text-align:center;">
											<a href="{{url('/approvals/review-prf/'.$p->protocol_id)}}" class="btn btn-medium btn-success">VIEW</a>
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

							@endif
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
function protocolsubmit(){
	
	var text = $("#text").val();
			Swal.fire({
				title: text + ' ?',
				showDenyButton: true,
				confirmButtonText: `Submit`,
				denyButtonText: `No`,
			}).then((result) => {			
				if (result.isConfirmed) {
					if($('#protocol_no').val()){
					}else{
						$("#check").addClass('error');
						$("#labelerror").removeClass('hidden');
						swal.close();
					}
					


				} else if (result.isDenied) {
					Swal.fire('Submission Cancelled', '', 'info')
				}
			});
		

	}

	
	$(document).ready(function() {

		$( "#update_protocol" ).click(function() {
			protocolsubmit();
      });
	  $( "#add_protocol" ).click(function() {
		protocoladd();
      });
					
	});
</script>

@endsection