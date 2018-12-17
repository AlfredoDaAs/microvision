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
                            <th><i class="fas fa-bolt"></i> Action</th>
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
                                <td>
                                    <a href="#" class="editUser" onclick="user_mgmt.openEdit({{$user->ID}})" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="far fa-edit"></i></a>
                                    <a href="#" class="deleteUser" onclick="user_mgmt.openDelete({{$user->ID}}, '{{ $user->UserName }}')" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></a>
                                </td>
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