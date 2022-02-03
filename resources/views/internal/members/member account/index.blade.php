@extends('internal/template')

@section('members/member-account')
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

<div class="mt-2 container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <h4>Members</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 text-right">
            <a href="/AIESEC/members/member-account/recovery">
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
            <table id="table-member" class="display table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Join Period</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Sender</th>
                    </tr>
                </thead>
                <tbody id="read-member">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formmember">
          @csrf
            <div class="modal-body">
                <input type="hidden" name="sender_id" id="sender_id">
                <input type="email" name="email" id="email" class="input" placeholder="Email">
                <select name="role_id" id="selectrole" class="select"></select>
                <input type="text" name="password" id="password" class="input" placeholder="password">
                <select name="join_period" id="join_period" class="input">
                    <option value="">Select Join Period</option>
                    <?php
                        $nominal = date("Y")-2015;
                        for($x=1; $x<=$nominal; $x++){
                            $year=2015+$x;
                    ?>
                        <option value="<?php echo $year;?>"><?php echo $year;?></option>
                    <?php
                    }
                    ?>
                </select>
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
        <form method="post" id="editformmember">
          @csrf
            <div class="modal-body">
                <input type="hidden" name="member_id" id="editmember_id">
                <select name="role_id" id="editselectrole" class="select"></select>
                <select name="join_period" id="editjoin_period" class="input">
                    <option value="">Select Join Period</option>
                    <?php
                        $nominal = date("Y")-2015;
                        for($x=1; $x<=$nominal; $x++){
                            $year=2015+$x;
                    ?>
                        <option value="<?php echo $year;?>"><?php echo $year;?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="text-light bg-biru">Save Data</button>
            </div>
      </form>
    </div>
  </div>
</div>

<script src="/assets/internal/js/members/member account/index.js"></script>
@endsection