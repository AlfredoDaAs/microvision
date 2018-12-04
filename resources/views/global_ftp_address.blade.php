@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Global FTP Address</div>

                <div class="card-body">
                    <form method="post" id="frmFtpAddress">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Settings</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>FTP Address</td>
                                            <td><input type="text" class="form-control" id="ftpAddress" name="ftpAddress" placeholder="sftp://0.0.0.0" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>FTP Port</td>
                                            <td><input class="form-control" type="text" id="ftpPort" name="ftpPort" placeholder="FTP Port" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>FTP Admin User</td>
                                            <td><input class="form-control" type="text" id="ftpAdminUsr" name="ftpAdminUsr" placeholder="FTP Admin User" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>FTP Admin pwd</td>
                                            <td><input class="form-control" type="password" id="ftpAdminPwd" name="ftpAdminPwd" placeholder="*******" disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-success float-left px-4">
                                    OK
                                </button>
                                <button type="button" class="btn btn-secondary float-right" onclick="ftp_address.edit();">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/ftp_address.js') }}"></script>
@endpush
