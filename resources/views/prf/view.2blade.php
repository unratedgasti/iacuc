@extends('/layouts/index')
@section('content_body')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<style type="text/css">
.table-responsive{
	width:100%;
	height:100%;
	overflow:auto;
}
</style>
<div class="main">
	
	<div class="main-inner">

		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="widget">
						
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>Protocol Details - {{$prf_details->protocol_no}}</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content">
							<div class="tabbable">
								
								<div class="tab-content">
									<div class="tab-pane active" id="protocol">

										<h4>I. PROTOCOL</h4>
										<br/>
										<fieldset>

												<!-- <div class="control-group">											
													<label class="control-label" for="username">Username</label>
													<div class="controls">
														<input type="text" class="span6 disabled" id="username" value="Example" disabled>
														<p class="help-block">Your username is for logging in and cannot be changed.</p>
													</div> 				
												</div> >
											-->
											<input type="hidden" id='prf_id' value='{{$prf_details->protocol_id}}'>
											<div class="control-group">											
												<label class="control-label" >Institute:</label>
												<div class="controls">
													<strong>{{$prf_details->description}}</strong>
												</div> <!-- /controls -->				
											</div>
											<br/>
											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name of protocol or procedure:</label>
												<div class="controls">
													<strong>{{$prf_details->protocol_name}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br/>

											<div class="control-group">											
												<label class="control-label" for="lastname">B. Title/s of research/study:</label>
												<div class="controls">
													@foreach($prf_rs as $value)
													<strong>{{$value->research_study}}</strong>
													<br/>
													@endforeach
												</div> <!-- /controls -->	

											</div> <!-- /control-group -->
											<br/>

											<div class="control-group">											
												<label class="control-label" for="email">C. Source/s of funding (if any):</label>
												<div class="controls">
													<strong>{{$prf_details->funding_source}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<br/>
											<div class="control-group">											
												<label class="control-label" for="lastname">D. Previous Protocol Review #:<br/></label>
												<div class="controls">
													@if($prf_details->prev_protocol==1)
													<strong>{{$prf_details->prev_protocol_no}}</strong>
													@endif
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br/>
											<div class="control-group">											
												<label class="control-label" >E. Purpose of protocol:</label>
												<div class="controls">
													<strong>{{$prf_details->purpose}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br/>
											<br/>
											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>II. OBJECTIVES/S:</h4></label>
												<div class="controls">
													<strong>{{$prf_details->objectives}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br/>
											<br/>
											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>III. DURATION:</h4></label>
												<div class="controls">
													<strong>{{date('m/d/Y', strtotime($prf_details->date_from))}} - {{date('m/d/Y', strtotime($prf_details->date_to))}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<br/>
											<br/>
											<h4> IV. PRINCIPAL INVESTIGATOR</h4>
											<br/>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name:</label>
												<div class="controls">
													<strong>{{$prf_details->inv_name}}</strong>
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" for="lastname">B. Qualifications: </label>
												<div class="controls">
													@foreach($prf_qualifications as $value)
													<strong>{{$value->qualification_desc}}</strong>
													<br/>
													@endforeach
												</div> <!-- /controls -->	

											</div>


											<div class="control-group">											
												<label class="control-label" for="firstname">C. Contact Information</label>
												<div class="controls">
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->
											<div style="margin-left: 20px!important;">
												<div class="control-group">											
													<label class="control-label" for="firstname">Email Address:</label>
													<div class="controls">
														<strong>{{$prf_details->email}}</strong>
													</div> <!-- /controls -->			
												</div> <!-- /control-group -->

												<div class="control-group">											
													<label class="control-label" for="firstname">Contact Number:</label>
													<div class="controls">
														<strong>{{$prf_details->contact_number}}</strong>

													</div> <!-- /controls -->			
												</div> <!-- /control-group -->
											</div>
											<br/>
											<br/>
											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>V. BACKGROUND AND SIGNIFICANCE OF THE PROCEDURE OR RESEARCH</h4></label>
												<div class="controls">

													<strong>{{$prf_details->background_significance}}</strong>

												</div> <!-- /controls -->				
											</div>

											<br/>
											<br/>
											<h4> VI. DESCRIPTION OF METHODOLOGIES/EXPERIMENTAL DESIGN</h4>
											<br/>
											<div class="control-group">
												<label class="control-label">A. Animals <br/><span>For protocols lasting more than one year, add separate rows for each year. The Number column should only reflect the number of animals that will be used for each year.</span></label>
												<div class="controls">
													<div style="overflow-x:auto!important;">
														<table class="table table-striped table-bordered" id="animal_table" style="width: 100%!important; table-layout:auto;" >
															<thead>
																<tr>
																	<th> Species</th>
																	<th> Strain</th>
																	<th> Source</th>
																	<th> Age</th>
																	<th> Weight</th>
																	<th> Sex</th>
																	<th> Number</th>
																</tr>
															</thead>
															<tbody>
																@foreach($prf_animals as $value)
																<tr>
																	<td style="text-align: center;" >{{$value->species}}</td>
																	<td style="text-align: center;">{{$value->strain}}</td>
																	<td style="text-align: center;">{{$value->source}}</td>
																	<td style="text-align: center;">{{$value->age}}</td>
																	<td style="text-align: center;">{{$value->weight}}</td>
																	<td style="text-align: center;">{{$value->sex}}</td>
																	<td style="text-align: center;">{{$value->number}}</td>
																</tr>												
																@endforeach
															</tbody>
														</table>
													</div>
												</div> <!-- /controls -->	

												<div class="control-group">											
													<label class="control-label">B. Basis for selecting animal species<br/></label>
													<div class="controls">

														<strong>{{$prf_details->basis_in_selecting}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br/>
												<div class="control-group">											
													<label class="control-label">C.	Quarantine and/or conditioning process<br/></label>
													<div class="controls">

														<strong>{{$prf_details->quarantine_conditioning}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br/>
												<div class="control-group">											
													<label class="control-label">D.	Animal care procedures<br/></label>
													<div class="controls">

													</div> <!-- /controls -->
													<br/>
													<div style="margin-left: 20px!important;">
														<label class="control-label">1.	Cage Type<br/></label>
														<div class="controls">

															<strong>{{$prf_details->cage_type}}</strong>
														</div> <!-- /controls -->
														<br/>
														<label class="control-label">2.	Number of animals per sex per cage<br/></label>
														<div class="controls">

															<strong>{{$prf_details->num_animals}}</strong>
														</div>
														<br/>
														<label class="control-label">3.	Identification<br/></label>
														<div class="controls">

															<strong>{{$prf_details->identification_animals}}</strong>
														</div>
														<br/>
														<label class="control-label">4.	Cage cleaning method<br/></label>
														<div class="controls">

															<strong>{{$prf_details->cage_cleaning}}</strong>
														</div>
														<br/>
														<label class="control-label">5.	Living Condition<br/></label>
														<div class="controls">

															<strong>{{$prf_details->living_condition}}</strong>
														</div>
														<br/>
														<label class="control-label">6. Animal diet, and feeding and watering method<br/></label>
														<div class="controls">

															<strong>{{$prf_details->animal_diet}}</strong>
														</div>
														<br/>
													</div>
												</div>

												<div class="control-group">											
													<label class="control-label">E.	Experimental or animal manipulation methods<br/></label>
													<div class="controls">

													</div> <!-- /controls -->
													<br/>
													<div style="margin-left: 20px!important;">
														<label class="control-label">1.	General description<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_desc}}</strong>
														</div>
														<br/>
														<label class="control-label">2.	Location<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_location}}</strong>
														</div>
														<br/>
														<label class="control-label">3.	Dosing<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_dosing}}</strong>
														</div>
														<br/>
														<label class="control-label">4. Specimen and/or biological agent collection<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_collection}}</strong>
														</div>
														<br/>
														<label class="control-label">5.	Animal examination procedure/s<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_examination}}</strong>
														</div>
														<br/>
														<label class="control-label">6.	Use of anesthetics<br/></label>
														<div class="controls">

															<strong>{{$prf_details->method_anesthetics}}</strong>
														</div>
														<br/>
														<label class="control-label">7.	Surgical procedure/s<br/>
														</label>
														<div class="controls">

															<strong>{{$prf_details->method_surgical}}</strong>
														</div>
														<br/>
														<label class="control-label">8.	Humane endpoints<br/></label>
														<div class="controls">

															<strong>{{$prf_details->humane_endpoint}}</strong>
														</div>
													</div>

												</div>
												<br/>

												<div class="control-group">											
													<label class="control-label">F.	Potential hazards<br/></label>
													<div class="controls">

														<strong>{{$prf_details->potential_hazards}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br />

												<div class="control-group">											
													<label class="control-label">G.	Waste disposal<br/></label>
													<div class="controls">

														<strong>{{$prf_details->waste_disposal}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br />
												<div class="control-group">		
													<label class="control-label">H.	Suitable alternatives<br/></label>
													<div class="controls">

														<strong>{{$prf_details->suitable_alternatives}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br />
												<div class="control-group">
													<label class="control-label">I. Other personnel<br/></label>
													<div class="controls">
														<div style="overflow-x:auto!important;">
															<table class="table table-striped table-bordered" id="personnel_table" style="width: 100%!important; table-layout:auto;" >
																<thead>
																	<tr>
																		<th> Name</th>
																		<th> Title</th>
																		<th> Role/s</th>
																		<th> Qualifications</th>
																		<th> Training and Vaccinations</th>


																	</tr>
																</thead>
																<tbody>
																	@foreach($prf_personnel as $value)
																	<tr>
																		<td style="text-align: center;" >{{$value->name}}</td>
																		<td style="text-align: center;">{{$value->title}}</td>
																		<td style="text-align: center;"> {{$value->roles}}</td>
																		<td style="text-align: center;">{{$value->qualification}}</td>
																		<td style="text-align: center;">{{$value->training_vacc}}</td>
																		
																	</tr>												
																	@endforeach
																</tbody>
															</table>
														</div>
													</div> <!-- /controls -->	

												</div>
												<br/>

												<div class="control-group">											
													<label class="control-label" for="firstname"><h4>VII. References</h4></label>
													<div class="controls">

														<strong>{{$prf_details->other_reference}}</strong>
													</div> <!-- /controls -->				
												</div>
												<br />

											</fieldset>
										</div>










										@if(isinvestigator())
										<div class="form-actions">
											<a href="{{url('/prf/edit-prf/'.$prf_details->protocol_id)}}" class="btn btn-medium btn-success">EDIT</a>
											<input type="button" class="btn btn-medium btn-primary" id="submit_prf" value="SUBMIT">
										</div> <!-- /form-actions -->
										@endif
									</div>
								</div>
							</div> <!-- /widget-content -->
							{{ Form::close() }}
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

	<script type="text/javascript">

		$(document).ready(function() {

			$( "#submit_prf" ).click(function() {
				Swal.fire({
					title: 'Are you sure you want to submit this PRF for approval?',
					showDenyButton: true,
					confirmButtonText: `Submit`,
					denyButtonText: `No`,
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						var id=$('#prf_id').val();
						
						$.ajax({
							
							type:'POST',
							url:'{{url("/prf/submit")}}',
							dataType: "json",
							data: { 
								'protocol_id': id,
								'_token' : '<?php echo csrf_token() ?>'
							},
							success:function(html) {
          // alert(html);
          Swal.fire(
          	'PRF Submitted', '', 'success'
          	).then(function(html) {
          		location.href = '{{url("/prf")}}';
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