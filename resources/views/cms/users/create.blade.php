

@extends('cms.layouts.master')
@section('title','Users')
@section('big_title','Users')
@section('main_page','Home')
@section('sub_page','Create')


@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" >
          </div>

          <div class="form-group">
            <label for="email">User Email</label>
            <input type="text" class="form-control" id="email" value="{{old('email')}}" placeholder="Enter Email" >
          </div>
          {{-- <div class="form-group">
            <label>Role Name</label>
            <select class="form-control roles " id="role_name" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}"  >{{$role->name}}</option>
                @endforeach
            </select>
          </div> --}}

          <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input"   id="active">
              <label class="custom-control-label"  for="active">Active</label>
            </div>
          </div>
          </div>

          <div class="card-footer">
            <button type="button" onclick="store()" class="btn btn-primary">Add</button>
          </div>
        </div>
        <!-- /.card-body -->
      </form>
    </div>
    <!-- /.card -->

  </div>

@endsection



@section('scripts')

<script>
    function store(){

        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        // formData.append('role_name',document.getElementById('role_name').value);
        formData.append('active',document.getElementById('active').checked ? 1 : 0);

        axios.post('/cms/admin/users',formData)
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);

                // document.getElementById('create-form').reset();
                window.location.href="/cms/admin/users";

            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })
    }

</script>

@endsection


