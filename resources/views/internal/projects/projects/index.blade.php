@extends('internal/template')

@section('projects')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Project</h2>
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
            <h4>project</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/projects/recovery">
              <button class="border-merah merah">
                <i class="fas fa-trash-restore"></i>
              </button>
            </a>
            <button class="border-biru biru" data-toggle="modal" data-target="#createmodal">
              <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="row my-2">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto">
        <input type="text" id="input_search" class="input" placeholder="search project ...">
        <button class="bg-biru text-white fa fa-search py-1" id="btn_search"></button>
      </div>
    </div>
    <div class="row my-2">
      <div class="container">
        <div class="row" id="read-project">
        </div>
      </div>
    </div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formproject">
            <div class="modal-body">
                @csrf
                <img src="/assets/internal/images/development/image.png" alt="" width="30px" class="cropbanner">
                <input type="hidden" name="cropbanner" class="cropbanner">
                <input type="file" class="invisible" id="banner" class="banner" name="banner" style="width:0px;">
                <input type="text" name="title" id="title" class="input" placeholder="Title">
                <select name="destination_id" id="selectdestination" class="input">
                </select>
                <input type="text" name="agency" id="agency" class="input" placeholder="Agency">
                <input type="text" name="city" id="city" class="input" placeholder="City">
                <select name="typeofproject" id="">
                  <option value="">Choose The Type of Project</option>
                  <option value="global volunteer">Global Volunteer</option>
                  <option value="global Talent">Global Talent</option>
                </select>
                <select name="sdgs" >
                  <option value="">Choose The SDGS</option>
                  <option value="no poverty">No Poverty</option>
                  <option value="zero hunger">Zero Hunger</option>
                  <option value="good health and well-being">Good Health and Well-being</option>
                  <option value="quality education">Quality Education</option>
                  <option value="gender equality">Gender Equality</option>
                  <option value="clean water and sanitation">Clean Water and Sanitation</option>
                  <option value="Affordable and Clean Energy">Affordable and Clean Energy</option>
                  <option value="decent work and economic growth">Decent Work and Economic Growth</option>
                  <option value="industry, innovation, and infrastructure">Industry, Innovation, and Infrastructure</option>
                  <option value="reduced inequalities">Reduced Inequalities</option>
                  <option value="sustainable and communities">Sustainable and Communities</option>
                  <option value="responsible consumption">Responsible Consumption</option>
                  <option value="climate action">Climate Action</option>
                  <option value="life below water">Life Below Water</option>
                  <option value="life on land">Life On Land</option>
                  <option value="peace, justice, and strong institutions">Peace, Justice, and Strong Institutions</option>
                  <option value="patnerships for the goals">Patnerships For The Goals</option>
                </select>
                <textarea name="description" id="description" class="input" placeholder="Description"></textarea>
                <input name="benefit[]" id="benefit" class="input" placeholder="Benefit">
                <i class="fa fa-plus" id="add_benefit"></i>
                <div id="place_benefit"></div>
                <input type="text" name="working_hour[]" id="working_hour" class="input" placeholder="Working Hour">
                <i class="fa fa-plus" id="add_wh"></i>
                <div id="place_wh"></div>
                <input type="text" name="accomodation" id="accomodation" class="input" placeholder="Accomodation">
                <input type="date" name="start_date" id="start_date" class="input" placeholder="Start Date">
                <input type="date" name="end_date" id="end_date" class="input" placeholder="End Date">
            
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
        <form method="POST" id="editformproject">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="project_id" id="editproject_id">
                <input type="text" name="country_name" id="editcountry_name" class="input" placeholder="project Name">
                <textarea name="description" id="editdescription" class="input" placeholder="Description"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
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
        <form id="updatephotoprofile" method="POST">
            @csrf
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

<script src="/assets/internal/js/projects/projects/index.js"></script>
@endsection