@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    User Management
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Login Name</th>
                                        <th>User Name</th>
                                        <th>Password</th>
                                        <th>Manufacture</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th><i class="fas fa-bolt"></i> Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->LoginName }}</td>
                                            <td>{{ $user->UserName }}</td>
                                            <td>********</td>
                                            <td>{{ $user->manufacturer->Description }}</td>
                                            <td>{{ $user->Email }}</td>
                                            <td>{{ ($user->status->Description == config('constants.status.enabled'))? 'Enabled' : 'Disabled' }}</td>
                                            <td><a href="#" onclick="user_mgmt.openEdit({{$user->ID}})"><i class="far fa-edit"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnAdd" class="btn btn-success px-4 float-right" onclick="user_mgmt.openEdit()">Add</button>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnOk" class="btn btn-success px-4">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/user_mgmt.js') }}"></script>
@endpush