@extends('cms.layouts.master')
@section('title','Users')
@section('big_title','Users Page')
@section('main_page','Users')
@section('sub_page','index')


@section('content')
<div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">All Users</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">

        <table class="table table-hover table-bordered text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Settings</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($users as $user)
            <tr>
                <td>{{$user->id}}</td>

              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              {{-- <td>@if($user->active) Active @else Disable @endif </td> --}}
              <td>  <span class="badge @if($user->active)bg-success @else bg-danger @endif">{{$user->status}}</span> </td>

              <td>{{$user->created_at}}</td>
              <td> {{$user->updated_at}} </td>
              <td>
                <div class="btn-group">
                  <a href="{{route('Users.edit',$user->id)}}" class="btn btn-info">
                    <i class="far fa-edit"></i>
                  </a>

                  <a href="#" class="btn btn-danger" onclick="confirmDestroy({{$user->id}} , this)">
                    <i class="far fa-trash-alt"></i>
                  </a>


                </div>
                </td>
                @empty
                <tr>No data Found</tr>
              @endforelse
            </tr>



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
        axios.delete('/cms/user/Users/'+id)
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


