@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Management</div>

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
                                        <th><i class="fas fa-bolt"></i></th>
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
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/user_mgmt.js') }}"></script>
@endpush