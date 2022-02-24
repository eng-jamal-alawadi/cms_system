@extends('cms.layouts.master')
@section('title','Cities')
@section('big_title','Cities Page')
@section('main_page','Cities')
@section('sub_page','index')


@section('content')
<div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">All Cities</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Created at</th>
              <th>Updated at</th>
              @can('Update-Cities')
              <th>Settings</th>
              @endcan
            </tr>
          </thead>
          <tbody>
              @forelse ($cities as $city)
            <tr>
              <td>{{$city->id}}</td>
              <td>{{$city->name}}</td>
              <td>{{$city->created_at}}</td>
              <td> {{$city->updated_at}} </td>
              @can('Update-Cities')

              <td>
                <div class="btn-group">
                  <a href="{{route('cities.edit',$city->id)}}" class="btn btn-info">
                    <i class="far fa-edit"></i>
                  </a>
                  {{-- <form method="POST" action="{{route('cities.destroy',$city->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                      </button>
                  </form> --}}
                  <a href="#" class="btn btn-danger" onclick="confirmDestroy({{$city->id}} , this)">
                    <i class="far fa-trash-alt"></i>
                  </a>
                </div>
                </td>
                @endcan
            </tr>
              @empty
                <tr>No data Found</tr>
              @endif


          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection



@section('scripts')
  <script>
      function confirmDestroy(id,referance){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                       destroy(id,referance);


                    }
                    })

      }

      function destroy(id,referance){
        axios.delete('/cms/admin/cities/'+id)
            .then(function (response) {
                // handle success
                console.log(response);
                referance.closest('tr').remove();
                showMessage(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
                showMessage(error.response.data);
            })


      }
      function showMessage(data){
        Swal.fire({
            icon: data.icon,
            title: data.title,
            text: data.text,
            showConfirmButton: false,
            timer: 1500
         })
      }

  </script>
@endsection
