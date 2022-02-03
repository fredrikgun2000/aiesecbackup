@extends('internal/template')

@section('members/account-role')
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
            <h4>Account Department</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/members/account-role/department/recovery">
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

    <div class="row mt-3">
        <div class="col-12 text-center">
            <h4>Account Role</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
          <a href="/AIESEC/members/account-role/role/recovery">
              <button class="border-merah merah">
                  <i class="fas fa-trash-restore"></i>
              </button>
          </a>
            <button class="border-biru biru" data-toggle="modal" data-target="#createmodal2">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table id="table-role" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Department</th>
                    </tr>
                </thead>
                <tbody id="read-role">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="formdepartment">
            <div class="modal-body">
                @csrf
                <input type="text" name="department_name" id="department_name" class="input" placeholder="Department Name">
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
        <form method="POST" id="editformdepartment">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="department_id" id="editdepartment_id">
                <input type="text" name="department_name" id="editdepartment_name" class="input" placeholder="Department Name">
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="createmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formrole">
        <div class="modal-body">
                @csrf
                <select name="department_id" id="selectdepartment">
                </select>
                <input type="text" name="role_name" id="role" class="input" placeholder="Role Name">
                <select name="position" id="position">
                  <option value="">Choose Position</option>
                  <option value="staff">Staff</option>
                  <option value="manager">Manager</option>
                  <option value="lcvp">LCVP</option>
                  <option value="lcp">LCP</option>
                </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="text-light bg-biru">Save Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodal2title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" id="editform2role">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="role_id" id="editrole_id">
                <select name="department_id" id="editselectdepartment">
                </select>
                <input type="text" name="role_name" id="editrole_name" class="input" placeholder="Department Name">
                <select name="position" id="editposition">
                  <option value="">Choose Position</option>
                  <option value="staff">Staff</option>
                  <option value="manager">Manager</option>
                  <option value="lcvp">LCVP</option>
                  <option value="lcp">LCP</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Update Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/members/account role/department/index.js"></script>
<script src="/assets/internal/js/members/account role/role/index.js"></script>
@endsection