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
							<h3>Edit Protocol - {{$prf_details->protocol_no}}</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/prf/update-prf/'.$prf_details->protocol_id, 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=>'form-label-left')) }}
						<div class="widget-content">
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
													<select class="form-control" name="institute_id"  readonly required>
														@foreach($units as $value)                      
														<option value="{{$value->id}}" {{  $prf_details->institute_id==$value->id ? 'selected': ''  }}>{{$value->description}}</option>
														@endforeach
													</select>
												</div> <!-- /controls -->				
											</div>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name of protocol or procedure:</label>
												<div class="controls">
													<input type="text" class="form-control span6" id="protocol_name" name="protocol_name" value="{{$prf_details->protocol_name}}">
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">B. Title/s of research/study:</label>
												<div class="controls">
													@foreach($prf_rs as $value)
													<input type="text" class="form-control span6" name="rstudy[]" value="{{$value->research_study}}">
													@endforeach
													<br/>

													<button class="btn" id="add_rs" style="margin-left:200px; margin-top:10px;">Add More Fields</button>
												</div> <!-- /controls -->	

											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="email">C. Source/s of funding (if any):</label>
												<div class="controls">
													<textarea class="form-control span6" name="funding_source" rows="3">{{$prf_details->funding_source}}</textarea>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">D. Previous Protocol Review #:<br/><span>If protocol is for the renewal of a previously approved protocol, provide the Protocol Review # of said protocol.</span></label>
												<div class="controls">
													<input type="text" class="span6" name="prev_protocol_no" value="{{$prf_details->prev_protocol_no}}">
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" >E. Purpose of protocol:</label>
												<div class="controls">
													<select class="form-control" readonly name="purpose">
														<option value="RESEARCH" {{  isset($prf_details)  ? $prf_details->purpose=='RESEARCH' ? 'selected': ' '  : ' '  }}>RESEARCH</option>
														<option value="TEACHING" {{  isset($prf_details)  ? $prf_details->purpose=='TEACHING' ? 'selected': ' '  : ' '  }}>TEACHING</option>
													</select>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<br />


										</fieldset>
									</div>


									<div class="tab-pane" id="objectives">
										<fieldset>



											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>II. OBJECTIVES/S:</h4></label>
												<div class="controls">

													<textarea class="form-control span6"  name="objectives" rows="3">{{$prf_details->objectives}}</textarea>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->




											<br />

											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>III. DURATION:</h4></label>
												<div class="controls">

													From:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker" name="date_from" value="{{date('m/d/Y', strtotime($prf_details->date_from))}}" />&nbsp;&nbsp;TO:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker" name="date_to" value="{{date('m/d/Y', strtotime($prf_details->date_to))}}" />
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br />



										</fieldset>
									</div>


									<div class="tab-pane" id="pi">

										<h4> IV. PRINCIPAL INVESTIGATOR</h4>
										<br/>
										<fieldset>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name:</label>
												<div class="controls">
													<input type="text" class="form-control span6" readonly name="investigator_name" value="{{$prf_details->inv_name}}">
													<input type="hidden" name="invest_id" value="{{Auth::user()->id}}">
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" for="lastname">B. Qualifications: </label>
												<div class="controls">
													@foreach($prf_qualifications as $value)
													<input type="text" class="form-control span6" name="qual[]" value="{{$value->qualification_desc}}">
													@endforeach
													<br/>
													<button class="btn" id="add_q" style="margin-left:200px; margin-top:10px;">Add More Fields</button>
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
													<input type="text" class="form-control span6" readonly name="email" readonly value="{{$prf_details->email}}">
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" for="firstname">Contact Number:</label>
												<div class="controls">
													<input type="text" class="form-control span6" readonly name="contact_number" readonly value="{{$prf_details->contact_number}}">

												</div> <!-- /controls -->			
											</div> <!-- /control-group -->


											<br />

											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>V. BACKGROUND AND <br />SIGNIFICANCE OF THE <br />PROCEDURE OR RESEARCH:</h4><span>Include a description of the biomedical characteristics of the animals which are essential to the proposed procedure/research and indicate evidence of experiences with the proposed animal model.</span></label>
												<div class="controls">

													<textarea class="form-control span6"  name="background_significance" rows="8">{{$prf_details->background_significance}}</textarea>
												</div> <!-- /controls -->				
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
																	<th class="td-actions"> </th>
																</tr>
															</thead>
															<tbody>
																@foreach($prf_animals as $value)
																<tr>
																	<td style="text-align: center;" > <input type="text" class="form-control" name="species[]" value="{{$value->species}}" style="width:150px;"/></td>
																	<td style="text-align: center;"><input type="text" class="form-control" name="strain[]" value="{{$value->strain}}" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="source[]" value="{{$value->source}}" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="age[]" value="{{$value->age}}" style="width:50px;"/> </td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="weight[]" value="{{$value->weight}}" style="width:50px;"/> </td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="sex[]" value="{{$value->sex}}" style="width:50px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="number[]" value="{{$value->number}}" style="width:50px;"/></td>
																	<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
																</tr>												
																@endforeach
															</tbody>
														</table>
													</div>
												</div> <!-- /controls -->	



												<div align="center">
													<input type="button" class="btn btn-success"  id="add_animal" value="ADD ANIMAL" />
												</div>

											</div> <!-- /control-group -->
											<br/>

											<div class="control-group">											
												<label class="control-label">B. Basis for selecting animal species<br/><span>Give the reason/s for the use of the animals and justify the number of animals that will be used.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="basis_in_selecting" rows="4">{{$prf_details->basis_in_selecting}}</textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

											<div class="control-group">											
												<label class="control-label">C.	Quarantine and/or conditioning process<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="quarantine_conditioning" rows="4">{{$prf_details->quarantine_conditioning}}</textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

											<div class="control-group">											
												<label class="control-label">D.	Animal care procedures<br/></label>
												<div class="controls">

												</div> <!-- /controls -->

												<label class="control-label">1.	Cage Type<br/><span>Give the type, material, and dimensions of the cage that will house the animals.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="cage_type" rows="3">{{$prf_details->cage_type}}</textarea>
												</div> <!-- /controls -->

												<label class="control-label">2.	Number of animals per sex per cage<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="num_animals" rows="3">{{$prf_details->num_animals}}</textarea>
												</div>

												<label class="control-label">3.	Identification<br/><span>Indicate how each individual animal will be identified from one another.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="identification_animals" rows="3">{{$prf_details->identification_animals}}</textarea>
												</div>

												<label class="control-label">4.	Cage cleaning method<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="cage_cleaning" rows="3">{{$prf_details->cage_cleaning}}</textarea>
												</div>

												<label class="control-label">5.	Living Condition<br/><span>Include where the animals will be housed, the room temperature, humidity, ventilation, and lighting.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="living_condition" rows="3">{{$prf_details->living_condition}}</textarea>
												</div>

												<label class="control-label">6. Animal diet, and feeding and watering method<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="animal_diet" rows="3">{{$prf_details->animal_diet}}</textarea>
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

													<textarea class="form-control span11"  name="method_desc" rows="3">{{$prf_details->method_desc}}</textarea>
												</div>

												<label class="control-label">2.	Location<br/><span>Indicate where the animal manipulation method will be performed.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_location" rows="3">{{$prf_details->method_location}}</textarea>
												</div>

												<label class="control-label">3.	Dosing<br/><span>Include the frequency, volume, route, method of restraint and expected outcome or effects.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_dosing" rows="3">{{$prf_details->method_dosing}}</textarea>
												</div>

												<label class="control-label">4. Specimen and/or biological agent collection<br/><span>Include the frequency, volume, route, and method of restraint for each specimen and/or biological agent that will be collected.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_collection" rows="3">{{$prf_details->method_collection}}</textarea>
												</div>

												<label class="control-label">5.	Animal examination procedure/s<br/><span>Include the frequency of examinations and the method of restraint.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_examination" rows="3">{{$prf_details->method_examination}}</textarea>
												</div>

												<label class="control-label">6.	Use of anesthetics<br/><span>Include the drug, dosage, and frequency.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_anesthetics" rows="3">{{$prf_details->method_anesthetics}}</textarea>
												</div>

												<label class="control-label">7.	Surgical procedure/s<br/><span>If the protocol involves any surgical procedure, include the following information:</span><br/><span>a.	Place where surgery will be performed</span><br/><span>b.	Description of supportive care and monitoring procedures during and after surgery</span><br/><span>c.	Description of measures for possible post-surgical complications</span>	<br/><span>d.	Name of all participating surgeons and their qualifications and relevant experience</span>
												</label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_surgical" rows="4">{{$prf_details->method_surgical}}</textarea>
												</div>

												<label class="control-label">8.	Humane endpoints<br/><span>Describe the plan for monitoring pain, discomfort, or distress during and after the procedure. If animals will be euthanized, include the method that will be used.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="humane_endpoint" rows="3">{{$prf_details->humane_endpoint}}</textarea>
												</div>


											</div>
											<br />




											<div class="control-group">											
												<label class="control-label">F.	Potential hazards<br/><span>Include any potential hazards for the animals and the personnel involved as well as preventive measures to avoid hazards.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="potential_hazards" rows="4">{{$prf_details->potential_hazards}}</textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

											<div class="control-group">											
												<label class="control-label">G.	Waste disposal<br/><span>Describe how animal carcasses and other wastes generated by the procedure will be disposed of.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="waste_disposal" rows="4">{{$prf_details->waste_disposal}}</textarea>
												</div> <!-- /controls -->				
											</div>
											<br />
											<div class="control-group">		
												<label class="control-label">H.	Suitable alternatives<br/><span>Is there a non-animal model applicable for the procedure/study? If so, please provide the reasons for not using it.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="suitable_alternatives" rows="4">{{$prf_details->waste_disposal}}</textarea>
												</div> <!-- /controls -->				
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

																	<th class="td-actions"> </th>
																</tr>
															</thead>
															<tbody>
																@foreach($prf_personnel as $value)
																<tr>
																	<td style="text-align: center;" > <input type="text" class="form-control" name="name[]" value="{{$value->name}}" style="width:150px;"/></td>
																	<td style="text-align: center;"><input type="text" class="form-control" name="title[]" value="{{$value->title}}" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="roles[]" value="{{$value->roles}}" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="qualification[]" value="{{$value->qualification}}" style="width:50px;"/> </td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="training_vacc[]" value="{{$value->training_vacc}}" style="width:50px;"/> </td>
																	<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
																</tr>
																@endforeach											

															</tbody>
														</table>
													</div>
												</div> <!-- /controls -->	



												<div align="center">
													<input type="button" class="btn btn-success"  id="add_personnel" value="ADD PERSONNEL" />
												</div>

											</div> <!-- /control-group -->
										</fieldset>
									</div>



									<div class="tab-pane" id="reference">


										<fieldset>


											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>VII. References</h4><span>List all the reference materials used for this protocol</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="other_reference" rows="8">{{$prf_details->other_reference}}</textarea>
												</div> <!-- /controls -->				
											</div>
											<br />


										</fieldset>

									</div>





									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save</button> 
										<button class="btn">Cancel</button>
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

		$( function() {
			$( ".datepicker" ).datepicker();
		} );

	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".controls"); //Fields wrapper
	var add_button_rs      = $("#add_rs");
	var add_button_q      = $("#add_q"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button_rs).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).find('button[id="add_rs"]').before('<div><input type="text" class="form-control span6" style="margin-top:10px;" name="rstudy[]"/>&nbsp;&nbsp;&nbsp;<a href="#" class="remove_field">Remove</a><br/></div>');
		 //add input box
		}
	});

	var y = 1; //initlal text box count
	$(add_button_q).click(function(e){ //on add input button click
		e.preventDefault();
		if(y < max_fields){ //max input box allowed
			y++; //text box increment
			$(wrapper).find('button[id="add_q"]').before('<div><input type="text" class="form-control span6" style="margin-top:10px" name="qual[]"/>&nbsp;&nbsp;&nbsp;<a href="#" class="remove_field">Remove</a><br/></div>');
		 //add input box
		}
	});


	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})


	$("#add_animal").click(function(){

		var markup = "<tr><td style='text-align: center;' > <input type='text' class='form-control' name='species[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'><input type='text' class='form-control' name='strain[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='source[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='age[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <input type='text' class='form-control' name='weight[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <input type='text' class='form-control' name='sex[]' value='' style='width:50px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='number[]' value='' style='width:50px;'/></td>																<td class='td-actions' style='text-align: center;'><button type='button' class='btn btn-danger btn-small rem' title='Remove row'><i class='btn-icon-only icon-remove'> </i></button></td>															</tr>;";
		$("#animal_table tbody").append(markup);
	});

	$("#add_personnel").click(function(){
		

		var markup = "<tr><td style='text-align: center;' > <input type='text' class='form-control' name='name[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'><input type='text' class='form-control' name='title[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='roles[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='qualification[]' value='' style='width:50px;'/> </td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='training_vacc[]' value='' style='width:50px;'/> </td>													<td class='td-actions' style='text-align: center;'><button type='button' class='btn btn-danger btn-small rem' title='Remove row'><i class='btn-icon-only icon-remove'> </i></button></td>															</tr>;";
		$("#personnel_table tbody").append(markup);
	});

	$(document).on('click', 'button.rem', function () {
		$(this).closest('tr').remove();
		return false;
	});


});
</script>

@endsection