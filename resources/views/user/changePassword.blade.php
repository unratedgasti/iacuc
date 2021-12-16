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
							<h3>Change Password</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/user/password/update', 'method' => 'post', 'class'=>'form-label-left')) }}
						<div class="widget-content">
							<div class="tabbable">

								<div class="tab-content">
									@if(isset($_GET['response']))
									<div class="alert alert-success alert-dismissible " role="alert">
										<strong>Password succesfully changed.</strong>
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
												<label class="control-label" for="password">Current Password:</label>
												<div class="controls">
													<input type="password" class="form-control span6"  name="password" value="{{old('password')}}">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="password1">New Password:</label>
												<div class="controls">
													<input type="password" class="form-control span6"  name="password1" value="{{old('password1')}}">
												</div>				
											</div>
											<div class="control-group">											
												<label class="control-label" for="passwordw">Retype New Password:</label>
												<div class="controls">
													<input type="password" class="form-control span6"  name="password2" value="{{old('password2')}}">
												</div>				
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

@endsection

@section('content_scripts')

@endsection