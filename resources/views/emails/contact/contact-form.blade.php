@component('mail::message')

# Your New Message

<strong>Name:</strong> {{ $data['name'] }} <br>
<strong>Email:</strong> {{ $data['email'] }} <br>
<strong>Message:</strong> {{ $data['message'] }}

@endcomponent