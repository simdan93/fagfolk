@component('mail::message')
	{{-- Greeting --}}
	@if (! empty($greeting))
		# {{ $greeting }}
	@else
		@if ($level == 'error')
			# Whoops!
		@else
			# Hei!
		@endif
	@endif

	{{-- Intro Lines --}}
	@foreach ($introLines as $line)
		{{ $line }}
	@endforeach

	{{-- Action Button --}}
	@isset($actionText)
		<?php
			switch ($level) {
				case 'success':
					$color = 'green';
					break;
				case 'error':
					$color = 'red';
					break;
				default:
					$color = 'blue';
			}
		?>
		@component('mail::button', ['url' => $actionUrl, 'color' => $color])
			{{ $actionText }}
		@endcomponent
	@endisset

	{{-- Outro Lines --}}
	@foreach ($outroLines as $line)
		{{ $line }}
	@endforeach

	{{-- Salutation --}}
	@if (! empty($salutation))
		{{ $salutation }}
	@else
		Med vennlig hilsen,<br>
		{{ config('app.name') }}
	@endif

	{{-- Subcopy --}}
	@isset($actionText)
		@component('mail::subcopy')
			Hvis du har problemer med å klikke på "{{ $actionText }}" knappen: 
			Kopier denne URL-en til din nettleser: [{{ $actionUrl }}]({{ $actionUrl }})
		@endcomponent
	@endisset
@endcomponent
