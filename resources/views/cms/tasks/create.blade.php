

@extends('cms.layouts.master')
@section('title','Tasks')
@section('big_title','Tasks')
@section('main_page','Home')
@section('sub_page','Create')


@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Task</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form" >
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" >
          </div>


          <div class="form-floating">
            <label for="description">Description</label> 
            <textarea class="form-control" placeholder="Description" id="description"></textarea>

          </div>

          <div class="form-group">
            <label>Categories </label>
            <select class="form-control categories " id="category_name" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"  >{{$category->name}}</option>
                @endforeach
            </select>
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
        formData.append('description',document.getElementById('description').value);
        formData.append('category_id',document.getElementById('category_name').value);


        axios.post('/cms/admin/tasks',formData)
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);

                // document.getElementById('create-form').reset();
                window.location.href="/cms/admin/tasks";

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

