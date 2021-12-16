@extends('layouts/index')
@section('content_body')
<div class="main">
	
	<div class="main-inner">

		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="widget" style="min-height: 500px;">
						
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>Resubmit Protocol</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content">
							@if(isset($_GET['response']))
							<div class="alert alert-success alert-dismissible " role="alert">
								<strong>Protocol Created</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>                    
							@endif
							<br>
							 <!-- <div align="center"><h3>FOR APPROVAL</h3></div> -->
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th> Protocol Number </th>
										<th> Primary Investigator </th>
										<th> Protocol Name</th>
										<th> Date Created</th>
										<th> Protocol Status</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
									@if(!$prf->isEmpty())
									@foreach($prf as $p)
									<tr>
										<td> {{$p->protocol_no}} </td>
										<td> {{$p->name}} </td>
										<td> {{$p->protocol_name}}</td>
										<td> {{ date("m/d/Y", strtotime($p->date_created)) }}</td>
										<td style="text-align: center;"> @if($p->status == "REJECTED") {{"RESUBMIT"}} @else {{$p->status}} @endif</td>
										<td class="td-actions" style="text-align:center;"><a href="{{url('/prf/view-prf/'.$p->protocol_id)}}" class="btn btn-medium btn-success">VIEW</a></td>
									</tr>
									@endforeach
									@else

									<tr>
										<td colspan="6" style="text-align: center;">No Data Found</td>
									</tr>
									@endif
								
									
								</tbody>
							</table>
							
						</div> <!-- /widget-content -->
						
					</div> <!-- /widget -->



				</div>
			</div>      

		</div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->

@endsection



@section('content_scripts')

