@component('mail::message')
    Hello Mr/Ms: {{ $first_name }} {{ $last_name }}

    We are happy to tell you that you are now registered in our 
    Barangay Information and Management System.

    Here are your credentials:
    email: {{ $email }}
    password: {{ $password }}

    Regards,
    {{ $barangay }}
@endcomponent