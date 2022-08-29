@component('mail::message')
    Hello Mr/Ms: {{ $complainant_first_name }} {{ $complainant_middle_name }} {{ $complainant_last_name }}

    Your Complain has been approved and is set on {{ $hearing_date }}
    {{ $hearing_time }} with respondent {{ $respondent_first_name }} {{ $respondent_middle_name }} {{ $respondent_last_name }}. Please be there 30 mins Earlier.

    Thankyou.
    
    Regards,
    Barangay {{ $barangay }}
@endcomponent