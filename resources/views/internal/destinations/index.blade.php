@extends('internal/template')

@section('destinations')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Destination</h2>
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
            <h4>Destination</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/destinations/recovery">
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
            <table id="table-destination" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Country Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="read-destination">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Destination</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formdestination">
            <div class="modal-body">
                @csrf
                <input type="text" name="country_name" id="country_name" class="input" placeholder="Country Name">
                <textarea name="description" id="description" class="input" placeholder="Description"></textarea>
                <input type="radio" name="status" id="status1" value="recommended">Recommended
                <input type="radio" name="status" id="status2" value="not recommended">Not Recommended
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
        <form method="POST" id="editformdestination">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="destination_id" id="editdestination_id">
                <input type="text" name="country_name" id="editcountry_name" class="input" placeholder="destination Name">
                <textarea name="description" id="editdescription" class="input" placeholder="Description"></textarea>
                <input type="radio" name="status" id="editstatus1" value="recommended">Recommended
                <input type="radio" name="status" id="editstatus2" value="not recommended">Not Recommended
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/destinations/index.js"></script>
@endsection