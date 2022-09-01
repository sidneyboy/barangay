@component('mail::message')
    Hello Mr/Ms: {{ $first_name }} {{ $middle_name }} {{ $last_name }}

    Your requested document {{ $document_name }} has been approved.
    Please go to the barangay and pay the amount of ₱ {{ $document_amount }}

    Regards,
    Barangay {{ $barangay }}
@endcomponent