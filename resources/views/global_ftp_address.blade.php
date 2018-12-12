@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Global FTP Address</div>

                <div class="card-body">
                    <form method="post" id="frmFtpAddress" action="{{ route('update_ftp_settings') }}">
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
                                        @foreach($ftpsettings as $ftpsetting)
                                            <tr>
                                                <td>{{ $ftpsetting->SettingName }}</td>
                                                <td>
                                                    <input
                                                        class="form-control ftpsetting"
                                                        id="{{ $ftpsetting->SettingName }}"
                                                        name="{{ $ftpsetting->SettingName }}"
                                                        disabled required
                                                        @if($ftpsetting->SettingName == config('constants.ftp_settings.ftp_admin_pwd'))
                                                            type="password"
                                                            placeholder="********"
                                                        @else
                                                            type="text"
                                                            value="{{ $ftpsetting->SettingValue }}"
                                                        @endif
                                                        >
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" id="btnOk" class="btn btn-success float-left px-4" disabled>
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
