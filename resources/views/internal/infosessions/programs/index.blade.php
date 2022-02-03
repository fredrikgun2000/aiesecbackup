@extends('internal/template')

@section('infosessions/programs')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>infosession</h2>
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
            <h4>Programs</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/infosessions/programs/recovery">
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
      <div class="container">
        <div class="row" id="read-program">
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add infosession</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formprogram">
            <div class="modal-body">
                @csrf
                <input type="text" name="theme" id="theme" placeholder="theme">
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

                <input type="file" name="poster" id="poster">
                <input type="datetime-local" name="datetime" id="datetime">
                <textarea name="description" id="description" placeholder="Description"></textarea>
                <input type="text" name="link_meet" id="link_meet" placeholder="Link Meet">
                <input type="text" name="link_content" id="link_content" placeholder="Link Content">
              </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Save Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/infosessions/programs/index.js"></script>
@endsection