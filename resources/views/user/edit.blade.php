@extends('layouts/index')
@section('content_body')
<style type="text/css">
	input[type=radio] {
  display: inline;
}
</style>
<div class="main">
	
	<div class="main-inner">

		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="widget">
						<div class="widget-header">
							<i class="icon-user"></i>
							<h3>Edit User</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/user/update/'.$user[0]->id, 'method' => 'post', 'class'=>'form-label-left')) }}
						<div class="widget-content">
							<div class="tabbable">
								<div class="tab-content">
									@if(isset($_GET['response']))
									<div class="alert alert-success alert-dismissible " role="alert">
										<strong>User Updated</strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>                    
									@endif
									@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									<div class="tab-pane active">
										<fieldset>
											<div class="control-group">											
												<label class="control-label" >Role:</label>
												<div class="controls">
													<select class="form-control selectpicker" multiple="" id="roles" data-live-search="true" name="roles[]"  title="Please select role">
														@foreach($roles as $value)                      
														<option value="{{$value->id}}" @foreach($user->roles as $role){{$role->role_id == $value->id ? 'selected': ''}}   @endforeach> {{$value->name}}</option>
														@endforeach
													</select>
												</div> 				
											</div>

											<div class="control-group" id="unit" >											
												<label class="control-label" >Unit:</label>
												<div class="controls">
													<select class="form-control selectpicker"  data-live-search="true" name="unit" >
														<option value="" disabled="" selected="">Please select unit</option>
														@foreach($units as $value)                      
														<option value="{{$value->id}}" @if(in_array($value->id, array_column($user->roles->toArray(),'unit_id'))) selected="" @endif>{{$value->name}} - {{$value->description}}</option>
														@endforeach
													</select>
												</div> 				
											</div>
											<div class="control-group">											
												<label class="control-label" for="name">Title:</label>
												<select class="form-control selectpicker"   data-live-search="true" name="honorifics">
														<option value="" disabled="" selected="">Please select title</option>
														<option value="Mr." @if($user[0]->honorifics == "Mr.") selected=""  @endif >Mr.</option>
														<option value="Ms." @if($user[0]->honorifics == "Ms.") selected=""  @endif>Ms.</option>
														<option value="Mx." @if($user[0]->honorifics == "Mx.") selected=""  @endif>Mx.</option>
														<option value="Dr." @if($user[0]->honorifics == "Dr.") selected=""  @endif>Dr.</option>
												</select>			
											</div>
											<div class="control-group">											
												<label class="control-label" for="name">Name:</label>
												<div class="controls">
													<input type="text" class="form-control span6"  name="name" value="@if($user[0]->name) {{$user[0]->name}}@endif">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="email">Email Address:</label>
												<div class="controls">
													<input type="text" class="form-control span6"  name="email" value="@if($user[0]->email) {{$user[0]->email}}@endif">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="contact_number">Contact Number:</label>
												<div class="controls">
													<input type="tel" class="form-control span6"  name="contact_number" value="@if($user[0]->contact_number){{$user[0]->contact_number}}@endif">
												</div>				
											</div>
											
											<div class="control-group">	
												<label class="control-label" for="contact_number">Status:</label>
												<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" @if($user[0]->status == 1) checked @endif> Active &nbsp;
												<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2" @if($user[0]->status == 2) checked @endif> Inactive
											</div>

										</fieldset>
									</div>


									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save</button>
										@if(in_array(1,getUserRole()))										
										<a href="{{url('/user')}}" class="btn">Cancel</a>
										@else										
										<a href="{{url('/')}}" class="btn">Cancel</a>
										@endif 
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

<script type="text/javascript">

	$( document ).ready(function() {
		console.log(jQuery.inArray("3", $('#roles').val()));
		if(jQuery.inArray("3", $('#roles').val()) !== -1){
				$('#unit').show();
			}else{
				$('#unit').hide();
			}
				
	});
	
	$('#roles').on('change',function(){
		if(jQuery.inArray("3", $('#roles').val()) !== -1){
			$('#unit').show();
		}else{
			$('#unit').hide();
		}
		
	});
</script>
@endsection

@section('content_scripts')

@endsection