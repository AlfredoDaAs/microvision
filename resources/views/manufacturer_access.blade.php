@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manufacturer Access</div>

                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleFormControlSelect1" class="col-md-2 offset-md-2">Manufacturer: </label>
                            <select class="form-control col-md-4" id="drpManufacturer">
                              <option>ASICMFG001</option>
                            </select>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label for="drpAvailableCM">Available CMs:</label>
                                <select multiple class="form-control" id="drpAvailableCM" style="height: 180px;">
                                  <option>CM2</option>
                                  <option>CM3</option>
                                  <option>CM4</option>
                                </select>
                            </div>
                            <div class="mx-auto mt-3">
                                <button type="button" class="btn btn-secondary mb-3" style="display: block;"><i class="fas fa-greater-than"></i></button>
                                <button type="button" class="btn btn-secondary" style="display: block;"><i class="fas fa-less-than"></i></button>
                            </div>
                            <div class="col-md-5">
                                <label for="drpAsignedCM">Asigned CMs:</label>
                                <select multiple class="form-control" id="drpAsignedCM" style="height: 180px;">
                                  <option>CM1</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-success px-4">
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
@endpush