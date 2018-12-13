@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manufacturer Access</div>

                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt" action="{{ route('manufacturer_access_save') }}" onsubmit="manufacturer_access.submit(this)">
                        @csrf
                        <div class="form-group row">
                            <label for="drpManufacturer" class="col-md-4 col-sm-4 offset-md-2">Manufacturer: </label>
                            <select class="form-control col-md-4 col-sm-8" id="drpManufacturer" name="drpManufacturer" onchange="manufacturer_access.refresh_cms()">
                              <option value="">Select Manufacturer</option>
                              @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->ID }}">{{ $manufacturer->Description }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label for="drpAvailableCM">Available CMs:</label>
                                <select multiple class="form-control" id="drpAvailableCM" style="height: 180px;"></select>
                            </div>
                            <div class="mx-auto mt-5">
                                <button type="button" class="btn btn-secondary mb-3" style="display: block;" onclick="manufacturer_access.move_right()"><i class="fas fa-greater-than"></i></button>
                                <button type="button" class="btn btn-secondary" style="display: block;" onclick="manufacturer_access.move_left()"><i class="fas fa-less-than"></i></button>
                            </div>
                            <div class="col-md-5">
                                <label for="drpAsignedCM">Asigned CMs:</label>
                                <select multiple class="form-control" name="asigned_cms[]" id="drpAsignedCM" style="height: 180px;"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                <button type="submit" id="btnOk" class="btn btn-success px-4" disabled>
                                    OK
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
    <script type="text/javascript" src="{{ asset('js/manufacturer_access.js') }}"></script>
@endpush