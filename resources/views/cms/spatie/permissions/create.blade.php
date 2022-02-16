@extends('cms.layouts.master')
@section('title','Permission')
@section('big_title','Permission')
@section('main_page','Home')
@section('sub_page','Create')


@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Permission</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
        <div class="form-group">
            <label>Guard Name</label>
            <select class="form-control guards " id="guard_name" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option data-select2-id="3" value="admin">Admin</option>
              <option data-select2-id="34" value="user">User</option>

            </select>
          </div>


          <div class="form-group">
            <label for="name">permission Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" >
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

//Initialize Select2 Elements
$('.guards').select2({
  theme: 'bootstrap4'
})

function store(){

axios.post('/cms/admin/permissions',{
    name:document.getElementById('name').value,
    guard_name:document.getElementById('guard_name').value,
})
    .then(function (response) {
        // handle success
        console.log(response);
        toastr.success(response.data.message);
        window.location.href="/cms/admin/permissions";
    })
    .catch(function (error) {
        // handle error
        console.log(error);
        toastr.error(error.response.data.message);
    })
}

</script>

@endsection


