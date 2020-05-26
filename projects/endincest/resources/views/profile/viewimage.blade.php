@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD IMAGE') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/addimage') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control @error('name') is-invalid @enderror" name="profile_pic" value="{{ old('profile_pic') }}" required autocomplete="profile_pic" autofocus>

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Addimage') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@endsection
