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
							<h3>Approved Protocol</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content">
							@if(isset($_GET['response']))
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>PRF Duration updated.</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>                    
							@endif
							<br>
							 <!-- <div align="center"><h3>FOR APPROVAL</h3></div> -->
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
										<td class="td-actions" >
												<div class="btn-group" role="group"	>
																								
													<button type="button" class="btn btn-success btn-medium dropdown-toggle" data-toggle="dropdown" style="margin-right: 20px;">
														Actions
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="{{url('/approved/review/'.$p->protocol_id)}}" >VIEW</a></li>
														
														<li><a data-toggle="modal" data-target="#myModal{{$p->protocol_id}}">Update Duration</a></li>
														
													</ul>
												</div>
										</td>
									</tr>

									<div class="modal fade" id="myModal{{$p->protocol_id}}" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">UPDATE PRF Duration</h4>
														</div>
														<div class="modal-body">
														{{ Form::open(array('url' => '/prf/updateDuration', 'method' => 'post', 'class'=>'form-label-left')) }}
												
															<fieldset class="">
																<div class="control-group" id="check">											
																	<label class="control-label" for="firstname">PRF Duration :</label>
																	<div class="controls">
																		<input type="hidden" name="protocol_id" id="protocol_id" value="{{$p->protocol_id}}">
																		From:&nbsp;&nbsp;<input type='text' class="form-control span2 datepicker date_from" name="date_from" value="{{date('m/d/Y', strtotime($p->date_from))}}" />&nbsp;&nbsp;To:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker date_to" name="date_to" value="{{date('m/d/Y', strtotime($p->date_to))}}" />
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
									@endforeach
									@else

									<tr>
										<td colspan="6" style="text-align: center;">No Data Found</td>
									</tr>
									@endif
								
									
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    startDate: "01-01-2015",
    endDate: "01-01-2020",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    container: '#myModal modal-body'
  });
</script>
@endsection

