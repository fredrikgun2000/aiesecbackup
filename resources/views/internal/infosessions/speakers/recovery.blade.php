@extends('internal/template')

@section('infosessions/speakers/recovery')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Infosessions</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>speakers page is it for AIESEC speaker's can manage data.</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-center">
            <h4>Speaker </h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <button class="border-biru biru restorespeaker">
              <i class="fas fa-trash-restore"> Restore All</i>
            </button>
            <button class="border-merah merah deletepermanentspeaker">
              <i class="fa fa-trash"> Delete Permanent All</i>
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
</div>

<script src="/assets/internal/js/infosessions/speakers/recovery.js"></script>
@endsection