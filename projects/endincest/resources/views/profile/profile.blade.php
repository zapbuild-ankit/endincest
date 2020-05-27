@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}
                   <div>
                  <a href="{{ url('/editprofile') }}" class='btn btn-info btn-sm' style='float:right;'>Edit</a>
                </div>
            </div>

                <div class="card-body">

                     <div class="image">

                     	@if(empty(auth::user()->profile_pic))
         <a href="{{URL::to('/viewimage')}}"><img src="{{asset('dist/img/profile.png')}}" style='width:70px;float: left;' class="img-circle elevation-2" alt="User Image"></a>@endif


          @if(!empty(auth::user()->profile_pic))


           <img src="{{ asset('/dist/img/' . auth::user()->profile_pic)}}" style='width:80px;float: left;' class="img-circle elevation-2" alt="User Image">
           @endif
               <b style='margin-left: 30px;'>NAME: </b>{{ auth::user()->name}}
        </br>
      <b style='margin-left: 30px;'>EMAIL: </b>  {{ auth::user()->email}}




        </div>



                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


