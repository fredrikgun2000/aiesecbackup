@extends('internal/template')

@section('infosessions/forms/detail')
<div class="bg-biru py-5" style="min-height:800px;">
  <div class="container pt-5" >
    <div class="row">
      <div class="col-12">
        <i class="display-none exclamation fa fa-exclamation-circle text-light"> If You Want To Update This Form Make Sure You Already Cancel Publish. </i>
      </div>
    </div>
    <div class="row">
      <div class="col-12" id="place_section"></div>
    </div>

    <div class="row mt-3">
      <div class="col-12 text-center">
        <button class="bg-light biru createsection fa fa-plus py-1"></button>
        <button class="bg-light merah deleteform fa fa-trash py-1"></button>
        <button class="bg-light hijau publishform"></button>
      </div>
    </div>
  </div>
</div>



<link rel="stylesheet" href="/assets/internal/css/infosessions/forms/index.css">
<script src="/assets/internal/js/infosessions/forms/detail.js"></script>
@endsection