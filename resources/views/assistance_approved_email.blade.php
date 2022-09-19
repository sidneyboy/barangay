@component('mail::message')
    Hello Mr/Ms: {{ $first_name ." ". $middle_name ." ". $last_name }} 

    We are happy to inform you that your {{ $assistance_title }}
    has been approved. Please go to our office and bring 2 valid ID.

    Regards,
    {{ $barangay }}
@endcomponent