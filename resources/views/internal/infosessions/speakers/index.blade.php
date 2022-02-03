@extends('internal/template')

@section('infosessions/speakers')
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
            <h4>Speakers</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/infosessions/speakers/recovery">
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
            <table id="table-speaker" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Theme Infosession</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Profession</th>
                        <th scope="col">Title</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Description</th>
                        <th scope="col">Photo</th>
                    </tr>
                </thead>
                <tbody id="read-speaker">
                </tbody>
            </table>
        </div>
    </div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add speaker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formspeaker">
            <div class="modal-body">
                @csrf
                <select name="program_id" id="selectprogram" class="select"></select>
                <input type="text" name="full_name" id="full_name" class="input" placeholder="Full Name">
                
                <input name="profession[]" id="profession" placeholder="Profession">
                <i class="fa fa-plus" id="add_profession"></i>
                <div id="place_profession"></div>
                
                <input name="title[]" id="title" placeholder="Title">
                <i class="fa fa-plus" id="add_title"></i>
                <div id="place_title"></div>
                
                <input name="contact[]" id="contact" placeholder="Contact">
                <i class="fa fa-plus" id="add_contact"></i>
                <div id="place_contact"></div>

                <textarea name="description" id="description" placeholder="description"></textarea>

                <img src="/assets/internal/images/development/image.png" alt="" width="30px" class="cropphoto">
                <input type="hidden" name="cropphoto" class="cropphoto">
                <input type="file" class="invisible" id="photo" class="photo" name="photo" style="width:0px;">
              </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Save Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodaltitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="editformspeaker">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="speaker_id" id="editspeaker_id">
                <select name="program_id" id="editselectprogram" class="select"></select>
                <input type="text" name="full_name" id="editfull_name" class="input" placeholder="Full Name">

                <i class="fa fa-plus" id="editadd_profession"></i>
                <div id="editplace_profession"></div>
                
                <i class="fa fa-plus" id="editadd_title"></i>
                <div id="editplace_title"></div>
                
                <i class="fa fa-plus" id="editadd_contact"></i>
                <div id="editplace_contact"></div>

                <textarea name="description" id="editdescription" placeholder="description"></textarea>
                <img src="/assets/internal/images/development/image.png" alt="" width="100px" class="editcropphoto">
                <input type="hidden" name="cropphoto" class="editcropphoto">
                <input type="file" id="editphoto" class="editphoto invisible" name="photo" style="width:0px;">
                <input type="hidden" name="hiddenphoto" id="edithiddenphoto">
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalphoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <img id="sample_photo" alt="aaaa" width="100%">
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

<div class="modal fade" id="editmodalphoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <img id="editsample_photo" alt="aaaa" width="100%">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="bg-hitam text-light" data-dismiss="modal">Close</button>
        <button type="button" class="bg-biru text-light" id="editcrop">Crop</button>
      </div>
    </div>
  </div>
</div>

<script src="/assets/internal/js/infosessions/speakers/index.js"></script>
@endsection