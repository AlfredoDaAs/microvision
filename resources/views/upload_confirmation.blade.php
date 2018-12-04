@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <h3>Hello, John Doe</h3>
        <div class="col-md-12 text-center mt-5 mb-5">
            <p style="font-size: 1.2rem;">Upload successful</p>
            <p class="mt-5">Your protocol number is 4bca1809e3. Please note it or print it.</p>
            <p>No confirmation via email will be sent.</p>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-success float-left px-4">
                < Back
            </button>
            <button type="button" class="btn btn-secondary float-right" onclick="">
                Logout
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush