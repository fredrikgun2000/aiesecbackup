@extends('internal/template')

@section('destinations/recovery')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Destinations</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>destinations page is it for AIESEC destination's can manage data.</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-center">
            <h4>Destination </h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <button class="border-biru biru restoredestination">
              <i class="fas fa-trash-restore"> Restore All</i>
            </button>
            <button class="border-merah merah deletepermanentdestination">
              <i class="fa fa-trash"> Delete Permanent All</i>
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
                    </tr>
                </thead>
                <tbody id="read-destination">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/assets/internal/js/destinations/recovery.js"></script>
@endsection