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

					<div class="widget" style="min-height: 500px;">
						<strong><a href="{{url('/approvals/review-prf/'.$prf_details->protocol_id)}}" style="color:#878f99;">< Back to Review Protocol </a></strong>
						<br/>
						<br/>
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>Generate Forms</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content" align="center">
							

							<strong><a href="{{url('/approvals/generate-comment-form/'.$prf_details->protocol_id)}}" target="_blank" style="color:rgb(0, 132, 255); padding-left: 12px;padding-right: 12px;">PRF COMMENT FORM (1A)</a></strong> 
							<strong><a href="{{url('/approvals/generate-prf/'.$prf_details->protocol_id)}}" style="color:rgb(0, 132, 255);">GENERATE PRF (1) </a></strong>


							<!-- <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save it for later</button> 
								<button class="btn">Cancel</button>
							</div> -->
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

		

	});
</script>

@endsection