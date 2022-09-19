@component('mail::message')
    Hello Mr/Ms: {{ $first_name }} {{ $middle_name }} {{ $last_name }}

    {{ $reason }}

    Regards,
    Barangay {{ $barangay }}
@endcomponent