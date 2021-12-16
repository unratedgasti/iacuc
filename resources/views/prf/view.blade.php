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
.back-to-top {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: green;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

.back-to-top:hover{
 opacity: 0.7;
  color: white;
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
							<h3>
							@if($prf_details->status == "CREATED" || $prf_details->status == "REJECTED" || $prf_details->status == "MINOR REVISIONS" || $prf_details->status == "FINAL APPROVED")
								{{ $prf_details->status }}
							@else
							Under Review
							@endif
							</h3>
						</div> <!-- /widget-header -->
						<div><br></div>
						<div class="widget-content hidden" id="check" style="border-color: red;">
							<label style="color:red;font-weight: bold;">Some fields are required. Check each tab to make sure you filled out every required field.</label>
						</div>
						{{ Form::open(array('url' => '/prf/update-prf/'.$prf_details->protocol_id, 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=>'form-label-left', 'id' => 'myForm')) }}
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
									<input type="hidden" class="form-control span6" name="protocol_id" id="prf_id" value="{{$prf_details->protocol_id}}">
									<h4>I. PROTOCOL</h4>
									<br/>
									<fieldset>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
										@if($value->protocol_comments)
										@if($prf_details->status == "RETURNED FROM UNIT")										
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->protocol_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<div class="control-group">											
											<label class="control-label" ><span style="color:red">*</span>Institute:</label>
											<div class="controls">
												<select class="form-control" name="institute_id"  readonly required>
													@foreach($units as $value)                      
													<option value="{{$value->id}}" {{  $prf_details->institute_id==$value->id ? 'selected': ''  }}>{{$value->description}}</option>
													@endforeach
												</select>
											</div> <!-- /controls -->				
										</div>

										<div class="control-group">											
											<label class="control-label" for="firstname"><span style="color:red">*</span>A. Name of protocol or procedure:</label>
											<div class="controls">
												<input type="text" class="form-control span6" id="protocol_name" name="protocol_name" value="{{$prf_details->protocol_name}}">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="lastname"><span style="color:red">*</span>B. Title/s of research/study:</label>
											<div class="controls">
												@if(count($prf_rs) == 0 )
												<input type="text" class="form-control span6" name="rstudy[]" value="">
												@else
												@foreach($prf_rs as $value)
												<input type="text" class="form-control span6" name="rstudy[]" value="{{$value->research_study}}">
												@endforeach

												@endif
												<br/>

												<button class="btn" id="add_rs" style="margin-left:200px; margin-top:10px;">Add More Fields</button>
											</div> <!-- /controls -->	

										</div> <!-- /control-group -->


										<div class="control-group">											
											<label class="control-label" for="email"><span style="color:red">*</span>C. Source/s of funding (if any):</label>
											<div class="controls">
												<textarea class="form-control span6" name="funding_source" rows="3">{{$prf_details->funding_source}}</textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


										<div class="control-group">											
											<label class="control-label" for="lastname"><span style="color:red">*</span>D. Previous Protocol Review #:<br/><span style="font-style: italic;margin-left: 1%;">If protocol is for the renewal of a previously approved protocol, provide the Protocol Review # of said protocol.</span></label>
											<div class="controls">
												<input type="text" class="span6" name="prev_protocol_no" value="{{$prf_details->prev_protocol_no}}">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" ><span style="color:red">*</span>E. Purpose of protocol:</label>
											<div class="controls">
												<select class="form-control" readonly name="purpose">
													<option value="RESEARCH" {{  isset($prf_details)  ? $prf_details->purpose=='RESEARCH' ? 'selected': ' '  : ' '  }}>RESEARCH</option>
													<option value="TEACHING" {{  isset($prf_details)  ? $prf_details->purpose=='TEACHING' ? 'selected': ' '  : ' '  }}>TEACHING</option>
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


										<br />									
									</fieldset>
									@if(isinvestigator())
									<div class="form-actions">
										@if($prf_details->status != "FINAL APPROVED")
										<button class="btn btn-medium btn-success" onclick="saveAsDraft()">Save As Draft</button>
										<input type="button" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT">
										@else
										<a href="{{ asset('/asset/UPD IACUC Form 3 v2.1 - RMCAUP.docx') }}" class="btn btn-medium btn-success" target="_blank">TO REQUEST FOR MAJOR CHANGE TO AN ANIMAL USE PROTOCOL</a>
										@endif
										<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
									</div> <!-- /form-actions -->
									@endif
								</div>


								<div class="tab-pane" id="objectives">
									<fieldset>
										<div class="control-group">											
											<label class="control-label" for="firstname"><h4><span style="color:red">*</span>II. OBJECTIVES/S:</h4></label>
											<div class="controls">

												<textarea class="form-control span6"  name="objectives" rows="3">{{$prf_details->objectives}}</textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
										@if($value->objectives_comments)	
										@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->objectives_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />

										<div class="control-group">											
											<label class="control-label" for="firstname"><h4><span style="color:red">*</span>III. DURATION:</h4></label>
											<div class="controls">

												From:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker date_from" name="date_from" value="{{date('m/d/Y', strtotime($prf_details->date_from))}}" />&nbsp;&nbsp;TO:&nbsp;&nbsp; <input type='text' class="form-control span2 datepicker date_to" name="date_to" value="{{date('m/d/Y', strtotime($prf_details->date_to))}}" />
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
										@if($value->duration_comments)
										@if($prf_details->status == "RETURNED FROM UNIT")
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->duration_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />



									</fieldset>
									@if(isinvestigator())
									<div class="form-actions">
										<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
										@if($prf_details->status != "FINAL APPROVED")
										<input type="button" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT">
										@else
										<a href="{{ asset('/asset/UPD IACUC Form 3 v2.1 - RMCAUP.docx') }}" class="btn btn-medium btn-success" target="_blank">Download</a>
										@endif
										<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
									</div> <!-- /form-actions -->
									@endif
								</div>


								<div class="tab-pane" id="pi">

									<h4> IV. PRINCIPAL INVESTIGATOR</h4>
									<br/>
									<fieldset>

										<div class="control-group">											
											<label class="control-label" for="firstname"><span style="color:red">*</span>A. Name:</label>
											<div class="controls">
												<input type="text" class="form-control span6" readonly name="investigator_name" value="{{$prf_details->inv_name}}">
												<input type="hidden" name="invest_id" value="{{Auth::user()->id}}">
											</div> <!-- /controls -->			
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="lastname"><span style="color:red">*</span>B. Qualifications: </label>
											<div class="controls">
												@foreach($prf_qualifications as $value)
												<input type="text" class="form-control span6" name="qual[]" value="{{$value->qualification_desc}}">
												@endforeach
												<br/>
												<button class="btn" id="add_q" style="margin-left:200px; margin-top:10px;">Add More Fields</button>
											</div> <!-- /controls -->	

										</div>


										<div class="control-group">											
											<label class="control-label" for="firstname"><span style="color:red">*</span>C. Contact Information</label>
											<div class="controls">
											</div> <!-- /controls -->			
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="firstname"><span style="color:red">*</span>Email Address:</label>
											<div class="controls">
												<input type="text" class="form-control span6" readonly name="email" readonly value="{{$prf_details->email}}">
											</div> <!-- /controls -->			
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="firstname"><span style="color:red">*</span>Contact Number:</label>
											<div class="controls">
												<input type="text" class="form-control span6" readonly name="contact_number" readonly value="{{$prf_details->contact_number}}">

											</div> <!-- /controls -->			
										</div> <!-- /control-group -->
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
										@if($value->investigator_comments)
										@if($prf_details->status == "RETURNED FROM UNIT")
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->investigator_comments}}</label>
										</div>
										</div>
										@endif	
										@endif
										@endforeach
										@endif

										<br />

										<div class="control-group">											
											<label class="control-label" for="firstname"><h4><span style="color:red">*</span>V. BACKGROUND AND <br />SIGNIFICANCE OF THE <br />PROCEDURE OR RESEARCH:</h4><span style="font-style: italic;margin-left: 1%;">Include a description of the biomedical characteristics of the animals which are essential to the proposed procedure/research and indicate evidence of experiences with the proposed animal model.</span></label>
											<div class="controls">

												<textarea class="form-control span6"  name="background_significance" rows="8">{{$prf_details->background_significance}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
										@if($value->background_comments)
										@if($prf_details->status == "RETURNED FROM UNIT")
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->background_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />


									</fieldset>
									@if(isinvestigator())
									<div class="form-actions">
										<a  class="btn btn btn-medium btn-info btnPrev" >PREVIOUS</a>
										@if($prf_details->status != "FINAL APPROVED")
										<input type="button" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT">
										@else
										<a href="{{ asset('/asset/UPD IACUC Form 3 v2.1 - RMCAUP.docx') }}" class="btn btn-medium btn-success" target="_blank">Download</a>
										@endif
										<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
									</div> <!-- /form-actions -->
									@endif
								</div>

								<div class="tab-pane" id="description" >
									<a href="#" class="back-to-top">Back to top</a>
									<fieldset>
										<h4> VI. DESCRIPTION OF METHODOLOGIES/EXPERIMENTAL DESIGN</h4>
										<span style="font-style: italic;margin-left: 1%;">This section should establish that the proposed procedure is well designed scientifically and ethically.</span>
										<br/>
										<br/>

										<div class="control-group">
											<label class="control-label"><span style="color:red">*</span>A. Animals <br/><span style="font-style: italic;margin-left: 1%;">For protocols lasting more than one year, add separate rows for each year. The Number column should only reflect the number of animals that will be used for each year.</span></label>
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
															@if(count($prf_animals) == 0)
															<tr>
																<td style="text-align: center;" > <input type="text" class="form-control" name="species[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"><input type="text" class="form-control" name="strain[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="source[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="age[]" value="" style="width:50px;"/> </td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="weight[]" value="" style="width:50px;"/> </td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="sex[]" value="" style="width:50px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="number[]" value=""" style="width:50px;"/></td>
																<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
															</tr>	
															@else
															@foreach($prf_animals as $value)
															<tr>
																<td style="text-align: center;" > <input type="text" class="form-control" name="species[]" value="{{$value->species}}" style="width:150px;"/></td>
																<td style="text-align: center;"><input type="text" class="form-control" name="strain[]" value="{{$value->strain}}" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="source[]" value="{{$value->source}}" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="age[]" value="{{$value->age}}" style="width:50px;"/> </td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="weight[]" value="{{$value->weight}}" style="width:50px;"/> </td>
																<td style="text-align: center;"> 
																<select class="form-control "  name="sex[]">
																			<option value="" disabled="" selected="">Please select Sex</option>
																			<option value="Male" {{ ($value->sex == "Male" ? "selected":"") }}>Male</option>
																			<option value="Female" {{ ($value->sex == "Female" ? "selected":"") }}>Female</option>
																			<option value="N/A" {{ ($value->sex == "N/A" ? "selected":"") }}>N/A</option>
																	</select>	
															</td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="number[]" value="{{$value->number}}" style="width:50px;"/></td>
																<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
															</tr>												
															@endforeach
															@endif
														</tbody>
													</table>
												</div>
											</div> <!-- /controls -->	



											<div align="center">
												<input type="button" class="btn btn-success"  id="add_animal" value="ADD ANIMAL" />
											</div>

										</div> <!-- /control-group -->
										@if($unit_reviews)													
										@foreach($unit_reviews as $value)					
										@if($value->animals_comments)	
										@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->animals_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br/>

										<div class="control-group">											
											<label class="control-label"><span style="color:red">*</span>B. Basis for selecting animal species<br/><span style="font-style: italic;margin-left: 1%;">Give the reason/s for the use of the animals and justify the number of animals that will be used.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="basis_in_selecting" rows="4">{{$prf_details->basis_in_selecting}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)								
										@foreach($unit_reviews as $value)
										@if($value->basis_comments)	
										@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->basis_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />

										<div class="control-group">											
											<label class="control-label"><span style="color:red">*</span>C.	Quarantine and/or conditioning process<br/></label>
											<div class="controls">

												<textarea class="form-control span11"  name="quarantine_conditioning" rows="4">{{$prf_details->quarantine_conditioning}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)								
										@foreach($unit_reviews as $value)
										@if($value->quarantine_comments)
										@if($prf_details->status == "RETURNED FROM UNIT")		
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
											<label >{{$value->quarantine_comments}}</label>
										</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />

										<div class="control-group">											
											<label class="control-label">D.	Animal care procedures<br/></label>
											<div class="controls">

											</div> <!-- /controls -->

											<label class="control-label"><span style="color:red">*</span>1.	Cage Type<br/><span style="font-style: italic;margin-left: 1%;">Give the type, material, and dimensions of the cage that will house the animals.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="cage_type" rows="3">{{$prf_details->cage_type}}</textarea>
											</div> <!-- /controls -->
											
										</div>
											@if($unit_reviews)								
											@foreach($unit_reviews as $value)
											@if($value->cage_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->cage_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											<div class="control-group">		
			
											<label class="control-label"><span style="color:red">*</span>2.	Number of animals per sex per cage<br/></label>
											<div class="controls">

												<textarea class="form-control span11"  name="num_animals" rows="3">{{$prf_details->num_animals}}</textarea>
											</div>
</div>
											@if($unit_reviews)												
											@foreach($unit_reviews as $value)
											@if($value->numanimals_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->numanimals_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											<div class="control-group">

											<label class="control-label"><span style="color:red">*</span>3.	Identification<br/><span style="font-style: italic;margin-left: 1%;">Indicate how each individual animal will be identified from one another.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="identification_animals" rows="3">{{$prf_details->identification_animals}}</textarea>
											</div>
</div>
											@if($unit_reviews)											
											@foreach($unit_reviews as $value)
											@if($value->identification_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->identification_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											<div class="control-group">

											<label class="control-label"><span style="color:red">*</span>4.	Cage cleaning method<br/></label>
											<div class="controls">

												<textarea class="form-control span11"  name="cage_cleaning" rows="3">{{$prf_details->cage_cleaning}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->cageclean_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->cageclean_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											<div class="control-group">

											<label class="control-label"><span style="color:red">*</span>5.	Living Condition<br/><span style="font-style: italic;margin-left: 1%;">Include where the animals will be housed, the room temperature, humidity, ventilation, and lighting.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="living_condition" rows="3">{{$prf_details->living_condition}}</textarea>
											</div>
</div>
											@if($unit_reviews)											
											@foreach($unit_reviews as $value)
											@if($value->living_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->living_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											<div class="control-group">

											<label class="control-label"><span style="color:red">*</span>6. Animal diet, and feeding and watering method<br/></label>
											<div class="controls">

												<textarea class="form-control span11"  name="animal_diet" rows="3">{{$prf_details->animal_diet}}</textarea>
											</div>
</div>
											@if($unit_reviews)											
											@foreach($unit_reviews as $value)
											@if($value->diet_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->diet_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif

										<br />
										<br />
										<div class="control-group">											
											<label class="control-label">E.	Experimental or animal manipulation methods<br/></label>
											<div class="controls">

											</div> <!-- /controls -->

											<label class="control-label"><span style="color:red">*</span>1.	General description<br/><span style="font-style: italic;margin-left: 1%;">Give a description of the methods of animal manipulation that will be used including the method of conditioning.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_desc" rows="3">{{$prf_details->method_desc}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->general_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->general_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
										<div class="control-group">	

											<label class="control-label"><span style="color:red">*</span>2.	Location<br/><span style="font-style: italic;margin-left: 1%;">Indicate where the animal manipulation method will be performed.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_location" rows="3">{{$prf_details->method_location}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->location_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->location_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
										<div class="control-group">	

											<label class="control-label"><span style="color:red">*</span>3.	Dosing<br/><span style="font-style: italic;margin-left: 1%;">Include the frequency, volume, route, method of restraint and expected outcome or effects.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_dosing" rows="3">{{$prf_details->method_dosing}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->dosing_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->dosing_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
										<div class="control-group">	

											<label class="control-label"><span style="color:red">*</span>4. Specimen and/or biological agent collection<br/><span style="font-style: italic;margin-left: 1%;">Include the frequency, volume, route, and method of restraint for each specimen and/or biological agent that will be collected.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_collection" rows="3">{{$prf_details->method_collection}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->collection_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->collection_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif

										<div class="control-group">	
											<label class="control-label"><span style="color:red">*</span>5.	Animal examination procedure/s<br/><span style="font-style: italic;margin-left: 1%;">Include the frequency of examinations and the method of restraint.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_examination" rows="3">{{$prf_details->method_examination}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->examination_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")		
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->examination_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif

											<div class="control-group">	
											<label class="control-label"><span style="color:red">*</span>6.	Use of anesthetics<br/><span style="font-style: italic;margin-left: 1%;">Include the drug, dosage, and frequency.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="method_anesthetics" rows="3">{{$prf_details->method_anesthetics}}</textarea>
											</div>
</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->anesthetics_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->anesthetics_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
											
										<div class="control-group">	
											<label class="control-label">7.	Surgical procedure/s<br/><span style="font-style: italic;margin-left: 1%;">If the protocol involves any surgical procedure, include the following information:</span><br/><span style="font-style: italic;margin-left: 1%;">a.	Place where surgery will be performed</span><br/><span style="font-style: italic;margin-left: 1%;">b.	Description of supportive care and monitoring procedures during and after surgery</span><br/><span style="font-style: italic;margin-left: 1%;">c.	Description of measures for possible post-surgical complications</span>	<br/><span style="font-style: italic;margin-left: 1%;">d.	Name of all participating surgeons and their qualifications and relevant experience</span>
											</label>	
											<div class="controls">

												<textarea class="form-control span11" id="notrequired"  name="method_surgical" rows="4">{{$prf_details->method_surgical}}</textarea>
											</div>
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
											@if($value->surgical_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->surgical_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<div class="control-group">	
											<label class="control-label"><span style="color:red">*</span>8.	Humane endpoints<br/><span style="font-style: italic;margin-left: 1%;">Describe the plan for monitoring pain, discomfort, or distress during and after the procedure. If animals will be euthanized, include the method that will be used.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="humane_endpoint" rows="3">{{$prf_details->humane_endpoint}}</textarea>
											</div>
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
											@if($value->humane_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->humane_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif

										<br />




										<div class="control-group">											
											<label class="control-label"><span style="color:red">*</span>F.	Potential hazards<br/><span style="font-style: italic;margin-left: 1%;">Include any potential hazards for the animals and the personnel involved as well as preventive measures to avoid hazards.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="potential_hazards" rows="4">{{$prf_details->potential_hazards}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
											@if($value->hazards_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->hazards_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />

										<div class="control-group">											
											<label class="control-label"><span style="color:red">*</span>G.	Waste disposal<br/><span style="font-style: italic;margin-left: 1%;">Describe how animal carcasses and other wastes generated by the procedure will be disposed of.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="waste_disposal" rows="4">{{$prf_details->waste_disposal}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
											@if($value->hazards_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->disposal_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />
										<div class="control-group">		
											<label class="control-label"><span style="color:red">*</span>H.	Suitable alternatives<br/><span style="font-style: italic;margin-left: 1%;">Is there a non-animal model applicable for the procedure/study? If so, please provide the reasons for not using it.</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="suitable_alternatives" rows="4">{{$prf_details->waste_disposal}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)										
										@foreach($unit_reviews as $value)
											@if($value->hazards_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
										<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
											<div class="controls">
												<label >{{$value->alternative_comments}}</label>
											</div>
										</div>
										@endif
										@endif
										@endforeach
										@endif
										<br />
										<div class="control-group">
											<label class="control-label"><span style="color:red">*</span>I. Other personnel<br/><span style="font-style: italic;margin-left: 1%;">Add more rows if necessary.</span></label>
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
															@if(count($prf_personnel) == 0)
															<tr>
																<td style="text-align: center;" > <input type="text" class="form-control" name="name[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"><input type="text" class="form-control" name="title[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="roles[]" value="" style="width:150px;"/></td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="qualification[]" value="" style="width:50px;"/> </td>
																<td style="text-align: center;"> <input type="text" class="form-control" name="training_vacc[]" value="" style="width:50px;"/> </td>
																<td class="td-actions" style="text-align: center;"><button type="button" class="btn btn-danger btn-small rem" title="Remove row"><i class="btn-icon-only icon-remove"> </i></button></td>
															</tr>
															@else
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
															@endif									

														</tbody>
													</table>
												</div>
											</div> <!-- /controls -->	




											<div align="center">
												<input type="button" class="btn btn-success"  id="add_personnel" value="ADD PERSONNEL" />
											</div>
											@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->personnel_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->personnel_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif

										</div> <!-- /control-group -->
										@if(isinvestigator())
										<div class="form-actions">
											<a  class="btn btn btn-medium btn-info btnPrev" data-toggle="tab">PREVIOUS</a>
											@if($prf_details->status != "FINAL APPROVED")
										<input type="button" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT">
										@else
										<a href="{{ asset('/asset/UPD IACUC Form 3 v2.1 - RMCAUP.docx') }}" class="btn btn-medium btn-success" target="_blank">Download</a>
										@endif
											<a  class="btn btn btn-medium btn-info btnNext" >NEXT</a>
										</div> <!-- /form-actions -->
										@endif
									</fieldset>
								</div>



								<div class="tab-pane" id="reference">


									<fieldset>


										<div class="control-group">											
											<label class="control-label" for="firstname"><h4>VII. References</h4><span style="font-style: italic;margin-left: 1%;"><span style="color:red">*</span>List all the reference materials used for this protocol</span></label>
											<div class="controls">

												<textarea class="form-control span11"  name="other_reference" rows="8">{{$prf_details->other_reference}}</textarea>
											</div> <!-- /controls -->				
										</div>
										@if($unit_reviews)										
											@foreach($unit_reviews as $value)
											@if($value->references_comments)
											@if($prf_details->status == "RETURNED FROM UNIT")	
											<div class="control-group error" style="outline: 1px solid red;margin: 1%;padding: 1%;">
												<div class="controls">
													<label >{{$value->references_comments}}</label>
												</div>
											</div>
											@endif
											@endif
											@endforeach
											@endif
										<br />
									</fieldset>
									@if(isinvestigator())
									<div class="form-actions">
										<a  class="btn btn btn-medium btn-info btnPrev" data-toggle="tab">PREVIOUS</a>
										@if($prf_details->status != "FINAL APPROVED")
										<input type="button" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="SUBMIT">
										@else
										<a href="{{ asset('/asset/UPD IACUC Form 3 v2.1 - RMCAUP.docx') }}" class="btn btn-medium btn-success" target="_blank">Download</a>
										@endif
									</div> <!-- /form-actions -->
									@endif
								</div>
								<input type="hidden" value="0" name="checkSubmit" id="checkSubmit">

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
											
									<span> I hereby certify that I, <span style="font-size:14px;font-weight:bold">{{ $prf_details->inv_name }}</span>, as Principal Investigator have thoroughly
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
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
										<button type="button" class="btn btn-primary" id="submit_prf" >Submit</button>
									</div>
									</div>
								</div>
								</div>



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
function saveAsDraft(){
			$('#myForm').submit();
		}
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

var markup = "<tr><td style='text-align: center;' > <input type='text' class='form-control' name='species[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'><input type='text' class='form-control' name='strain[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='source[]' value='' style='width:150px;'/></td>																<td style='text-align: center;'> <input type='text' class='form-control' name='age[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <input type='text' class='form-control' name='weight[]' value='' style='width:50px;'/> </td>																<td style='text-align: center;'> <select class='form-control '  name='sex[]'><option value='' disabled='' selected=''>Please select Sex</option><option value='Male' >Male</option><option value='Female' >Female</option><option value='N/A' >N/A</option></select>	</td>																<td style='text-align: center;'> <input type='text' class='form-control' name='number[]' value='' style='width:50px;'/></td>																<td class='td-actions' style='text-align: center;'><button type='button' class='btn btn-danger btn-small rem' title='Remove row'><i class='btn-icon-only icon-remove'> </i></button></td>															</tr>;";
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

	$( "#submit_prf" ).click(function() {
		if($('#checkid2:checkbox:checked').length == 0)
		{	
			$("#exampleModalLong").modal('close');
			$('#checkCheck').removeClass('hidden');
			
		}else{
			$('#checkSubmit').val(1);
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
				
				$("#myForm").submit();
          	});
				}else{
					$('#check').removeClass('hidden');					
					$("#closeModal").trigger('click');
					$('#checkSubmit').val(0);
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
					$(this).parent('div').parent('div').removeClass('error');
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
            })

		return val = val - 2;
	}

	$('.btnNext').on('click', function(){
		$('.nav-tabs > .active').next('li').find('a')[0].click();
		$('html, body').animate({scrollTop : 0},800);
	});
	$('.btnPrev').on('click', function(){
		$('.nav-tabs > .active').prev('li').find('a')[0].click();
		$('html, body').animate({scrollTop : 0},800);
	});

	var currentDate = new Date();
	$(".date_from").datepicker({
		minDate:  currentDate
	});

	$(".date_to").datepicker({ minDate: '+1 day'});
	

 //Check to see if the window is top if not then display button
 $(window).scroll(function(){

  // Show button after 100px
  var showAfter = 100;
  if ( $(this).scrollTop() > showAfter ) { 
   $('.back-to-top').fadeIn();
  } else { 
   $('.back-to-top').fadeOut();
  }
 });
 
 //Click event to scroll to top
 $('.back-to-top').click(function(){
  $('html, body').animate({scrollTop : 0},800);
  return false;
 });
});

</script>

@endsection