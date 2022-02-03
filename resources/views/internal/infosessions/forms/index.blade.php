@extends('internal/template')

@section('infosessions/forms')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Infosessions</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Members page is it for AIESEC member's can manage data.</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-center">
            <h4>Forms</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/infosessions/forms/recovery">
              <button class="border-merah merah">
                <i class="fas fa-trash-restore"></i>
              </button>
            </a>
            <button class="border-biru biru" data-toggle="modal" data-target="#createmodal">
              <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="row" id="read-form">
          </div>
        </div>
    </div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formform">
            <div class="modal-body">
                @csrf
                <select name="program_id" id="selectprogram" class="select"></select>
                <input type="text" name="title" id="title" class="input" placeholder="title">
                <textarea name="description" id="description" placeholder="description"></textarea>
                <select name="type" id="type">
                  <option value="">Choose Type</option>
                  <option value="registration">Resgistration</option>
                  <option value="evaluation">Evaluation</option>
                </select>
                <img src="/assets/internal/images/development/image.png" alt="" width="100px" class="cropbanner">
                <input type="hidden" name="cropbanner" class="cropbanner">
                <input type="file" id="banner" class="banner invisible" name="banner" style="width:0px;">
              </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Save Data</button>
            </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalbanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <img id="sample_banner" alt="aaaa" width="100%">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="bg-hitam text-light" data-dismiss="modal">Close</button>
        <button type="button" class="bg-biru text-light" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>

<script src="/assets/internal/js/infosessions/forms/index.js"></script>
@endsection