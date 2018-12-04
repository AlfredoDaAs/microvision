@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Welcome, John Doe</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt">
                        @csrf
                        <div class="form-group row">
                            <label for="drpCM" class="col-md-2 offset-md-3">Select a CM: </label>
                            <select class="form-control col-md-4" id="drpCM" name="drpCM">
                              <option>CM1</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="input-group mb-3 col-md-8 offset-md-2">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="txtFile" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="txtFile">Choose file</label>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-success float-left px-4">
                                    Upload
                                </button>
                                <button type="button" class="btn btn-secondary float-right" onclick="">
                                    Cancel
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