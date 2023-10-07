@component('mail::message')
# User request

A request matches your profile

@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/user', 'color' => 'green'])
Go to site
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
