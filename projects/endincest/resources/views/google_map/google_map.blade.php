@extends('layouts.admin')

@section ('title') Gmap @endsection

@section('content')
<div class="container">
	<div id="map">

	</div>
	<!--Form for selecting places-->

	<form method="POST" id="find" action="{{route('LocationCoords')}}" aria-label="{{ __('My form') }}">
    @csrf

    <div class="form-group row">
        <label for="dropdown" class="col-sm-4 col-form-label text-md-right">{{ __('SELECT CITIES') }}</label>

        <div class="col-md-12">
            <select class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" id ="city" name="city">

              @foreach($locations as $location)
              <option value="{{ $location->city}}" > {{ $location->city }}</option>
              @endforeach
            </select>

            @if ($errors->has('dropdown'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dropdown') }}</strong>
                </span>
            @endif
        </div>
    </div>
<button type="submit" id="searchcity" class="btn btn-success btn-md">Find</button>
</form>


	</div>
@endsection