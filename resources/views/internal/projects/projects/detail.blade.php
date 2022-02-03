@extends('internal/template')

@section('projects/detail')
<div class="row">
  <div class="col-12">
    <div id="banner"></div>
  </div>
</div>

<div class="container">
  <div class="row mt-2">
    <div class="col-12">
      <small id="typeofproject"></small>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h3 id="title"></h3>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <small id="destination"></small>
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
      <h6>Working Hours</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="working_hour"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Project Activities</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="project_activities"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Accomodation</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="accomodation"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Fee</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="fee"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <h6>Benefit</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-12" id="benefit"></div>
  </div>
</div>


<link rel="stylesheet" href="/assets/internal/css/projects/projects/index.css">
<script src="/assets/internal/js/projects/projects/detail.js"></script>
@endsection