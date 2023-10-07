@extends('no.layouts.company_dashboard')
@section('title', 'Registrering av arbeidsområder')
@section('page_heading','Registrering av arbeidsområder')

@section('dashboard-content')
	<form class="form-horizontal" method="POST" action="{{ route('company.register.submit_work_areas') }}">
		{{ csrf_field() }}

		<div class="form-group{{ $errors->has('postnummer') ? ' has-error' : '' }}">
			<label for="postnummer" class="col-md-4 control-label">Postnummer</label>
			<div class="col-md-4">
        <input type="text" class="form-control" name="postnummer[1]" required>
        @for($i=2;$i<9;$i++)
          <input type="text" class="form-control" name="postnummer[{{$i}}]">
        @endfor

				@if ($errors->has('postnummer'))
					<span class="help-block">
						<strong>{{ $errors->first('postnummer') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					Registrer
				</button>
			</div>
		</div>

	</form>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button onclick="location.href='{{ route('company.details') }}'">Avbryt - Ta meg tilbake</button>
		</div>
	</div>
@endsection

@section('scripts')
@stop
