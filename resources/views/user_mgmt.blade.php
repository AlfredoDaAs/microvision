@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" id="contentCard">
            @include('users.users_card', ['users' => $users])
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" onsubmit="user_mgmt.save(event)" id="frmSaveUser">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtLoginName">Login Name</label>
                                <input type="text" id="txtLoginName" name="txtLoginName" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="txtUserName">User Name</label>
                                <input type="text" id="txtUserName" name="txtUserName" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtPassword">Password</label>
                                <input type="text" id="txtPassword" name="txtPassword" class="form-control" placeholder="Enter new Password">
                            </div>
                            <div class="col-md-6">
                                <label for="drpManufacture">Manufacture</label>
                                <select id="drpManufacture" name="drpManufacture" class="form-control">
                                    <option value="">Select Manufacture</option>
                                    @foreach($manufacturers as $manufacture)
                                        <option value="{{ $manufacture->ID }}">{{ $manufacture->Description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtEmail">Email</label>
                                <input type="email" id="txtEmail" name="txtEmail" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="chkStatus" name="chkStatus">
                                    <label class="form-check-label" for="chkStatus">
                                        Enabled
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="errors">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnOk" class="btn btn-success px-4">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete - <span class="deleteTitle"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete <span class="deleteTitle"></span>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="user_mgmt.delete()">Delete</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/user_mgmt.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            user_mgmt.init();
        });
    </script>
@endpush