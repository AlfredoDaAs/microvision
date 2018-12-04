@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CM Management</div>

                <div class="card-body">
                    <form method="post" id="frmCmMgmt">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>CM Name</th>
                                            <th>Incoming Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CM1</td>
                                            <td><input type="text" class="form-control" name="cm[]" placeholder="/ImportFiles/CM1/Incoming" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>CM2</td>
                                            <td><input type="text" class="form-control" name="cm[]" placeholder="/ImportFiles/CM2/Incoming" disabled></td>
                                        </tr>
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
