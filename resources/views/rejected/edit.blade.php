@extends('layouts/index')
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
							<h3>Review Protocol - {{$review_details->review_status}}</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/approvals/update-review/'.$prf_details->protocol_id, 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=>'form-label-left')) }}
						<input type="hidden" id="review_id" value="{{$review_details->id}}">
						<input type="hidden" id="prf_id" value="{{$prf_details->protocol_id}}">
						
						
						<div class="widget-content">
							@if(session('status'))
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>{{ session('status') }}</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>                    
							@endif
							<div align="center" style="padding:10px">
								<span class="pull-right">
								<strong><a href="{{url('/approvals/generate-forms/'.$prf_details->protocol_id)}}" style="color:rgb(0, 132, 255);">GENERATE FORM</a></strong>
							</span>
							</div>
							<br/>
							
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#protocol" data-toggle="tab">PROTOCOL</a>
									</li>
									<li>
										<a href="#objectives" data-toggle="tab">OBJECTIVE/S AND DURATION</a>
									</li>
									

									<li>
										<a href="#pi" data-toggle="tab">INVESTIGATOR AND BACKGROUND</a>
									</li>

									<li>
										<a href="#description" data-toggle="tab">DESCRIPTION OF METHODOLOGY</a>
									</li>

									<li>
										<a href="#reference" data-toggle="tab">REFERENCE</a>
									</li>

								<!-- <li>
									<a href="#formcontrols" data-toggle="tab">Form Controls</a>
								</li>
								<li><a href="#jscontrols" data-toggle="tab">JS Controls</a></li> -->
							</ul>

							<br>

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

											<div class="control-group">											
												<label class="control-label" >Institute:</label>
												<div class="controls">
													<strong>{{$prf_details->description}}</strong>
												</div> <!-- /controls -->				
											</div>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name of protocol or procedure:</label>
												<div class="controls">
													<strong>{{$prf_details->protocol_name}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">B. Title/s of research/study:</label>
												<div class="controls">
													@foreach($prf_rs as $value)
													<strong>{{$value->research_study}}</strong>
													@endforeach
													<br/>

													
												</div> <!-- /controls -->	

											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="email">C. Source/s of funding (if any):</label>
												<div class="controls">
													<strong>{{$prf_details->funding_source}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">D. Previous Protocol Review #:<br/><span>If protocol is for the renewal of a previously approved protocol, provide the Protocol Review # of said protocol.</span></label>
												<div class="controls">
													<strong>{{$prf_details->prev_protocol_no}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" >E. Purpose of protocol:</label>
												<div class="controls">
													<strong>{{$prf_details->purpose}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<br /> 
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="protocol_comments" rows="8">{{$review_details->protocol_comments}}</textarea>
												</div>
											</div>
										</fieldset>
									</div>


									<div class="tab-pane" id="objectives">
										<fieldset>



											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>II. OBJECTIVES/S:</h4></label>
												<div class="controls">

													<strong>{{$prf_details->objectives}}</strong>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="objectives_comments" rows="8">{{$review_details->objectives_comments}}</textarea>
												</div>
											</div>
										</br>

										<div class="control-group">											
											<label class="control-label" for="firstname"><h4>III. DURATION:</h4></label>
											<div class="controls">

												From:&nbsp;&nbsp; <strong>{{date('m/d/Y', strtotime($prf_details->date_from))}}</strong>&nbsp;&nbsp;TO:&nbsp;&nbsp;<strong>{{date('m/d/Y', strtotime($prf_details->date_to))}}</strong>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="duration_comments" rows="8">{{$review_details->duration_comments}}</textarea>
											</div>
										</div>
										<br />



									</fieldset>
								</div>


								<div class="tab-pane" id="pi">

									<h4> IV. PRINSIPAL INVESTIGATOR</h4>
									<br/>
									<fieldset>

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
												@endforeach
												<br/>

											</div> <!-- /controls -->	

										</div>


										<div class="control-group">											
											<label class="control-label" for="firstname">C. Contact Information</label>
											<div class="controls">
											</div> <!-- /controls -->			
										</div> <!-- /control-group -->

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
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="investigator_comments" rows="8">{{$review_details->investigator_comments}}</textarea>
											</div>
										</div>
										<br />

										<div class="control-group">											
											<label class="control-label" for="firstname"><h4>V. BACKGROUND AND <br />SIGNIFICANCE OF THE <br />PROCEDURE OR RESEARCH:</h4><span>Include a description of the biomedical characteristics of the animals which are essential to the proposed procedure/research and indicate evidence of experiences with the proposed animal model.</span></label>
											<div class="controls">

												<strong>{{$prf_details->background_significance}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="background_comments" rows="8">{{$review_details->background_comments}}</textarea>
											</div>
										</div>
										<br />


									</fieldset>

								</div>

								<div class="tab-pane" id="description" >

									<fieldset>
										<h4> VI. DESCRIPTION OF METHODOLOGIES/EXPERIMENTAL DESIGN</h4>
										<span>This section should establish that the proposed procedure is well designed scientifically and ethically.</span>
										<br/>
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
																<td style="text-align: center;" > <strong>{{$value->species}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->strain}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->source}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->age}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->weight}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->sex}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->number}}</strong></td>

															</tr>												
															@endforeach
														</tbody>
													</table>
												</div>
											</div> <!-- /controls -->	


										</div> <!-- /control-group -->
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="animals_comments" rows="8">{{$review_details->animals_comments}}</textarea>
											</div>
										</div>
										<br/>

										<div class="control-group">											
											<label class="control-label">B. Basis for selecting animal species<br/><span>Give the reason/s for the use of the animals and justify the number of animals that will be used.</span></label>
											<div class="controls">

												<strong>{{$prf_details->basis_in_selecting}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="basis_comments" rows="8">{{$review_details->basis_comments}}</textarea>
											</div>
										</div>
										<br />

										<div class="control-group">											
											<label class="control-label">C.	Quarantine and/or conditioning process<br/></label>
											<div class="controls">

												<strong>{{$prf_details->quarantine_conditioning}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="quarantine_comments" rows="8">{{$review_details->quarantine_comments}}</textarea>
											</div>
										</div>
										<br />

										<div class="control-group">											
											<label class="control-label">D.	Animal care procedures<br/></label>
											<div class="controls">

											</div> <!-- /controls -->

											<label class="control-label">1.	Cage Type<br/><span>Give the type, material, and dimensions of the cage that will house the animals.</span></label>
											<div class="controls">

												<strong>{{$prf_details->cage_type}}</strong>
											</div> <!-- /controls -->
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="cage_comments" rows="4">{{$review_details->cage_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">2.	Number of animals per sex per cage<br/></label>
											<div class="controls">

												<strong>{{$prf_details->num_animals}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="numanimals_comments" rows="4">{{$review_details->numanimals_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">3.	Identification<br/><span>Indicate how each individual animal will be identified from one another.</span></label>
											<div class="controls">

												<strong>{{$prf_details->identification_animals}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="identification_comments" rows="4">{{$review_details->identification_comments}}</textarea>
												</div>
											</div>
											<label class="control-label">4.	Cage cleaning method<br/></label>
											<div class="controls">

												<strong>{{$prf_details->cage_cleaning}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="cageclean_comments" rows="4">{{$review_details->cageclean_comments}}</textarea>
												</div>
											</div>
											<label class="control-label">5.	Living Condition<br/><span>Include where the animals will be housed, the room temperature, humidity, ventilation, and lighting.</span></label>
											<div class="controls">

												<strong>{{$prf_details->living_condition}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="living_comments" rows="4">{{$review_details->living_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">6. Animal diet, and feeding and watering method<br/></label>
											<div class="controls">

												<strong>{{$prf_details->animal_diet}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="diet_comments" rows="4">{{$review_details->diet_comments}}</textarea>
												</div>
											</div>
										</div>
										<br />
										<br />
										<div class="control-group">											
											<label class="control-label">E.	Experimental or animal manipulation methods<br/></label>
											<div class="controls">

											</div> <!-- /controls -->

											<label class="control-label">1.	General description<br/><span>Give a description of the methods of animal manipulation that will be used including the method of conditioning.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_desc}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="general_comments" rows="4">{{$review_details->general_comments}}</textarea>
												</div>
											</div>
											<label class="control-label">2.	Location<br/><span>Indicate where the animal manipulation method will be performed.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_location}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="location_comments" rows="4">{{$review_details->location_comments}}</textarea>
												</div>
											</div>
											<label class="control-label">3.	Dosing<br/><span>Include the frequency, volume, route, method of restraint and expected outcome or effects.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_dosing}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="dosing_comments" rows="4">{{$review_details->dosing_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">4. Specimen and/or biological agent collection<br/><span>Include the frequency, volume, route, and method of restraint for each specimen and/or biological agent that will be collected.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_collection}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="collection_comments" rows="4">{{$review_details->collection_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">5.	Animal examination procedure/s<br/><span>Include the frequency of examinations and the method of restraint.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_examination}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="examination_comments" rows="4">{{$review_details->examination_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">6.	Use of anesthetics<br/><span>Include the drug, dosage, and frequency.</span></label>
											<div class="controls">

												<strong>{{$prf_details->method_anesthetics}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="anesthetics_comments" rows="4">{{$review_details->anesthetics_comments}}</textarea>
												</div>
											</div>

											<label class="control-label">7.	Surgical procedure/s<br/><span>If the protocol involves any surgical procedure, include the following information:</span><br/><span>a.	Place where surgery will be performed</span><br/><span>b.	Description of supportive care and monitoring procedures during and after surgery</span><br/><span>c.	Description of measures for possible post-surgical complications</span>	<br/><span>d.	Name of all participating surgeons and their qualifications and relevant experience</span>
											</label>
											<div class="controls">

												<strong>{{$prf_details->method_surgical}}</strong>
											</div>
											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="surgical_comments" rows="4">{{$review_details->surgical_comments}}</textarea>
												</div>
											</div>
											<label class="control-label">8.	Humane endpoints<br/><span>Describe the plan for monitoring pain, discomfort, or distress during and after the procedure. If animals will be euthanized, include the method that will be used.</span></label>
											<div class="controls">

												<strong>{{$prf_details->humane_endpoint}}</strong>
											</div>

											<div class="control-group">	
												<label class="control-label" for="email"><strong>COMMENTS</strong></label>
												<div class="controls">
													<textarea class="form-control span10"  name="humane_comments" rows="4">{{$review_details->humane_comments}}</textarea>
												</div>
											</div>


										</div>
										<br />




										<div class="control-group">											
											<label class="control-label">F.	Potential hazards<br/><span>Include any potential hazards for the animals and the personnel involved as well as preventive measures to avoid hazards.</span></label>
											<div class="controls">

												<strong>{{$prf_details->potential_hazards}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="hazards_comments" rows="4">{{$review_details->hazards_comments}}</textarea>
											</div>
										</div>
										<br />

										<div class="control-group">											
											<label class="control-label">G.	Waste disposal<br/><span>Describe how animal carcasses and other wastes generated by the procedure will be disposed of.</span></label>
											<div class="controls">

												<strong>{{$prf_details->waste_disposal}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="disposal_comments" rows="4">{{$review_details->disposal_comments}}</textarea>
											</div>
										</div>
										<br />
										<div class="control-group">		
											<label class="control-label">H.	Suitable alternatives<br/><span>Is there a non-animal model applicable for the procedure/study? If so, please provide the reasons for not using it.</span></label>
											<div class="controls">

												<strong>{{$prf_details->suitable_alternatives}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="alternative_comments" rows="4">{{$review_details->alternative_comments}}</textarea>
											</div>
										</div>
										<br />
										<div class="control-group">
											<label class="control-label">I. Other personnel<br/><span>Add more rows if necessary.</span></label>
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
																<td style="text-align: center;" ><strong>{{$value->name}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->title}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->roles}}</strong></td>
																<td style="text-align: center;"><strong>{{$value->qualification}}</strong> </td>
																<td style="text-align: center;"><strong>{{$value->training_vacc}}</strong></td>

															</tr>
															@endforeach											

														</tbody>
													</table>
												</div>
											</div> <!-- /controls -->	

										</div> <!-- /control-group -->
									</fieldset>
									<div class="control-group">	
										<label class="control-label" for="email"><strong>COMMENTS</strong></label>
										<div class="controls">
											<textarea class="form-control span10"  name="personnel_comments" rows="4">{{$review_details->personnel_comments}}</textarea>
										</div>
									</div>
								</div>



								<div class="tab-pane" id="reference">


									<fieldset>


										<div class="control-group">											
											<label class="control-label" for="firstname"><h4>VII. References</h4><span>List all the reference materials used for this protocol</span></label>
											<div class="controls">

												<strong>{{$prf_details->other_reference}}</strong>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">	
											<label class="control-label" for="email"><strong>COMMENTS</strong></label>
											<div class="controls">
												<textarea class="form-control span10"  name="references_comments" rows="4">{{$review_details->references_comments}}</textarea>
											</div>
										</div>
										<br />


									</fieldset>

								</div>



								<div class="form-actions" align="center">
									<button type="submit" class="btn btn-primary" style="">Save it for later</button>&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-danger" id="return">Return to Investigator</button> &nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-success" id="approve">Approve</button> 
								</div> <!-- /form-actions -->
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

		$( "#return" ).click(function() {
			Swal.fire({
				title: 'Are you sure want to return this to the investigator?',
				showDenyButton: true,
				confirmButtonText: `Submit`,
				denyButtonText: `No`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var id=$('#prf_id').val();
					var rev_id=$('#review_id').val();

					$.ajax({

						type:'POST',
						url:'{{url("/approvals/return")}}',
						dataType: "json",
						data: { 
							'protocol_id': id,
							'review_id':rev_id,
							'_token' : '<?php echo csrf_token() ?>'
						},
						success:function(html) {
          // alert(html);
          Swal.fire(
          	'PRF Returned to Investigator', '', 'success'
          	).then(function() {
          		location.href = '{{url("/approvals")}}';
          	});

          }
      });

				} else if (result.isDenied) {
					Swal.fire('Submission Cancelled', '', 'info')
				}
			})
		});


		$( "#approve" ).click(function() {
			Swal.fire({
				title: 'Are you sure want to approve this PRF?',
				showDenyButton: true,
				confirmButtonText: `Yes`,
				denyButtonText: `No`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var id=$('#prf_id').val();
					var rev_id=$('#review_id').val();

					$.ajax({

						type:'POST',
						url:'{{url("/approvals/approve")}}',
						dataType: "json",
						data: { 
							'protocol_id': id,
							'review_id':rev_id,
							'_token' : '<?php echo csrf_token() ?>'
						},
						success:function(html) {
          // alert(html);
          Swal.fire(
          	'PRF Approved', '', 'success'
          	).then(function() {
          		location.href = '{{url("/approvals")}}';
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