@extends('cms.layouts.master')
@section('title','Users')
@section('big_title','User')
@section('main_page','Home')
@section('sub_page','Update')


@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit User</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" class="form-control" id="name" value="{{$user->name}}" placeholder="Enter Name" >
          </div>

          <div class="form-group">
            <label for="email">User Email</label>
            <input type="text" class="form-control" id="email" value="{{$user->email}}" placeholder="Enter Email" >
          </div>

          <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input"  @if($user->active) checked @endif id="active">
              <label class="custom-control-label"  for="active">Active</label>
            </div>
          </div>
          </div>

          <div class="card-footer">
            <button type="button" onclick="update({{$user->id}})" class="btn btn-primary">Add</button>
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

    function update(id){

axios.put('/cms/admin/users/'+id,{
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    active: document.getElementById('active').checked ? 1 :0,

})
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


