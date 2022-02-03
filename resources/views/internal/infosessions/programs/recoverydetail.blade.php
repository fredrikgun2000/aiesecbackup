@extends('internal/template')

@section('infosessions/programs/recovery/detail')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div>
        <img id="poster" alt="" width="150" height="210px">
      </div>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-12">
      <small id="datetime"></small>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h3 id="theme"></h3>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-12">
      <img src="" alt="" id="logo_sdgs" width="20px">
      <small id="sdgs" class="ml-2"></small>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <p id="description"></p>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Facultys</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="faculty"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>link meet</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="link_meet"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>link content</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="link_content"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Speaker</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="speaker"></div>
  </div>
</div>

<div class="container">
  <div class="row mt-3">
    <div class="col-12 text-center">
      <button class="bg-biru text-white restoreprogram" >Restore</button>
      <button class="bg-merah text-white deletepermanentprogram">Delete</button>
    </div>
  </div>
</div>

<!-- <link rel="stylesheet" href="/assets/internal/css/infosessions/programs/index.css"> -->
<script src="/assets/internal/js/infosessions/programs/recoverydetail.js"></script>
@endsection