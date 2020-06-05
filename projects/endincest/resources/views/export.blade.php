@extends('layouts.admin')
@section('title') Users @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Users</h1>
            <p>All Users</p>
        </div>


        <button onclick="Exportcsv()" class="btn btn-primary">Export to CSV File</button>
        <button onclick="Exportpdf()" class="btn btn-primary">Export to PDF File</button>

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

                         <th>Name</th>
                       <th>Email</th>
                      <th>Created</th>
                       <th>Modified</th>

                    </tr>
                  </thead>
                  <tbody>
                  @php $i =1; @endphp
                        @foreach($users as $user)
              <tr>
               <td> {{ $i++ }} </td>
             <td>{!! $user->name !!}</td>
             <td> {{$user->email}} </td>
              <td> {{$user->created_at}} </td>
              <td> {{$user->updated_at}} </td>

        </td>
                                </tr>
                        @endforeach

                  </tbody>
                </table>
                {!! $users->links() !!}
                </div>

              </div>
          </div>
      </div>
       <script>
        function Exportcsv()
        {
            var conf = confirm("Export users to CSV?");
            if(conf == true)
            {
                window.open("export_csv", '_blank');
            }
        }

        function Exportpdf()
        {
          var conf = confirm("Export users to PDF?");
            if(conf == true)
            {
                window.open("export_pdf", '_blank');
            }
        }

         </script>




      @endsection