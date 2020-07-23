@extends('layouts.admin')
@section('title') Products @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Products</h1>
            <p>All Products</p>
        </div>
         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        <a href="{{ route('products.create') }}" class="btn btn-primary pull-right">Add </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                     <div class="table-responsive ct-one">
                     <table class="table table-hover table-bordered" id="productTable" width = "100%">
                      <thead>
                    <tr>
                      <th scope="col">#</th>

                         <th>Name</th>
                       <th>category</th>
                        <th>Price</th>
                       <th>Image</th>
                       <th>Description</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php $i =1; @endphp
                        @foreach($products as $product)
              <tr>
               <td> {{ $i++ }} </td>
             <td>{!! $product->name !!}</td>
             <td> {{$product->category}} </td>
              <td> {{$product->price}} </td>

              <td><img src="{{ asset('/dist/img/products/' . $product->image)}}" style='width:50px;float: left;' class="img-circle elevation-2" alt="product Image"></td>
              <td> {{$product->description}} </td>

                                      <td class="text-center">

                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                            <form class='form-group'  action="{{route('products.destroy',$product->id)}}" method="POST">

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
