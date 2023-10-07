@extends('layouts.master')
@section('title', 'Updating of user details')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Update user details</div>
		<div class="panel-body">
			<form class="form-horizontal" method="POST" action="/en/user/my-details/update-details/<?php echo $userDetails[0]->id; ?>" >
				{{ csrf_field() }}
				<table>
					<tr>
					   <td>Name</td>                                          
					   <td>
						  <input type = 'text' name = 'name' 
							 value = '<?php echo $userDetails[0]->name; ?>'/>
							 @if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
					   </td>
					</tr>
					<tr>
					   <td>Last Name</td>                                          
					   <td>
						  <input type = 'text' name = 'lastName' 
							 value = '<?php echo$userDetails[0]->lastName; ?>'/>
							 @if ($errors->has('lastName'))
								<span class="help-block">
									<strong>{{ $errors->first('lastName') }}</strong>
								</span>
							@endif
					   </td>
					</tr>
					<tr>
					   <td>Age</td>                                          
					   <td>
						  <select id="age" name="age" class="form-control" >
						  		<option value="<?php echo$userDetails[0]->age; ?>"><?php echo$userDetails[0]->age; ?></option>									
						  		<option value=""></option>
								<?php $minBirth= date('Y')-16; ?>
								@for ($i = 1950; $i <= $minBirth; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
							 @if ($errors->has('age'))
								<span class="help-block">
									<strong>{{ $errors->first('age') }}</strong>
								</span>
							@endif
					   </td>
					</tr>
					<tr>
					   <td>Phone</td>                                          
					   <td>
						  <input type = 'text' name = 'phone' 
							 value = '<?php echo$userDetails[0]->phone; ?>'/>
							 @if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->first('phone') }}</strong>
								</span>
							@endif
					   </td>
					</tr>
					
					<tr>
					   <td>Cell</td>                                          
					   <td>
						  <input type = 'text' name = 'cell' 
							 value = '<?php echo$userDetails[0]->cell; ?>'/>
							 @if ($errors->has('cell'))
								<span class="help-block">
									<strong>{{ $errors->first('cell') }}</strong>
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
			<button onclick="location.href='{{ route('user.details') }}'">Cancel</button>
		</div>
	</div>
</div>
@endsection