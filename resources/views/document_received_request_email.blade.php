@component('mail::message')
    Hello Mr/Ms: {{ $first_name }} {{ $middle_name }} {{ $last_name }}

    You have successfully received the requested document {{ $document_name }}.
    Thank you.

    Regards,
    Barangay {{ $barangay }}
@endcomponent