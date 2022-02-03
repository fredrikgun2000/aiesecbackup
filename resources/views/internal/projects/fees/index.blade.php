@extends('internal/template')

@section('projects/fees')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Project fees</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>projects page is it for AIESEC fee's can manage data.</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-2 container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <h4>projects</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/projects/fees/recovery">
              <button class="border-merah merah">
                <i class="fas fa-trash-restore"></i>
              </button>
            </a>
            <button class="border-biru biru" data-toggle="modal" data-target="#createmodal">
                <i class="fa fa-plus"></i> 
                Add Data
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="table-fees" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Fee Title</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody id="read-fee">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formfee">
          @csrf
            <div class="modal-body">
                <select name="project_id" id="selectproject" class="select"></select>
                <input type="text" name="title" id="title" class="input" placeholder="Title">
                <textarea name="description" id="description"></textarea>
                <input type="text" name="price" id="price" class="input" placeholder="Price">
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
        <form method="post" id="editformfee">
          @csrf
            <div class="modal-body">
                <input type="hidden" name="fee_id" id="editfee_id">
                <select name="project_id" id="editselectproject" class="select"></select>
                <input type="text" name="title" id="edittitle" class="input" placeholder="Title">
                <textarea name="description" id="editdescription"></textarea>
                <input type="text" name="price" id="editprice" class="input" placeholder="Price">
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Save Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/projects/fees/index.js"></script>
@endsection