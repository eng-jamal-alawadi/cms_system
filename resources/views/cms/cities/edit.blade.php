
@extends('cms.layouts.master')
@section('title','Edit')
@section('big_title','Edit')
@section('main_page','Cities')
@section('sub_page','Edit')


@section('content')
@include('errors.errors')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update City</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      {{-- <form method="post" action="{{route('cities.update',$city->id)}}"> --}}
      <form >
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="name">City Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name"
                value="@if(old('name')){{old('name')}}@else{{$city->name}}@endif"
                name="name">
          </div>
          </div>

          <div class="card-footer">
            <button type="button" onclick="update({{$city->id}})" class="btn btn-primary">Update</button>
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
        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);

        axios.put('/cms/admin/cities/'+id,{
    name: document.getElementById('name').value,
})
    .then(function (response) {
        // handle success
        console.log(response);
        toastr.success(response.data.message);
        // document.getElementById('create-form').reset();
        window.location.href="/cms/admin/cities";
    })
    .catch(function (error) {
        // handle error
        console.log(error);
        toastr.error(error.response.data.message);
    })

    }

</script>

@endsection
