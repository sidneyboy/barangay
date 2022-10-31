<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <p style="margin: 0in 0in 0.0001pt; font-size: 15px; font-family: Calibri, sans-serif; text-align: center;"><span
            style='font-size:19px;font-family:"Cambria",serif;color:black;'>Republic of the Philippines</span></p>
    <p style='margin:0in;margin-bottom:.0001pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><span
            style='font-size:19px;font-family:"Cambria",serif;color:black;'>City of Cagayan de Oro</span></p>
    <p style='margin:0in;margin-bottom:.0001pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><span
            style='font-size:21px;font-family:"Cooper Black",serif;color:black;text-transform:uppercase'>BARANGAY
            {{ $resident->barangay->barangay }}</span></p>
    {{-- <p style='margin:0in;margin-bottom:.0001pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
        <em><span style='font-size:12px;font-family:"Book Antiqua",serif;color:#C00000;'>Email</span></em><em><span
                style='font-size:12px;font-family:"Book Antiqua",serif;'>:&nbsp;</span></em><a
            href="mailto:BarangayCugman@gmail.com"><em><span
                    style='font-size:12px;font-family:"Book Antiqua",serif;'>BarangayCugman@gmail.com</span></em></a>
    </p>
    <p style='margin:0in;margin-bottom:.0001pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
        <em><span style='font-size:12px;font-family:"Book Antiqua",serif;color:#C00000;'>FB:</span></em><em><span
                style='font-size:12px;font-family:"Book Antiqua",serif;'>&nbsp;</span></em><a
            href="http://SangguniangBarangayofCugman"><em><span
                    style='font-size:12px;font-family:"Book Antiqua",serif;'>SangguniangBarangayofCugman</span></em></a>
    </p> --}}
    <p style='margin:0in;margin-bottom:.0001pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><span
            style='font-size:21px;font-family:"Bodoni MT Black",serif;color:black;'>OFFICE OF THE PUNONG BARANGAY</span>
    </p>
    <hr style="border: 1px solid;">
    <div class="row">
        <div class="col-md-4">
            <table class="table" style="text-align: center;border: 1.5px solid;margin-left:10px;">
                <tr>
                    <th style="color:red;">BARANGAY OFFICIALS</th>
                </tr>
                @foreach ($barangay_officials as $data)
                    <tr>
                        @if ($data->position->title == 'Chairman')
                            <th style="line-height: 1px;font-size:13px;border: 0px;">
                                <p style="color:orange;text-transform:uppercase">HON. {{ $data->first_name }}
                                    {{ $data->middle_name }}.
                                    {{ $data->last_name }}</p>
                                <p style="color:blue;">PUNONG BARANGAY</p>
                                <p style="color:blue;">Overall Chairman</p>
                            </th>
                        @else
                            <th style="line-height: 1px;font-size:13px;border: 0px;">
                                <p style="color:orange;text-transform:uppercase">HON. {{ $data->first_name }}
                                    {{ $data->middle_name }}.
                                    {{ $data->last_name }}</p>
                                <p style="color:blue;">{{ $data->position->title }}</p>
                                <p style="color:blue;">{{ $data->position->description }}</p>
                            </th>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-8">
            <h2 style="text-align: center;">BARANGAY CLEARANCE</h2>
            <center>
                <img src="{{ asset('/storage/' . $resident->user_image) }}" class="img img-thumbnail"
                    style="border:0px;height:200px;width:200px;">
            </center>
            <br />
            <p
                style='margin-top:0in;margin-right:0in;margin-bottom:10.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;text-indent:.5in;'>
                <span style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>This is to
                    certify according to the records of this offi</span><span
                    style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;'>ce
                    that</span><strong><span
                        style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;text-transform:uppercase;'>&nbsp;{{ $resident->first_name }}
                        {{ $data->middle_name }} {{ $data->last_name }}</span></strong><strong><span
                        style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;'>,

                        @php
                            $dateOfBirth = $resident->birth_date;
                            $today = date('Y-m-d');
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            echo $diff->format('%y');
                        @endphp




                        &nbsp;</span></strong><span
                    style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;text-transform:uppercase'>years
                    old<strong>,
                        {{ $resident->gender }}, {{ $resident->civil_status }},</strong>&nbsp;</span><span
                    style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>whose picture
                    appears above, is a bona fide, is a resident of Zone 9 Cugman</span><span
                    style='line-height:115%;font-family:"Book Antiqua",serif;color:black;'>,</span><span
                    style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>&nbsp;Cagayan
                    de Oro City.</span>
            </p>
            <p
                style='margin-top:0in;margin-right:0in;margin-bottom:10.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;text-indent:.5in;'>
                <span style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>Has not been
                    accused of any crime/misdemeanor nor he/she a part to any pending mediation/conciliation proceeding
                    in this office.</span>
            </p>
            <p
                style='margin-top:0in;margin-right:0in;margin-bottom:10.0pt;margin-left:0in;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;text-indent:.5in;'>
                <span style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>This
                    <u>CLEARANCE</u> is issued of the above mentioned name for</span><strong><span
                        style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;'>&nbsp;{{ $document->reason }}&nbsp;</span></strong><span
                    style='font-size:16px;line-height:115%;font-family:"Cambria",serif;color:black;'>purpose</span><span
                    style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>(s).</span>
            </p>
            <p><span style='font-size:16px;line-height:115%;font-family:"Book Antiqua",serif;color:black;'>Done this
                    22<sup>nd</sup> day of August 2022, at {{ $resident->barangay->barangay }} Barangay Hall, and Cagayan de Oro City. &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp;&nbsp;</span></p>

            <br />
            @foreach ($barangay_officials as $data)
                @if ($data->position->title == 'Chairman')
                    <span class="float-right">
                        <p style="font-weight: bold;text-transform:uppercase">{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</p>
                        <i>Punong Barangay</i>
                    </span>
                @endif
            @endforeach
        </div>
    </div>
    <br />
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script>
    window.print();
</script>

</html>
