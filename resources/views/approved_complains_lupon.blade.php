@component('mail::message')
    Hello Mr/Ms: {{ $lupon_first_name }} {{ $lupon_middle_name }} {{ $lupon_last_name }}

    Subject: Notice of Hearing

    You are the lupon for the scheduled meeting this {{ $hearing_date }} {{ $hearing_time }}.

    Complainant: {{ $complainant_first_name }} {{ $complainant_middle_name }} {{ $complainant_last_name }}
    Respondent: {{ $respondent_first_name }} {{ $respondent_middle_name }} {{ $respondent_last_name }}

    Thankyou.

    Regards,
    Barangay {{ $barangay }}
@endcomponent
