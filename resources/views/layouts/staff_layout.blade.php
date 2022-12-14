<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barangay Information Management System</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    @if ($barangay_logo)
                        <img src="{{ asset('/storage/' . $barangay_logo->logo) }}" alt=""
                            class="img img-thumbnail" style="border:0px;">
                    @else
                    @endif
                </div>
                <div class="sidebar-brand-text mx-3">Barangay {{ $user->barangay->barangay }}</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Pages Collapse Menu -->

            @if ($user->position->title == 'Lupon')
                <li class="nav-item @if ($active == 'official_res_profile') active @else @endif">
                    <a class="nav-link" href="{{ url('official_res_profile', $user->id) }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Resident Profile</span></a>
                </li>

                {{-- <li class="nav-item @if ($active == 'barangay_dashboard') active @else @endif">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Complain</span></a>
                </li> --}}


                <li class="nav-item @if ($active == 'official_complain_report') active @else @endif">
                    <a class="nav-link" href="{{ url('official_complain_report', $user->id) }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Complain Report</span> <span class="badge badge-light">{{ $complain_count }}</span></a>
                </li>
            @elseif($user->position->title == 'Staff')
                {{-- <li class="nav-item @if ($active == 'barangay_dashboard') active @else @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Assistance <span class="badge badge-warning">{{ $assistance_count }}</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ url('official_assistance_type', $user->id) }}">Assistance
                                Type</a>
                            <a class="collapse-item"
                                href="{{ url('official_assistance_request', $user->id) }}">Assistance Request</a>
                        </div>
                    </div>
                </li> --}}
                {{-- <li class="nav-item @if ($active == 'barangay_dashboard') active @else @endif">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Complain</span></a>
                </li> --}}

                <li class="nav-item @if ($active == 'staff_document_request') active @else @endif">
                    <a class="nav-link" href="{{ url('staff_document_request', $user->id) }}">
                        <i class="bi bi-file-earmark"></i>
                        <span>Document Approval</span></a>
                </li>

                <li class="nav-item @if ($active == 'official_assistance_request') active @else @endif">
                    <a class="nav-link" href="{{ url('official_assistance_request', $user->id) }}">
                        <i class="bi bi-person-hearts"></i>
                        <span>Assistance</span></a>
                </li>

                <li class="nav-item @if ($active == 'staff_resident_profile') active @else @endif">
                    <a class="nav-link" href="{{ url('staff_resident_profile', $user->id) }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Resident Profile</span></a>
                </li>

                <li class="nav-item @if ($active == 'staff_complain_report') active @else @endif">
                    <a class="nav-link" href="{{ url('staff_complain_report', $user->id) }}">
                        <i class="bi bi-chat-right-text-fill"></i>
                        <span>Complain Record</span> <span class="badge badge-light">{{ $complain_count }}</span></a>
                </li>

                {{-- <li class="nav-item @if ($active == 'barangay_dashboard') active @else @endif">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Document Archive</span></a>
                </li> --}}

                {{-- <li class="nav-item @if ($active == 'barangay_dashboard') active @else @endif">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>News</span></a>
                </li> --}}
            @elseif($user->position->title == 'Finance')
                <li class="nav-item @if ($active == 'staff_document_request') active @else @endif">
                    <a class="nav-link" href="{{ url('staff_document_request', $user->id) }}">
                        <i class="bi bi-file-earmark"></i>
                        <span>Document Approval</span></a>
                </li>
            @elseif($user->position->title == 'Census')
                <li class="nav-item @if ($active == 'census_register_resident') active @else @endif">
                    <a class="nav-link" href="{{ url('census_register_resident', $user->id) }}">
                        <i class="bi bi-file-earmark"></i>
                        <span>Register Resident</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->first_name }}
                                    {{ $user->last_name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('/storage/' . $user->user_image) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('official_profile/' . $user->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; COC Thesis 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('official_logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>



    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>

</html>
