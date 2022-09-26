<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Barangay Information & Management System</title>
</head>

<body onload="getLocation()"
    style="background-image: url({{ asset('/storage/modern-building-office-blue-sky-background_35761-198.jpg') }});-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;">
    <br />
    <div class="container">
        {{-- <center>
        <img src="{{ asset('/storage/barangay_logo.jpeg') }}"
            style="width:60px;
        float: left; 
        margin-left: 30px;border:0px;" alt="">
        <div style="font-size: 20px;color:black">Barangay Information Management System</div>
    </center> --}}
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('/storage/barangay_logo.jpeg') }}" style="width:60px;margin-left:410px;"
                    class="img img-thumbnail">
            </div>
            <div class="col-md-7">
                <div style="font-size: 20px;color:black" class="float-left">
                    Barangay Information<br /> Management System
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container" style="width:100%;">
        <br />
        <div class="card" style="width: 100%;border-radius: 30px;">
            <h6 class="card-header">Barangay Info & Management System Portal</h6>
            <div class="card-body">
                <form action="{{ route('proceeding') }}" method="get">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Region</label>
                                <select name="regCode" class="form-control" id="regCode" required>
                                    <option value="" default>Select</option>
                                    @foreach ($region as $data)
                                        <option value="{{ $data->regCode }}">{{ $data->regDesc }}</option>
                                    @endforeach
                                </select>

                                <div id="show_province"></div>
                                <div id="show_city"></div>
                                <div id="show_barangay"></div>

                                <label for="">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" required>

                                <label for="">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <button type="submit"
                                class="btn btn-submit btn-success btn-sm float-right">Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


    <div class="row justify-content-center">
        <div class="col-md-6">
            <br />
            <div class="card" style="width: 100%;border-radius: 30px;">
                <h6 class="card-header">
                    {{-- <center style="font-weight:bold;">Barangay Info & Management System Portal</center> --}}
                    <ul style="list-style-type: none;">
                        <li><center>This site is only for authorized barangay personnel.</center></li>
                        <li><center>Welcome to the system, you may now register your barangay.</center></li>
                        <li>Remember that you only register your barangay once for security
                            purposes.</li>
                    </ul>
                </h6>
                <div class="card-body">
                    <form action="{{ route('proceeding') }}" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="regCode" class="form-control" id="regCode" required>
                                        <option value="" default>Select</option>
                                        @foreach ($region as $data)
                                            <option value="{{ $data->regCode }}">{{ $data->regDesc }}</option>
                                        @endforeach
                                    </select>

                                    <div id="show_province"></div>
                                    <div id="show_city"></div>
                                    <div id="show_barangay"></div>

                                    <label for="">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" required>

                                    <label for="">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br />
                                <button type="submit"
                                    class="btn btn-submit btn-success btn-sm float-right">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#regCode").change(function() {
            var regCode = $(this).val();
            $.post({
                type: "POST",
                url: "/barangay_admin_get_province",
                data: 'regCode=' + regCode,
                success: function(data) {
                    console.log(data);
                    $('#show_province').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });




        // var x = document.getElementById("latitude");
        // var y = document.getElementById("longitude");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }


        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
        }
    </script>

</body>

</html>
