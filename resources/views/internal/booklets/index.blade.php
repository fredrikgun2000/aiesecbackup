@extends('internal/template')

@section('booklets')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Booklet</h2>
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
            <h4>Booklets</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/booklets/recovery">
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
            <table id="table-booklet" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">File</th>
                    </tr>
                </thead>
                <tbody id="read-booklet">
                </tbody>
            </table>
        </div>
    </div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add booklet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formbooklet">
            <div class="modal-body">
                @csrf
                <input type="text" name="title" id="title" placeholder="title">
                <textarea name="description" id="description" placeholder="description"></textarea>
                <input type="file" name="file" id="file">
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
        <form method="POST" id="editformbooklet">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="booklet_id" id="editbooklet_id">
                <input type="text" name="title" id="edittitle">
                <textarea name="description" id="editdescription"></textarea>
                <input type="file" name="file" id="editfile">
                <input type="hidden" name="hiddenfile" id="edithiddenfile">
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/booklets/index.js"></script>
@endsection