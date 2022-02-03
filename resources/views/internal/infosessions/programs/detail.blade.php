@extends('internal/template')

@section('infosessions/programs/detail')
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
    <div class="col-12" id="speaker">
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-3">
    <div class="col-12 text-center">
      <button class="bg-biru text-white editprogram" >Edit</button>
      <button class="bg-merah text-white deleteprogram">Delete</button>
      <button class="bg-hijau text-white publishprogram"></button>
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
        <form method="POST" id="editformprogram">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="program_id" id="editprogram_id">
                <input type="text" name="theme" id="edittheme" placeholder="theme">
                <select name="sdgs" id="editsdgs" >
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
                
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Language and Art"> Faculty of Language and Art
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Biology"> Faculty of Biology
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Economics and Business"> Faculty of Economics and Business
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Law"> Faculty of Law
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Social Sciences and Communication"> Faculty of Social Sciences and Communication
                <input type="checkbox" name="faculty[]" id="" value="Interdisciplinary Faculty"> Interdisciplinary Faculty
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Teacher Training and Education"> Faculty of Teacher Training and Education
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Medicine and Health Sciences"> Faculty of Medicine and Health Sciences
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Agriculture and Business"> Faculty of Agriculture and Business
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Psychology"> Faculty of Psychology
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Science and Mathematics"> Faculty of Science and Mathematics
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Electrical and Computer Engineering"> Faculty of Electrical and Computer Engineering
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Information Technology"> Faculty of Information Technology
                <input type="checkbox" name="faculty[]" id="" value="Faculty of Theology"> Faculty of Theology

                <img id="previewposter" alt="" width="50px" height="70px">
                <input type="file" name="poster" id="editposter" class="invisible" style="width:0px;">
                <input type="hidden" name="hiddenposter" id="edithiddenposter">
                <input type="datetime-local" name="datetime" id="editdatetime">
                <textarea name="description" id="editdescription"></textarea>
                <input type="text" name="link_meet" id="editlink_meet">
                <input type="text" name="link_content" id="editlink_content">
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>


<!-- <link rel="stylesheet" href="/assets/internal/css/infosessions/programs/index.css"> -->
<script src="/assets/internal/js/infosessions/programs/detail.js"></script>
@endsection