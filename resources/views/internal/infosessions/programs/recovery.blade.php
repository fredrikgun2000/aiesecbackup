@extends('internal/template')

@section('booklets/recovery')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Infosession</h2>
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
            <h4>Programs</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <button class="border-biru biru restoreprogram">
              <i class="fas fa-trash-restore"> Restore All</i>
            </button>
            <button class="border-merah merah deletepermanentprogram">
              <i class="fa fa-trash"> Delete Permanent All</i>
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

<script src="/assets/internal/js/infosessions/programs/recovery.js"></script>
@endsection