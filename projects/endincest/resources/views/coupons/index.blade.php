@extends('layouts.admin')
@section('title') Coupons @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Coupons</h1>
            <p>All Coupons</p>
        </div>
         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        <a href="{{ route('coupons.create') }}" class="btn btn-primary pull-right">Add </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                     <div class="table-responsive ct-one">
                     <table class="table table-hover table-bordered" id="couponTable" width = "100%">
                      <thead>
                    <tr>
                      <th scope="col">#</th>

                         <th>Code</th>
                       <th>Type</th>
                        <th>Value</th>
                       <th>Percent OFF</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $i =1; @endphp
                        @foreach($coupons as $coupon)
              <tr>
               <td> {{ $i++ }} </td>
             <td>{!! $coupon->code !!}</td>
             <td> {{$coupon->type}} </td>
              <td> {{$coupon->value}} </td>
              <td> {{$coupon->percent_off}} </td>

                                      <td class="text-center">

                                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                            <form class='form-group'  action="{{route('coupons.destroy',$coupon->id)}}" method="post">

                                     @method('DELETE')
                                        @csrf

                                            <button type='submit'  name='submit' class='btn btn-sm btn-danger' onclick="return confirm('Are you sure, Want to Delete?')"><i class="fa fa-trash"></i></button>

                                      </form>

                                    </td>
                                </tr>
                        @endforeach

                  </tbody>
                </table>
                </div>

              </div>
          </div>
      </div>
    </div>


@endsection
