@extends('cms.layouts.master')
@section('title','Admins')
@section('big_title','Admins')
@section('main_page','Home')
@section('sub_page','Create')


@section('content')
 {{-- لا نحتاج السيشن ولا الايرور عند استخدام طرسقة الجافاسكربت --}}
{{-- @include('errors.errors') --}}
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Admin</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Admin Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" >
          </div>

          <div class="form-group">
            <label for="email">Admin Email</label>
            <input type="text" class="form-control" id="email" value="{{old('email')}}" placeholder="Enter Email" >
          </div>

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
        formData.append('active',document.getElementById('active').checked ? 1 : 0);

        axios.post('/cms/admin/admins',formData)
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);

                // document.getElementById('create-form').reset();
                window.location.href="/cms/admin/admins";

            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })
    }

</script>

@endsection


