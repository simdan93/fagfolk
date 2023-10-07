@extends('layouts.master')
@section('title', 'Updating of companydetails')

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Update company details</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="/company/update-details/<?php echo $companyDetails[0]->cdID; ?>" >
							{{ csrf_field() }}
							<table>
								<tr>
								   <td>Company name</td>                                          
								   <td>
									  <input type = 'text' name = 'companyName' 
										 value = '<?php echo $companyDetails[0]->companyName; ?>'/>
										 @if ($errors->has('companyName'))
											<span class="help-block">
												<strong>{{ $errors->first('companyName') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Org. Number</td>                                          
								   <td>
									  <input type = 'text' name = 'orgNumber' 
										 value = '<?php echo$companyDetails[0]->orgNumber; ?>'/>
										 @if ($errors->has('orgNumber'))
											<span class="help-block">
												<strong>{{ $errors->first('orgNumber') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Post nr</td>                                          
								   <td>
									  <input type = 'text' name = 'postNr' 
										 value = '<?php echo $companyDetails[0]->postNr; ?>'/>
										 @if ($errors->has('postNr'))
											<span class="help-block">
												<strong>{{ $errors->first('postNr') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Profession</td>                                          
								   <td>
								   		<select id="professionMain" name="professionMain" value ='<?php echo$companyDetails[0]->professionMain; ?>' >
											<?php $mainProfessions = array('Carpenter', 'Electrician', 'Plumber', 'Mechanic', 'Chief'); ?>
											@foreach($mainProfessions as $mainProfession)
												<option value='{{ $mainProfession }}'>{{ $mainProfession }}</option>
											@endforeach
										</select>
										@if ($errors->has('professionMain'))
											<span class="help-block">
												<strong>{{ $errors->first('professionMain') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Specialization</td>                                          
								   <td>
									   <select id="professionSpec" name="professionSpec" value ='<?php echo$companyDetails[0]->professionSpec; ?>' >
											<?php $professionSpecs = array('Buildings', 'Furniture', 'Kitchen', 'Interior'); ?>
											@foreach($professionSpecs as $professionSpec)
												<option value='{{ $professionSpec }}'>{{ $professionSpec }}</option>
											@endforeach
										</select>
										@if ($errors->has('professionSpec'))
											<span class="help-block">
												<strong>{{ $errors->first('professionSpec') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Hourly Rate</td>                                          
								   <td>
									  <input type = 'text' name = 'hourlyRate' 
										 value = '<?php echo$companyDetails[0]->hourlyRate; ?>'/>
										 @if ($errors->has('hourlyRate'))
											<span class="help-block">
												<strong>{{ $errors->first('hourlyRate') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Attendance Rate</td>                                          
								   <td>
									  <input type = 'text' name = 'attendanceRate' 
										 value = '<?php echo$companyDetails[0]->attendanceRate; ?>'/>
										 @if ($errors->has('attendanceRate'))
											<span class="help-block">
												<strong>{{ $errors->first('attendanceRate') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								
								<tr>
								   <td>Available from</td>                                          
								   <td>
									  <input id = 'datepicker' type = 'text' name = 'availableFrom' 
										 value = '<?php echo$companyDetails[0]->availableFrom; ?>'/>
										 @if ($errors->has('availableFrom'))
											<span class="help-block">
												<strong>{{ $errors->first('availableFrom') }}</strong>
											</span>
										@endif
								   </td>
								</tr>
								<tr>
								   <td colspan = '2'>
									  <input type = 'submit' value = "Update details" />
								   </td>
								</tr>
							 </table>
						</form>
						 <button onclick="location.href='{{ route('company.dashboard') }}'">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$( function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd/mm/yy"
		});
	} );
</script>
@stop