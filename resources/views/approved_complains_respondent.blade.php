@component('mail::message')
    Hello Mr/Ms: {{ $respondent_first_name }} {{ $respondent_middle_name }} {{ $respondent_last_name }}

    There is a complain from complainant {{ $complainant_first_name }} {{ $complainant_middle_name }} {{ $complainant_last_name }}
    and is set on {{ $hearing_date }} {{ $hearing_time }}.
    Please be there 30 mins Earlier.

    Thankyou.

    Regards,
    Barangay {{ $barangay }}
@endcomponent
