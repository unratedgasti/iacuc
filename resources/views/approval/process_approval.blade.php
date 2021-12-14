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
							<h3>Process Approval</h3>
						</div> <!-- /widget-header -->
						{{ Form::open(array('url' => '/approvals/sec-approval-submit/'.$prf_details->protocol_id, 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=>'form-label-left')) }}
						<div class="widget-content" align="center">
							<div class="control-group">											
								<label class="control-label"><strong>Approval Options</strong></label>
                                <input type="hidden" name="protocol_id" value="{{$prf_details->protocol_id}}"> 

								<div class="controls">
									<label class="radio inline" style="padding-left: 70px!important;">
										<input type="radio"  name="radiobtns" value="Approved" required> Approved
									</label>

									<label class="radio inline" style="padding-left: 70px!important;">
										<input type="radio" name="radiobtns" value="Approved with revisions"> Approved pending revisions
									</label>

									<label class="radio inline" style="padding-left: 70px!important;">
										<input type="radio" name="radiobtns" value="Rejected"> Resubmit
									</label>
								</div>	<!-- /controls -->			
							</div> <!-- /control-group -->
							<br/>
							<div class="form-group">
								<input type="hidden" id="prf_id" name="prf_id" value="{{$prf_details->protocol_id}}">
								<label for="exampleFormControlFile1"><strong>UPLOAD FILE</strong></label>
								<input type="file" class="form-control-file" id="but_upload" name="attachment">
								<div id="attachments">
								</div>
								<br/>
								<button type="button" class="btn btn-success" id="upload_attachment" style="">Upload Attachment</button>
							</div>
							<br/>
							<div class="control-group">	
								<label class="control-label" for="email"><strong>NOTES</strong></label>
								<div class="controls">
									<textarea class="form-control span10"  name="protocol_comments" rows="8"></textarea>
								</div>
							</div>
							<br/>
							<div class="form-actions" align="center">
								<button type="submit" class="btn btn-primary" style="">Submit</button>&nbsp;&nbsp;&nbsp;
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

		$("#but_upload").change(function () {
			var fileExtension = ['rar', 'RAR', 'pdf', 'PDF', 'jpg', 'JPG'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$("#but_upload").val("");
				alert("Only formats are allowed : "+fileExtension.join(', '));

			}
		});


		$("#upload_attachment").click(function(){

			
			var prf_id=$('#prf_id').val();
			var fd = new FormData();
			var files = $('#but_upload')[0].files;
			var filename= files[0]['name'];
			console.log(files);
			fd.append('file',$('#but_upload')[0].files[0]);
			fd.append('prf_id',prf_id);
// console.log()
        // Check file selected or not
        if(files.length > 0 ){

        	$.ajax({
        		url: '{{url("/approvals/review-prf/upload_attachment")}}',
        		type: 'post',
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		},
        		data: fd,
        		processData: false,
        		contentType: false,
        		success: function(response){
        			console.log(response);
        			if(response != 0){
        				$("#attachments").append('<div class="attach"><strong style="color:green"> File has been uploaded.</strong><br/><strong>'+filename+'</strong>&nbsp;&nbsp;&nbsp;<input type="hidden" name="att_id" value="'+response+'" id="remove" ><a href = "#" class="remove"  style="color:red"><i class="icon-remove remov" ></i></a><br/>');
        			}else{
        				alert('file not uploaded');
        			}
        		},
        	});
        }else{
        	alert("Please select a file.");
        }
    });

		


	});
	$('#attachments').on('click', '.remove', function() {

		var attachment=$(this).closest("div").find("input[name='att_id']").val();
		$.ajax({
			url: '{{url("/approvals/review-prf/remove_attachment")}}',
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: { attachment_id: attachment},
			dataType: "json",
			success: function(response){
				if(response != 0){


				}
			},
		});
		$(this).closest(".attach").remove();

	});
	
</script>

@endsection