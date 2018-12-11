@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manufacturer Management</div>

                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Manufacturer Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($manufacturers as $manufacturer)
                                            <tr>
                                                <td>{{ $manufacturer->Description }}</td>
                                                <td>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                                                      <label class="form-check-label" for="defaultCheck1">
                                                        Enabled
                                                      </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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