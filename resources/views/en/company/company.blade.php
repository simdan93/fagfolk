@extends('layouts.master')
@section('title', 'Homepage company')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Company Dashboard</div>
	<div class="panel-body">
		<table>
			<tr>
				<a href="{{ route('company.user-requests') }}">User requests</a>
			</tr>
		</table>
		@if($companyDetails == null)
		<table>
			<tr>
				<a href="{{ route('company.fillInfo') }}">Fill in companyinfo</a>
			</tr>
		</table>
		@else
			<h2>Company Details</h2>
			<table border = 1>
				<tr>
					<td>Company Name</td>
					<td>Organization number</td>
					<td>Post number</td>
				</tr>
				@foreach ($companyDetails as $company)
				<tr>
					<td>{{ $company->companyName }}</td>
					<td>{{ $company->orgNumber }}</td>
					<td>{{ $company->postNr }}</td>
				</tr>
				@endforeach
			</table>
			
			<table border = 1>
				<tr>
					<td>Main profession</td>
					<td>Specialization</td>
					<td>Hourly rate</td>
					<td>Attendance rate</td>
				</tr>
				@foreach ($companyDetails as $company)
				<tr>
					<td>{{ $company->professionMain }}</td>
					<td>{{ $company->professionSpec }}</td>
					<td>{{ $company->hourlyRate }}</td>
					<td>{{ $company->attendanceRate }}</td>
				</tr>
				@endforeach
			</table>
			
			<table border = 1>
				<tr>
					<td>Available time</td>
				</tr>
				@foreach ($companyDetails as $company)
				<tr>
					<td>{{ $company->availableFrom }}</td>
				</tr>
				@endforeach
			</table>
			<a href = '/company/update-details/{{ $company->cdID }}'><strong>Edit</strong></a>
		@endif
		
		<h2>Requests submitted to</h2>
		<table border = 1>
			@if($needSubmittedTo != null)
				<tr>
					<td>Name</td>
					<td>Post Number</td>
					<td>Profession</td>
					<td>Specialization</td>
					<td>Hourly Rate</td>
					<td>Available from</td>
					<td>User response</td>
				</tr>
				@foreach ($needSubmittedTo as $needSubmittedTo)
				<tr>
					<td>{{ $needSubmittedTo->fromUserName }}</td>
					<td>{{ $needSubmittedTo->postNr }}</td>
					<td>{{ $needSubmittedTo->professionMain }}</td>
					<td>{{ $needSubmittedTo->professionSpec }}</td>
					<td>{{ $needSubmittedTo->hourlyRate }}</td>
					<td>{{ $needSubmittedTo->availableFrom }}</td>
					@if($needSubmittedTo->accepted == false)
						<td>Not accepted</td>
					@else
						<td>Accepted</td>
					@endif
				</tr>
				@endforeach
			@else
				<p>No requests</p>
			@endif
		</table>
	</div>
</div>
@endsection
