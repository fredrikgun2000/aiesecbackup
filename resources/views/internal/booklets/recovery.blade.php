@extends('internal/template')

@section('booklets/recovery')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>booklets</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>booklets page is it for AIESEC booklet's can manage data.</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 text-center">
            <h4>booklet </h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <button class="border-biru biru restorebooklet">
              <i class="fas fa-trash-restore"> Restore All</i>
            </button>
            <button class="border-merah merah deletepermanentbooklet">
              <i class="fa fa-trash"> Delete Permanent All</i>
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
</div>

<script src="/assets/internal/js/booklets/recovery.js"></script>
@endsection