@extends('no.layouts.user_dashboard')
@section('page_heading','Oppdatering av fakturaddresse')
@section('title', 'Oppdatering av fakturaddresse')

@section('dashboard-content')
	<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-fakturaaddresse/<?php echo $payAddress[0]->id; ?>" >
		{{ csrf_field() }}
		<table>
			<tr>
			   <td>Address</td>
			   <td>
				  <input type = 'text' name = 'faktura_addresse'
					 value = '<?php echo $payAddress[0]->faktura_addresse; ?>'/>
					 @if ($errors->has('faktura_addresse'))
						<span class="help-block">
							<strong>{{ $errors->first('faktura_addresse') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td>Post Nr</td>
			   <td>
				  <input type = 'text' name = 'faktura_postnummer'
					 value = '<?php echo$payAddress[0]->faktura_postnummer; ?>'/>
					 @if ($errors->has('faktura_postnummer'))
						<span class="help-block">
							<strong>{{ $errors->first('faktura_postnummer') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td>Location</td>
			   <td>
				  <input type = 'text' name = 'faktura_by'
					 value = '<?php echo $payAddress[0]->faktura_by; ?>'/>
					 @if ($errors->has('faktura_by'))
						<span class="help-block">
							<strong>{{ $errors->first('faktura_by') }}</strong>
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
