@extends('layouts.master')
@section('title', 'Homepage company user request')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">COMPANY User Request</div>
		<div class="panel-body">
			@if($needs == null)
				<p>No request matching your criterias</p>
			@else
				<table border = 1>
					 <tr>
						<td>Name</td>
						<td>Post Number</td>
						<td>Profession</td>
						<td>Specialization</td>
						<td>Hourly Rate</td>
						<td>Available from</td>
						<td>Submit availabillity</td>
					 </tr>
					 @foreach ($needs as $need)
					 	<tr>
							<td>{{ $need->fromUserName }}</td>
							<td>{{ $need->postNr }}</td>
							<td>{{ $need->professionMain }}</td>
							<td>{{ $need->professionSpec }}</td>
							<td>{{ $need->hourlyRate }}</td>
							<td>{{ $need->availableFrom }}</td>
							@if( $need->nID == $need->needID )
								<td>Request submitted to</td>
							@else
								<td><a href= '/company/accept-request/{{ $need->fromUserID }}'>Submit</td>
							@endif
						</tr>
					@endforeach
				</table>
			@endif
			
			<button onclick="location.href='{{ route('company.dashboard') }}'">Go back</button>
		</div>
   </div>
</div>
@endsection
