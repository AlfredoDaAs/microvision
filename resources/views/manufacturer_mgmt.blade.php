@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manufacturer Management</div>

                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt" action="{{ route('manufacturer_mgmt_save') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="addElement d-none" id="addManufacturer" onclick="manufacturer_mgmt.addManufacturer()"><i class="fas fa-plus-circle fa-2x"></i></a>
                                <table class="table" id="tblManufacturers">
                                    <thead>
                                        <tr>
                                            <th>Manufacturer Name</th>
                                            <th>Status</th>
                                            <th>Admin</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($manufacturers as $key => $manufacturer)
                                            <tr class="manufacturers" data-id="{{ $key }}">
                                                <td>
                                                    <span>{{ $manufacturer->Description }}</span>
                                                    <input
                                                        type="text"
                                                        class="form-control desc d-none"
                                                        name="txtDescription[{{$key}}]"
                                                        placeholder="Name"
                                                        value="{{ $manufacturer->Description }}">
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="hidden" name="status[{{$key}}]" value="0">
                                                      <input class="form-check-input checkbox" type="checkbox" name="status[{{$key}}]" id="status{{ $key }}" value="1"
                                                            @if($manufacturer->status->Description == config('constants.status.enabled'))
                                                                checked
                                                            @endif
                                                       disabled>
                                                      <label class="form-check-label" for="status{{ $key }}">
                                                        {{ config('constants.status.enabled') }}
                                                      </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="hidden" name="admin[{{$key}}]" value="0">
                                                      <input class="form-check-input checkbox" type="checkbox" name="admin[{{$key}}]" id="isAdmin{{ $key }}" value="1"
                                                            @if($manufacturer->is_admin())
                                                                checked
                                                            @endif
                                                      disabled>
                                                      <label class="form-check-label" for="isAdmin{{ $key }}">
                                                        Is Admin
                                                      </label>
                                                    </div>
                                                </td>
                                                <td><a href="#" class="removeManufacturer d-none" onclick="manufacturer_mgmt.removeManufacturer(this)"><i class="far fa-times-circle fa-2x"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('msg') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" id="btnOk" class="btn btn-success float-left px-4" disabled>
                                    OK
                                </button>
                                <button type="button" id="btnEdit" class="btn btn-secondary float-right" onclick="manufacturer_mgmt.edit()">
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
    <script src="{{ asset('js/manufacturer_mgmt.js') }}"></script>
@endpush