@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Welcome, {{ Auth::user()->UserName }}</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="frmManufacturerMgmt" action="{{ route('upload_file') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="drpCM" class="col-md-2 offset-md-3">Select a CM: </label>
                            <select class="form-control col-md-4" id="drpCM" name="cm">
                              <option>Select a CM</option>
                              @foreach($cms as $cm)
                                <option value="{{ $cm->ID }}">{{ $cm->Description }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="input-group mb-3 col-md-8 offset-md-2">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="txtFile" aria-describedby="inputGroupFileAddon01">
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