@extends('cms.layouts.master')
@section('title','Permissions')
@section('big_title','Permissions')
@section('main_page','Home')
@section('sub_page','Update Permission')


@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Permission</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
        <div class="form-group">
            <label>Guard Name</label>
            <select class="form-control guards " id="guard_name" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option value="{{$permission->guard_name}}" selected>{{$permission->guard_name}}</option>
                @foreach ($guards as $guard)
                    <option value="{{$guard}}"  >{{$guard}}</option>
                @endforeach

            </select>
          </div>


          <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" class="form-control" id="name" value="{{$permission->name}}" placeholder="Enter Name" >
          </div>

          <div class="card-footer">
            <button type="button" onclick="update({{$permission->id}})" class="btn btn-primary">Update</button>
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

    function update(id){

        axios.put('/cms/admin/permissions/' + id,{
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


