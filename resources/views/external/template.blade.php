<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIESEC in UKSW</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets/template.css">
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light" style="position: fixed;top: 0px; width: 100%; z-index: 5;">
    <a class="navbar-brand" href="/beranda" pjax>
        <img src="/assets/logo.png" width="150">
    </a>
    <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" id="link-home">
                <a class="nav-link px-2">Home</a>
            </li>
            <li class="nav-item" id="link-about">
                <a class="nav-link px-2">About</a>
            </li>
            <li class="nav-item" id="link-member">
                <a class="nav-link px-2">Member</a>
            </li>
            <li class="nav-item dropdown show">
                <a class="nav-link ml-2 dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>Hai, <b> Fredrik Gunawan</b></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                    <i class="fa fa-power-off mr-1" id="logout">LogOut</i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div style="max-width:100%;">
    @yield('home')
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>