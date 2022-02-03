<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class="row">
        <div class="col-4">
            <img src="logobiru.png" width="100%" alt="" srcset="">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p> Hi, AIECERers!<br>
            this is your email account and password.
            make sure you complete your personal data when logging in, and make sure you change the password on your account.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <p>Email :</p>
        </div>
        <div class="col-10">
            <b> {{$email}}<b>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <p>Password :</p>
        </div>
        <div class="col-10">
            <b> {{$password}}<b>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <br>
        you can use your account now. please access the url if there is a problem <br>
        you can contact <b> {{$sendername}} </b> at {{$sendermail}}
        <br><br>
        kind regards,<br>
        {{$sendername}}
    </div>
    
</body>
</html>