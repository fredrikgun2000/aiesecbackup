<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIESEC in UKSW</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="shortcut icon" href="/assets/logobiru.png"/>

    <link  href="/assets/plugin/cropper.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/plugin/cropper.js"></script>

    <link rel="stylesheet" href="/assets/template.css">
</head>
<body>
    
<div style="position: fixed; top:0; z-index: 999; width: 100%; height:750px; background-color:rgba(0,0,0,0.6); display:none; " id="loading">
    <img src="https://pmb.uinsgd.ac.id/wp-content/plugins/event-calendar-wd/assets/loading.gif" alt="" width="10%" style="margin-top:300px; margin-left:45%;">
</div>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/AIESEC" pjax>
        <img src="/assets/logo.png" width="150">
    </a>
    <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" id="link-home">
                <a class="nav-link px-2" href="/AIESEC">Home</a>
            </li>

            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Master
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Members</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#">Account Access</a>
                                <a class="dropdown-item" href="/AIESEC/members/account-role">Account Department & Role</a>
                                <a class="dropdown-item" href="/AIESEC/members/member-account" >Member Account</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="/AIESEC/booklets">Booklets</a>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="/AIESEC/destinations">Destinations</a>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Projects</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="/AIESEC/projects/">Projects</a>
                                <a class="dropdown-item" href="/AIESEC/projects/activities">Project Activities</a>
                                <a class="dropdown-item" href="/AIESEC/projects/fees">Project Fees</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Exchange Participant</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#">EPs Account</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Events</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Info Sessions</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="/AIESEC/infosessions/programs/">Programs</a>
                                        <a class="dropdown-item" href="/AIESEC/infosessions/forms/">Forms</a>
                                        <a class="dropdown-item" href="/AIESEC/infosessions/speakers/">Speakers</a>
                                        <a class="dropdown-item" href="/AIESEC/infosessions/sertifikat/">Sertifikat</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Activate the Youths</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="/AIESEC/activatetheyouth/programs/">Programs</a>
                                        <a class="dropdown-item" href="/AIESEC/activatetheyouth/forms/">Forms</a>
                                        <a class="dropdown-item" href="/AIESEC/activatetheyouth/speakers/">Speakers</a>
                                        <a class="dropdown-item" href="/AIESEC/activatetheyouth/Sertificate/">Sertificate</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            

            <li class="nav-item" id="link-login">
                <button class="nav-link bg-biru text-light mt-2">Sign In</button>
            </li>

            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span id="profile-full-name"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="/AIESEC/profile">
                            <span class="fa fa-user"></span>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="javascript:void(0);" id="logout">
                            <span class="fa fa-power-off"></span>
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>



<div style="max-width:100%;">
    @yield('home')

    <!-- profile -->
    @yield('profile')

    <!-- master -->
    <!-- members -->
    <!-- department & role -->
    @yield('members/account-role')
    @yield('members/account-role/department/recovery')
    @yield('members/account-role/role/recovery')
    @yield('members/member-account')
    @yield('members/member-account/recovery')

    <!-- destinations -->
    @yield('destinations')
    @yield('destinations/recovery')

    <!-- projects -->
    @yield('projects')
    @yield('projects/detail')
    @yield('projects/recovery')
    @yield('projects/activities')
    @yield('projects/activities/recovery')
    @yield('projects/fees')
    @yield('projects/fees/recovery')

    <!-- Booklet -->
    @yield('booklets')
    @yield('booklets/recovery')
    
    <!-- Infosession -->
    @yield('infosessions/programs')
    @yield('infosessions/programs/detail')
    @yield('infosessions/programs/recovery')
    @yield('infosessions/programs/recovery/detail')
    @yield('infosessions/speakers')
    @yield('infosessions/speakers/recovery')
    @yield('infosessions/forms')
    @yield('infosessions/forms/detail')
    @yield('infosessions/questions')
    @yield('infosessions/forms/recovery')
    @yield('infosessions/questions/recovery')
</div>


    <script src="/assets/plugin/jquery.session.js"></script>
    <script src="/assets/plugin/jquery.md5.js"></script>

    <script src="/assets/template.js"></script>
</body>
</html>