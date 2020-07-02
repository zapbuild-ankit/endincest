@extends('layouts.admin')
@section('content')

<div class="app-title">
        <div>
            <h1 ><i class="fa fa-tags"></i>Import Data</h1>

        </div>
        </div>
<!--csv section start here-->
@if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

                <div class="row-2">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            Select  File
                            <a href="{{route('ExportView')}}" class="btn btn-sm btn-primary float-right">View Data</a>
                        </div>
                        <div class="card-body">
                            <form method="POST"  action="{{route('import_file')}}" id="import_file" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Select  File</label>
                                    <input type="file" class="form-control" name="file" placeholder="Select file">
                                </div>
                                <button type="submit" class="btn btn-success">IMPORT</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
@endsection