@extends('layouts.master')
@section('title', 'Updating of pay address')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Update pay address</div>
	<div class="panel-body">
		<form class="form-horizontal" method="POST" action="/en/user/my-details/update-pay-address/<?php echo $payAddress[0]->ppaID; ?>" >
			{{ csrf_field() }}
			<table>
				<tr>
				   <td>Address</td>                                          
				   <td>
					  <input type = 'text' name = 'address' 
						 value = '<?php echo $payAddress[0]->address; ?>'/>
						 @if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
						@endif
				   </td>
				</tr>
				
				<tr>
				   <td>Post Nr</td>                                          
				   <td>
					  <input type = 'text' name = 'postNr' 
						 value = '<?php echo$payAddress[0]->postNr; ?>'/>
						 @if ($errors->has('postNr'))
							<span class="help-block">
								<strong>{{ $errors->first('postNr') }}</strong>
							</span>
						@endif
				   </td>
				</tr>
				
				<tr>
				   <td>Location</td>                                          
				   <td>
					  <input type = 'text' name = 'location' 
						 value = '<?php echo $payAddress[0]->location; ?>'/>
						 @if ($errors->has('location'))
							<span class="help-block">
								<strong>{{ $errors->first('location') }}</strong>
							</span>
						@endif
				   </td>
				</tr>
				
				<tr>
				   <td colspan = '2'>
					  <input type = 'submit' value = "Update address" />
				   </td>
				</tr>
			 </table>
		</form>
		<button onclick="location.href='{{ route('user.details') }}'">Cancel</button>
	</div>
</div>
@endsection