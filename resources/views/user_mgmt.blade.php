@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">User Management</div>

                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt">
                        @csrf
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>jhon.doe@asicmfg001.com</td>
                                            <td>Jhon Doe</td>
                                            <td>*******</td>
                                            <td>ASICMFG001</td>
                                            <td>jhon.doe@asicmfg001.com</td>
                                            <td>Enabled</td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-success float-left px-4">
                                    OK
                                </button>
                                <button type="button" class="btn btn-secondary float-right" onclick="">
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
@endpush