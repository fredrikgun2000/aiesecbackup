@extends('internal/template')

@section('profile')
<h2>Profile</h2>
    <div  class="sender_name"></div>
    <div  class="first_name"></div>
    <div  class="last_name" ></div>
    <div  class="email" ></div>
    <div  class="birthdate" ></div>
    <div  class="join_period" ></div>
    <img class="cropphoto" width="100px" height="100px">

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

<script src="/assets/internal/js/profile/profile.js"></script>
@endsection