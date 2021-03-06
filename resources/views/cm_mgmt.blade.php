@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CM Management</div>

                <div class="card-body">
                    <form method="post" id="frmCmMgmt" action="{{ route('cm_mgmt_save') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="addElement d-none" id="addCM" onclick="cm_mgmt.addCM()" style="z-index: 1;"><i class="fas fa-plus-circle fa-2x"></i></a>
                                <table class="table" id="tblCM">
                                    <thead>
                                        <tr>
                                            <th>CM Name</th>
                                            <th>Incoming Folder</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cms as $cm)
                                            <tr class="folders">
                                                <td>
                                                    <span class="">{{ $cm->Description }}</span>
                                                    <input
                                                        type="text"
                                                        class="form-control d-none"
                                                        name="txtName[]"
                                                        placeholder="CM Name"
                                                        value="{{ $cm->Description }}">
                                                </td>
                                                <td>
                                                    <span>{{ $cm->IncomingFolder }}</span>
                                                    <input
                                                        type="text"
                                                        class="form-control d-none"
                                                        name="txtIncomingFile[]"
                                                        placeholder="/ImportFiles/CM/Incoming"
                                                        value="{{ $cm->IncomingFolder }}">
                                                </td>
                                                <td><a href="#" class="removeCM d-none" onclick="cm_mgmt.removeCM(this)"><i class="far fa-times-circle fa-2x"></i></a></td>
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
                                <button type="button" id="btnEdit" class="btn btn-secondary float-right" onclick="cm_mgmt.edit()">
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
    <script src="{{ asset('js/cm_mgmt.js') }}"></script>
@endpush
