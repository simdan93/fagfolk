@extends('layouts.master')
@section('title', 'Homepage')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">USER Dashboard</div>
	<div class="panel-body">
		<table>
			<tr>
				<td><a href="{{ route('findHelp') }}">Find help</a></td>
			</tr>
			<tr>
				<td><a href="{{ route('user.details') }}">My details</a></td>
			</tr>
		</table>
		<?php echo App::getLocale();?>
		<h2>My Needs</h2>
		@if($myNeeds != null)
			<table border = 1>
				<tr>
					<td>Profession</td>
					<td>Specialization</td>
					<td>Post Number</td>
					<td>Hourly rate</td>
					<td>Attendance Rate</td>
					<td>Available from</td>
					<td></td>
					<td></td>
				</tr>
				@foreach ($myNeeds as $myNeed)
				<tr>
					<td>{{ $myNeed->professionMain }}</td>
					<td>{{ $myNeed->professionSpec }}</td>
					<td>{{ $myNeed->postNr }}</td>
					<td>{{ $myNeed->hourlyRate }}</td>
					<td>{{ $myNeed->attendanceRate }}</td>
					<td>{{ $myNeed->availableFrom }}</td>
					<td><a href= '/user/update-help/{{ $myNeed->nID }}'>Update</a></td>
					<td><a href= '/user/delete-help/{{ $myNeed->nID }}'>Delete</a></td>
				</tr>
			</table>
			@endforeach
		@else
			<p>No requests</p>
		@endif
		
		<h2>Responses</h2>
		@if($responseInfo != null)
			<table border = 1>
				<tr>
					<td>Company Name</td>
					<td>Organization Number</td>
					<td>Post Number</td>
					<td>Profession</td>
					<td>Specialization</td>
					<td>Hourly Rate</td>
					<td>Attendance Rate</td>
					<td>Available from</td>
				</tr>
				@foreach ($responseInfo as $responseInfo)
					@if($responseInfo->ignored == false)
						<tr>
							<td>{{ $responseInfo->companyName }}</td>
							<td>{{ $responseInfo->orgNumber }}</td>
							<td>{{ $responseInfo->postNr }}</td>
							<td>{{ $responseInfo->professionMain }}</td>
							<td>{{ $responseInfo->professionSpec }}</td>
							<td>{{ $responseInfo->hourlyRate }}</td>
							<td>{{ $responseInfo->attendanceRate }}</td>
							<td>{{ $responseInfo->availableFrom }}</td>
							@if($responseInfo->accepted == true)
								<td>Accepted</td>
							@else
								<td><a href= '/user/accept-response/{{ $responseInfo->rID }}'>Accept | </a><a href= '/user/ignore-response/{{ $responseInfo->rID}}'>Ignore response</a></td>
							@endif
						</tr>
					@endif
					<a href= '/user/test-mail/{{ $responseInfo->rID }}'>Test mail</a>
				@endforeach
			</table>
		@else
			<p>No responses</p>
		@endif
	</div>
</div>
@endsection
