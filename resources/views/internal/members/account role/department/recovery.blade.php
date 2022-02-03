@extends('internal/template')

@section('members/account-role/department/recovery')
<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Members</h2>
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
            <h4>Recovery Department</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <button class="border-biru biru restoredepartment">
              <i class="fas fa-trash-restore"> Restore All</i>
            </button>
            <button class="border-merah merah deletepermanentdepartment">
              <i class="fa fa-trash"> Delete Permanent All</i>
            </button>
        </div>
    </div>   
    <div class="row">
        <div class="col-12">
            <table id="table-department" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody id="read-department">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/assets/internal/js/members/account role/department/recovery.js"></script>
@endsection