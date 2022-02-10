@extends('cms.layouts.master')
@section('title','title')
@section('big_title','title')
@section('main_page','title')
@section('sub_page','title')


@section('content')
@include('errors.errors')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create City</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      {{-- <form method="post" action="{{route('cities.store')}}"> --}}
      <form id="create-form">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">City Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" >
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

        axios.post('/cms/admin/cities',formData)
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
