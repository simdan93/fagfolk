@extends('layouts.master')
@section('title', 'Updating of need details')

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Update of need details</div>
					<div class="panel-body">
					
						<form class="form-horizontal" method="POST" action="/user/update-help/<?php echo $needsInfo[0]->id; ?>" >
							{{ csrf_field() }}
							<table>
								<tr>
								   <td>Main Profession</td>                                          
								   <td>
									  <input type = 'text' name = 'professionMain' 
										 value = '<?php echo$needsInfo[0]->professionMain; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td>Specialization</td>                                          
								   <td>
									  <input type = 'text' name = 'professionSpec' 
										 value = '<?php echo$needsInfo[0]->professionSpec; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td>Post Number</td>                                          
								   <td>
									  <input type = 'text' name = 'postNr' 
										 value = '<?php echo $needsInfo[0]->postNr; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td>Hourly Rate</td>                                          
								   <td>
									  <input type = 'text' name = 'hourlyRate' 
										 value = '<?php echo$needsInfo[0]->hourlyRate; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td>Attendance Rate</td>                                          
								   <td>
									  <input type = 'text' name = 'attendanceRate' 
										 value = '<?php echo$needsInfo[0]->attendanceRate; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td>Available from</td>                                          
								   <td>
									  <input type = 'text' name = 'availableFrom' 
										 value = '<?php echo$needsInfo[0]->availableFrom; ?>'/>
								   </td>
								</tr>
								<tr>
								   <td colspan = '2'>
									  <input type = 'submit' value = "Update details" />
								   </td>
								   
								</tr>
								<tr>
									<td colspan = '2'>
									   <button onclick="location.href='{{ route('user.dashboard') }}'">Go back</button>
									</td>
								</tr>
							 </table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection