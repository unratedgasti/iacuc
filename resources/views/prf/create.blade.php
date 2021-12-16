@extends('layouts/index')
@section('content_body')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<style type="text/css">
.table-responsive{
	width:100%;
	height:100%;
}

.animal_table > .table {
    margin-bottom: 0;
}
.animal_table > .table > thead > tr > th, .animal_table > .table > tbody > tr > th, .animal_table > .table > tfoot > tr > th, .animal_table > .table > thead > tr > td, .animal_table > .table > tbody > tr > td, .animal_table > .table > tfoot > tr > td {
    white-space: nowrap;
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
							<h3>Create Protocol</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content hidden" id="check" style="border-color: red;">
							<label style="color:red;font-weight: bold;">Some fields are required. Check each tab to make sure you filled out every required field.</label>
						</div>
						{{ Form::open(array('url' => '/prf/create-prf/store', 'method' => 'post', 'id' => 'myForm', 'enctype' => 'multipart/form-data', 'class'=>'form-label-left')) }}
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
													<select class="form-control" name="institute_id" required>
														@foreach($units as $value)                      
														<option value="{{$value->id}}">{{$value->description}}</option>
														@endforeach
													</select>
												</div> <!-- /controls -->				
											</div>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name of protocol or procedure:</label>
												<div class="controls">
													<input type="text" class="form-control span6" id="protocol_name" name="protocol_name" value="">
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">B. Title/s of research/study:</label>
												<div class="controls">
													<input type="text" class="form-control span6" name="rstudy[]" value="">
													<br/>
													<button class="btn" id="add_rs" style="margin-left:200px; margin-top:10px;">Add More Fields</button>
												</div> <!-- /controls -->	

											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="email">C. Source/s of funding (if any):</label>
												<div class="controls">
													<textarea class="form-control span6" name="funding_source" rows="3"></textarea>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<div class="control-group">											
												<label class="control-label" for="lastname">D. Previous Protocol Review #:<br/><span>If protocol is for the renewal of a previously approved protocol, provide the Protocol Review # of said protocol.</span></label>
												<div class="controls">
													<input type="text" class="span6" name="prev_protocol_no" value="">
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" >E. Purpose of protocol:</label>
												<div class="controls">
													<select class="form-control" name="purpose">
														<option value="RESEARCH">RESEARCH</option>
														<option value="TEACHING">TEACHING</option>
													</select>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->


											<br />
											
										<div class="form-actions">
										<input type="submit" class="btn btn-medium btn-primary" name="submit"  value="Save as Draft">	
										<input type="submit" class="btn btn-medium btn-primary hidden" name="submit" id="triggerSubmit" value="SUBMIT">											
											<input type="submit" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT" >
											<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
										</div> <!-- /form-actions -->

										</fieldset>
									</div>


									<div class="tab-pane" id="objectives">
										<fieldset>



											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>II. OBJECTIVES/S:</h4></label>
												<div class="controls">

													<textarea class="form-control span6"  name="objectives" rows="3"></textarea>
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->




											<br />

											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>III. DURATION:</h4></label>
												<div class="controls">

													From:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker date_from" name="date_from" autocomplete="off" value="" />&nbsp;&nbsp;TO:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker date_to" name="date_to" value="" autocomplete="off" />
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<br />



										</fieldset>
											
										<div class="form-actions">
											<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
											<input type="submit" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT" >
										<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
										</div> <!-- /form-actions -->
									</div>


									<div class="tab-pane" id="pi">

										<h4> IV. PRINCIPAL INVESTIGATOR</h4>
										<br/>
										<fieldset>

											<div class="control-group">											
												<label class="control-label" for="firstname">A. Name:</label>
												<div class="controls">
													<input type="text" class="form-control span6" name="investigator_name" readonly value="{{Auth::user()->name}}">
													<input type="hidden" name="invest_id" value="{{Auth::user()->id}}">
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" for="lastname">B. Qualifications: </label>
												<div class="controls">
													<input type="text" class="form-control span6" name="qual[]" value="">
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
													<input type="text" class="form-control span6" readonly name="email" value="{{Auth::user()->email}}">
												</div> <!-- /controls -->			
											</div> <!-- /control-group -->

											<div class="control-group">											
												<label class="control-label" for="firstname">Contact Number:</label>
												<div class="controls">
													<input type="text" class="form-control span6" readonly name="contact_number" value="{{Auth::user()->contact_number}}">

												</div> <!-- /controls -->			
											</div> <!-- /control-group -->


											<br />

											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>V. BACKGROUND AND <br />SIGNIFICANCE OF THE <br />PROCEDURE OR RESEARCH:</h4><span>Include a description of the biomedical characteristics of the animals which are essential to the proposed procedure/research and indicate evidence of experiences with the proposed animal model.</span></label>
												<div class="controls">

													<textarea class="form-control span6"  name="background_significance" rows="8"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />


										</fieldset>
										
										<div class="form-actions">
											<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
											<input type="submit" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT" >
										
											<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
										</div> <!-- /form-actions -->

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
													<div  class="animal_table">
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
																<tr>
																	<td style="text-align: center;" > <input type="text" class="form-control" name="species[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"><input type="text" class="form-control" name="strain[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="source[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="age[]" value="" style="width:50px;"/> </td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="weight[]" value="" style="width:50px;"/> </td>
																	<td style="text-align: center;"> 
																	<select class="form-control "  name="sex[]">
																			<option value="" disabled="" selected="">Please select Sex</option>
																			<option value="Male" >Male</option>
																			<option value="Female" >Female</option>
																			<option value="N/A" >N/A</option>
																	</select>	
</td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="number[]" value="" style="width:50px;"/></td>
																	<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
																</tr>												

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

													<textarea class="form-control span11"  name="basis_in_selecting" rows="4"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

											<div class="control-group">											
												<label class="control-label">C.	Quarantine and/or conditioning process<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="quarantine_conditioning" rows="4"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

												<div class="control-group">											
												<label class="control-label">D.	Animal care procedures<br/></label>
												<div class="controls">

												</div> <!-- /controls -->

												<label class="control-label">1.	Cage Type<br/><span>Give the type, material, and dimensions of the cage that will house the animals.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="cage_type" rows="3"></textarea>
												</div> <!-- /controls -->
</div>

<div class="control-group">
												<label class="control-label">2.	Number of animals per sex per cage<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="num_animals" rows="3"></textarea>
												</div>
</div>

<div class="control-group">
												<label class="control-label">3.	Identification<br/><span>Indicate how each individual animal will be identified from one another.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="identification_animals" rows="3"></textarea>
												</div>
</div>
<div class="control-group">

												<label class="control-label">4.	Cage cleaning method<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="cage_cleaning" rows="3"></textarea>
												</div>
</div>

<div class="control-group">

												<label class="control-label">5.	Living Condition<br/><span>Include where the animals will be housed, the room temperature, humidity, ventilation, and lighting.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="living_condition" rows="3"></textarea>
												</div>
</div>

<div class="control-group">
												<label class="control-label">6. Animal diet, and feeding and watering method<br/></label>
												<div class="controls">

													<textarea class="form-control span11"  name="animal_diet" rows="3"></textarea>
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

													<textarea class="form-control span11"  name="method_desc" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	
												<label class="control-label">2.	Location<br/><span>Indicate where the animal manipulation method will be performed.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_location" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	

												<label class="control-label">3.	Dosing<br/><span>Include the frequency, volume, route, method of restraint and expected outcome or effects.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_dosing" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	

												<label class="control-label">4. Specimen and/or biological agent collection<br/><span>Include the frequency, volume, route, and method of restraint for each specimen and/or biological agent that will be collected.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_collection" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	

												<label class="control-label">5.	Animal examination procedure/s<br/><span>Include the frequency of examinations and the method of restraint.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_examination" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	
												<label class="control-label">6.	Use of anesthetics<br/><span>Include the drug, dosage, and frequency.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_anesthetics" rows="3"></textarea>
												</div>
</div>
<div class="control-group">	

												<label class="control-label">7.	Surgical procedure/s<br/><span>If the protocol involves any surgical procedure, include the following information:</span><br/><span>a.	Place where surgery will be performed</span><br/><span>b.	Description of supportive care and monitoring procedures during and after surgery</span><br/><span>c.	Description of measures for possible post-surgical complications</span>	<br/><span>d.	Name of all participating surgeons and their qualifications and relevant experience</span>
												</label>
												<div class="controls">

													<textarea class="form-control span11"  name="method_surgical" rows="4"></textarea>
												</div>
</div>
<div class="control-group">	

												<label class="control-label">8.	Humane endpoints<br/><span>Describe the plan for monitoring pain, discomfort, or distress during and after the procedure. If animals will be euthanized, include the method that will be used.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="humane_endpoint" rows="3"></textarea>
												</div>


</div>
											<br />




											<div class="control-group">											
												<label class="control-label">F.	Potential hazards<br/><span>Include any potential hazards for the animals and the personnel involved as well as preventive measures to avoid hazards.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="potential_hazards" rows="4"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />

											<div class="control-group">											
												<label class="control-label">G.	Waste disposal<br/><span>Describe how animal carcasses and other wastes generated by the procedure will be disposed of.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="waste_disposal" rows="4"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />
											<div class="control-group">		
												<label class="control-label">H.	Suitable alternatives<br/><span>Is there a non-animal model applicable for the procedure/study? If so, please provide the reasons for not using it.</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="suitable_alternatives" rows="4"></textarea>
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
																<tr>
																	<td style="text-align: center;" > <input type="text" class="form-control" name="name[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"><input type="text" class="form-control" name="title[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="roles[]" value="" style="width:150px;"/></td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="qualification[]" value="" style="width:50px;"/> </td>
																	<td style="text-align: center;"> <input type="text" class="form-control" name="training_vacc[]" value="" style="width:50px;"/> </td>
																	<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
																</tr>												

															</tbody>
														</table>
													</div>
												</div> <!-- /controls -->	



												<div align="center">
													<input type="button" class="btn btn-success"  id="add_personnel" value="ADD PERSONNEL" />
												</div>

											</div> <!-- /control-group -->
										</fieldset>
										
										<div class="form-actions">
											<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
											<input type="submit" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT" >
										
											<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
										</div> <!-- /form-actions -->
										
									</div>



									<div class="tab-pane" id="reference">


										<fieldset>


											<div class="control-group">											
												<label class="control-label" for="firstname"><h4>VII. References</h4><span>List all the reference materials used for this protocol</span></label>
												<div class="controls">

													<textarea class="form-control span11"  name="other_reference" rows="8"></textarea>
												</div> <!-- /controls -->				
											</div>
											<br />


										</fieldset>
											
									<div class="form-actions">
										<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
										<input type="submit" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT" >
										
									</div> <!-- /form-actions -->
									

									</div>





									<!-- <div class="form-actions">
										<button type="submit" class="btn btn-primary">Save</button> 
										<button class="btn">Cancel</button>
									</div> --> <!-- /form-actions -->
								</div>
							</div>
						</div> <!-- /widget-content -->
						{{ Form::close() }}
					</div> <!-- /widget -->
					<!-- Modal -->
					<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header" align="center">
										<h5 class="modal-title" id="exampleModalLongTitle">
										<label style="font-size:15px;font-weight:bold">University of the Philippines Diliman</label>
										<label style="font-size:15px;font-weight:bold">Institutional Animal Care and Use Committee</label>
										</h5>
									</div>
									<div class="modal-body" align="center">
									<label style="font-size:13px;font-weight:bold">CERTIFICATION</label>
											
									<span> I hereby certify that I, <span style="font-size:14px;font-weight:bold">{{ Auth::user()->name }}</span>, as Principal Investigator have thoroughly
									 reviewed and vetted the protocol attached herewith and deemed it is complete and appropriatefor the UPD IACUC to evaluate.
 									</span>
									 <br>
									 <br>
										<div> 
											<input id="checkid2" type="checkbox" value="test" style="display: inline-block; vertical-align: middle;" required/>
    										<label for="checkid2" style="display: inline-block; vertical-align: middle;">The above statement is true</label> 
											<label class="hidden" id="checkCheck" style="color:red">* You must agree to the terms first.</label>
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
										<button type="button" class="btn btn-primary" id="submit_prf" >Submit</button>
									</div>
									</div>
								</div>



				</div>
			</div>      

		</div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->

@endsection

@section('content_scripts')
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

	$(document).ready(function() {

		$('.animal_table').on('show.bs.dropdown', function () {
     $('.animal_table').css( "overflow", "inherit" );
});

$('.animal_table').on('hide.bs.dropdown', function () {
     $('.animal_table').css( "overflow", "auto" );
})

			 var currentDate = new Date();
			 $(".date_from").datepicker({
			   minDate:  currentDate
			});
			  
			  $(".date_to").datepicker({ minDate: '+1 day'});
	

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

var markup = "<tr><td style='text-align: center;' > <input type='text' class='form-control' name='species[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'><input type='text' class='form-control' name='strain[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='source[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='age[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <input type='text' class='form-control' name='weight[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <select class='form-control '  name='sex[]'><option value='' disabled='' selected=''>Please select Sex</option><option value='Male' >Male</option><option value='Female' >Female</option><option value='N/A' >N/A</option></select>	</td>																<td style='text-align: center;'> <input type='text' class='form-control' name='number[]' value='' style='width:50px;'/></td>																<td class='td-actions' style='text-align: center;'><button type='button' class='btn btn-danger btn-small rem' title='Remove row'><i class='btn-icon-only icon-remove'> </i></button></td>															</tr>;";
$("#animal_table tbody").append(markup);
});
	$("#add_personnel").click(function(){
		

		var markup = "<tr><td style='text-align: center;' > <input type='text' class='form-control' name='name[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'><input type='text' class='form-control' name='title[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='roles[]' value='' style='width:150px;'/></td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='qualification[]' value='' style='width:50px;'/> </td>																	<td style='text-align: center;'> <input type='text' class='form-control' name='training_vacc[]' value='' style='width:50px;'/> </td>													<td class='td-actions' style='text-align: center;'><button type='button' class='btn btn-danger btn-small rem' title='Remove row'><i class='btn-icon-only icon-remove'> </i></button></td>															</tr>;";
			console.log
		$("#personnel_table tbody").append(markup);
	});

	$(document).on('click', 'button.rem', function () {
		$(this).closest('tr').remove();
		return false;
	});

		function checkFields(){
			$("#submit").click(function() {
        $("#myForm input[type=text]").each(function() {
            if(!isNaN(this.value)) {
                alert(this.value + " is a valid number");
            }
        });
        return false;
    });
		}

		$('.btnNext').on('click', function(){
			$('.nav-tabs > .active').next('li').find('a')[0].click();
		$('html, body').animate({scrollTop : 0},800);
		});
		$('.btnPrev').on('click', function(){
			$('.nav-tabs > .active').prev('li').find('a')[0].click();
		$('html, body').animate({scrollTop : 0},800);
		});

		


});
$('#submit_prf').on('click', function(){
	if($('#checkid2:checkbox:checked').length == 0)
		{
			$('#checkCheck').removeClass('hidden');
			
		}else{
			$('#checkCheck').addClass('hidden');
			submitForm();
		}
});

function submitForm(){
		Swal.fire({
			title: 'Are you sure you want to submit this PRF for approval?',
			showDenyButton: true,
			confirmButtonText: `Submit`,
			denyButtonText: `No`,
		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				var id=$('#prf_id').val();
				if(validateFields() <= 0){
						$('#check').addClass('hidden');
						Swal.fire(
          	'PRF Submitted', '', 'success'
          	).then(function() {
				$("#triggerSubmit").trigger('click');
          	});
				}else{
					$('#check').removeClass('hidden');
					$("#close").trigger('click');
					$("html, body").animate({scrollTop: 0}, 1000);
				}			

			} else if (result.isDenied) {
				Swal.fire('Submission Cancelled', '', 'info')
			}
			
						
		})
	}


function validateFields(){
		val = 0;
		$("input:text, textarea").each(function () {


                // Check if the element is empty
                // and apply a style accordingly
                var value = $(this).val();
                if (value.length > 0)
                {
                	$(this).parent('div').parent('div').removeClass('error');
                	if($(this).attr('name') == "species[]"){
                		$(this).closest('table').parent('div').parent('div').parent('div').removeClass('error');
                	}

                	if($(this).attr('name') == "name[]"){
                		$(this).closest('table').parent('div').parent('div').parent('div').removeClass('error');
                	}

                }else{
                	if($(this).attr('name') == "method_surgical"){
                		$(this).parent('div').parent('div').removeClass('error');	   				  
                	}else{
                		if($(this).attr('name') == "species[]"){
                			$(this).closest('table').parent('div').parent('div').parent('div').addClass('error');
                		}

                		if($(this).attr('name') == "name[]"){
                			$(this).closest('table').parent('div').parent('div').parent('div').addClass('error');
                		}

                		$(this).parent('div').parent('div').addClass('error');
                		val++;  
                	}
                }

				if($(this).attr('name') == "method_surgical"){
                		$(this).parent('div').parent('div').removeClass('error');	   				  
                	}
            });

		return val = val - 3;
	}
</script>

@endsection