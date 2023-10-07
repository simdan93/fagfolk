@extends('no.layouts.user_dashboard')
@section('page_heading','Oppdatere bruker detaljer')
@section('title', 'Oppdatere bruker detaljer')

@section('dashboard-content')
	<form class="form-horizontal" method="POST" action="/no/bruker/mine-detaljer/oppdater-detaljer/<?php echo $userDetails[0]->id; ?>" >
		{{ csrf_field() }}
		<table>
			<tr>
			   <td>Forname</td>
			   <td>
				  <input type = 'text' name = 'navn'
					 value = '<?php echo $userDetails[0]->navn; ?>'/>
					 @if ($errors->has('navn'))
						<span class="help-block">
							<strong>{{ $errors->first('navn') }}</strong>
						</span>
					@endif
			   </td>
			</tr>
			<tr>
			   <td>Ettername</td>
			   <td>
				  <input type = 'text' name = 'etternavn'
					 value = '<?php echo$userDetails[0]->etternavn; ?>'/>
					 @if ($errors->has('etternavn'))
						<span class="help-block">
							<strong>{{ $errors->first('etternavn') }}</strong>
						</span>
					@endif
			   </td>
			</tr>
			<tr>
			   <td>Alder</td>
			   <td>
				  <select id="alder" name="alder" class="form-control" >
						<option value="<?php echo$userDetails[0]->alder; ?>"><?php echo$userDetails[0]->alder; ?></option>
						<?php $minBirth= date('Y')-16; ?>
						@for ($i = 1950; $i <= $minBirth; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
					 @if ($errors->has('alder'))
						<span class="help-block">
							<strong>{{ $errors->first('alder') }}</strong>
						</span>
					@endif
			   </td>
			</tr>
			<tr>
			   <td>Telefon</td>
			   <td>
				  <input type = 'text' name = 'telefon'
					 value = '<?php echo$userDetails[0]->telefon; ?>'/>
					 @if ($errors->has('telefon'))
						<span class="help-block">
							<strong>{{ $errors->first('telefon') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td>Mobil</td>
			   <td>
				  <input type = 'mobil' name = 'mobil'
					 value = '<?php echo$userDetails[0]->mobil; ?>'/>
					 @if ($errors->has('mobil'))
						<span class="help-block">
							<strong>{{ $errors->first('mobil') }}</strong>
						</span>
					@endif
			   </td>
			</tr>

			<tr>
			   <td colspan = '2'>
				  <input type = 'submit' value = "Oppdater detaljer" />
			   </td>
			</tr>
		 </table>
	</form>
	<button onclick="location.href='{{ route('user.details') }}'">Avbryt</button>
@endsection

@section('right-sidebar-content')
@stop
