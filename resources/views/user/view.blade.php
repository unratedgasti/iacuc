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
							<h3>Create Protocol</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/user/store', 'method' => 'post', 'class'=>'form-label-left')) }}
						<div class="widget-content">
							<div class="tabbable">

								<div class="tab-content">
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
													<select class="form-control selectpicker" multiple="" data-live-search="true" name="roles[]"  title="Please select role">
														@foreach($roles as $value)                      
														<option value="{{$value->id}}"> {{$value->name}}</option>
														@endforeach
													</select>
												</div> 				
											</div>
											<div class="control-group">											
												<label class="control-label" >Unit:</label>
												<div class="controls">
													<select class="form-control selectpicker"  data-live-search="true" name="unit" >
														<option value="" disabled="" selected="">Please select unit</option>
														@foreach($units as $value)                      
														<option value="{{$value->id}}">{{$value->name}} - {{$value->description}}</option>
														@endforeach
													</select>
												</div> 				
											</div>
											<div class="control-group">											
												<label class="control-label" for="name">Name:</label>
												<div class="controls">
													<input type="text" class="form-control span6"  name="name" value="{{old('name')}}">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="email">Email Address:</label>
												<div class="controls">
													<input type="text" class="form-control span6"  name="email" value="{{old('email')}}">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="email">Password:</label>
												<div class="controls">
													<input type="password" class="form-control span6"  name="password" value="">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="contact_number">Contact Number:</label>
												<div class="controls">
													<input type="tel" class="form-control span6"  name="contact_number" value="{{old('contact_number')}}">
												</div>				
											</div>
											
											<div class="control-group">	
												<label class="control-label" for="contact_number">Status:</label>
												<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked> Active &nbsp;
												<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2"> Inactive
											</div>

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

@endsection