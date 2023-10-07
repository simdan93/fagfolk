@extends('no.layouts.user_dashboard')
@section('page_heading','Oppdatering av hjemmeaddresse')
@section('title', 'Oppdatering av hjemmeaddresse')

@section('dashboard-content')
	<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-hjemmeaddresse/<?php echo $homeAddress[0]->id; ?>" >
		{{ csrf_field() }}
		<table>
			<tr>
			   <td>Address</td>
			   <td>
				  <input type = 'text' name = 'addresse'
					 value = '<?php echo $homeAddress[0]->addresse; ?>'/>
					 @if ($errors->has('addresse'))
						<span class="help-block">
							<strong>{{ $errors->first('addresse') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td>Post Nr</td>
			   <td>
				  <input type = 'text' name = 'postnummer'
					 value = '<?php echo$homeAddress[0]->postnummer; ?>'/>
					 @if ($errors->has('postnummer'))
						<span class="help-block">
							<strong>{{ $errors->first('postnummer') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td>Location</td>
			   <td>
				  <input type = 'text' name = 'sted'
					 value = '<?php echo $homeAddress[0]->sted; ?>'/>
					 @if ($errors->has('sted'))
						<span class="help-block">
							<strong>{{ $errors->first('sted') }}</strong>
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
@endsection

@section('right-sidebar-content')
@stop
