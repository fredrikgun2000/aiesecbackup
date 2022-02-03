<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIESEC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link  href="/assets/plugin/cropper.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/template.css">
</head>
<body>

<h2>Complete Your Profile First</h2>


<i class="fa fa-user cropphoto"></i>

<form id="updateprofile" method="POST">
    @csrf 
    <input type="hidden" name="member_id" class="member_id">
    <input type="text" name="first_name" class="first_name" placeholder="First Name">
    <input type="text" name="last_name" class="last_name" placeholder="Last Name">
    <input type="date" name="birthdate" class="birthdate" placeholder="Birthdate">
    <button type="submit">Save</button>
</form>

<form id="updatepasswordprofile" method="POST">
    @csrf
    <input type="hidden" name="member_id" class="member_id">
    <input type="password" name="password" placeholder="Password">
    <i class="fas fa-eye" id="eye"></i>
    <button type="submit">Save</button>
</form>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-11 col-md-10 col-sm-10 mr-1">
            <img id="sample_image" alt="aaaa" width="100%">
          </div>
        </div>
        <form id="updatephotoprofile" method="POST">
            @csrf
            <input type="hidden" name="member_id" class="member_id">
            <input type="hidden" name="first_name" class="first_name">
            <input type="file" name="photo" id="photo" class="invisible">
            <input type="hidden" name="cropphoto" class="cropphoto">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="bg-hitam text-light" data-dismiss="modal">Close</button>
        <button type="button" class="bg-biru text-light" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script src="/assets/plugin/jquery.session.js"></script>
    <script src="/assets/plugin/cropper.js"></script>
    
    <script src="/assets/internal/js/profile/completeprofile.js"></script>
</body>
</html>