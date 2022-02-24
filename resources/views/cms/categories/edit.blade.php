
@extends('cms.layouts.master')
@section('title','Categories')
@section('big_title','Categories')
@section('main_page','Home')
@section('sub_page','Edit')


@section('content')
 {{-- لا نحتاج السيشن ولا الايرور عند استخدام طرسقة الجافاسكربت --}}
{{-- @include('errors.errors') --}}
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Category</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" value="{{$category->name}}" placeholder="Enter Name" >
          </div>
          {{-- <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input mb-3" id="category_image">
              <img class="img-circle img-bordered-sm mb-3" width="80"
                src="{{asset('upload/'.$category->image)}}" alt="User Image">
              <label class="custom-file-label" for="category_image">Choose file</label>
            </div>
          </div> --}}

          <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" @if($category->active) checked @endif  id="active">
              <label class="custom-control-label"  for="active">Active</label>
            </div>
          </div>
          </div>

          <div class="card-footer">
            <button type="button" onclick="update({{$category->id}})" class="btn btn-primary">Update</button>
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
    // function update(id){

    //     let formData = new FormData();
    //     formData.append('name',document.getElementById('name').value);
    //     formData.append('active',document.getElementById('active').checked ? 1 : 0);
    //     formData.append('category_image',document.getElementById('category_image').files[0]);

    //     axios.put('/cms/admin/categories/'+id,formData)
    //         .then(function (response) {
    //             // handle success
    //             console.log(response);
    //             toastr.success(response.data.message);
    //             // document.getElementById('create-form').reset();
    //             window.location.href="/cms/admin/categories";
    //         })
    //         .catch(function (error) {
    //             // handle error
    //             console.log(error);
    //             toastr.error(error.response.data.message);
    //         })


    // }

//-------------------------------------------------------------------

    function update(id){

axios.put('/cms/admin/categories/'+id,{
    name: document.getElementById('name').value,
    active: document.getElementById('active').checked,

})
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



</script>

@endsection

