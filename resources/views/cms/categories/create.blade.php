

@extends('cms.layouts.master')
@section('title','Categories')
@section('big_title','Categories')
@section('main_page','Home')
@section('sub_page','Create')


@section('content')
 {{-- لا نحتاج السيشن ولا الايرور عند استخدام طرسقة الجافاسكربت --}}
{{-- @include('errors.errors') --}}
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Category</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" >
          </div>

          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="category_image">
              <label class="custom-file-label" for="category_image">Choose file</label>
            </div>
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
        formData.append('active',document.getElementById('active').checked ? 1 : 0);
        formData.append('category_image',document.getElementById('category_image').files[0]);

        axios.post('/cms/admin/categories',formData)
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);

                // document.getElementById('create-form').reset();
                window.location.href="/cms/admin/categories";

            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })


    }

//     function store(){

// axios.post('/cms/admin/categories',{
//     name: document.getElementById('name').value,
//     active: document.getElementById('active').checked

// })
//     .then(function (response) {
//         // handle success
//         console.log(response);
//         toastr.success(response.data.message);

//         // document.getElementById('create-form').reset();
//         window.location.href="/cms/admin/categories";

//     })
//     .catch(function (error) {
//         // handle error
//         console.log(error);
//         toastr.error(error.response.data.message);
//     })


// }
</script>

@endsection

