
@extends('cms.layouts.master')
@section('title','Tasks')
@section('big_title','Tasks')
@section('main_page','Home')
@section('sub_page','Edit')


@section('content')
 {{-- لا نحتاج السيشن ولا الايرور عند استخدام طرسقة الجافاسكربت --}}
{{-- @include('errors.errors') --}}
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Task</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="create-form">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" class="form-control" id="name" value="{{$task->name}}" placeholder="Enter Name" >
          </div>

          <div class="form-floating">
            <label for="description">Description</label>
            <textarea class="form-control" placeholder="Description" id="description">{{$task->description}}</textarea>

          </div>

          <div class="form-group">
            <label>Categories </label>
            <select class="form-control categories " id="category_name" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"  >{{$category->name}}</option>
                @endforeach
            </select>
          </div>
          </div>

          <div class="card-footer">
            <button type="button" onclick="update({{$task->id}})" class="btn btn-primary">Update</button>
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

axios.put('/cms/admin/tasks/'+id,{
    name: document.getElementById('name').value,
    description:document.getElementById('description').value,
    category_id:document.getElementById('category_name').value

})
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

</script>

@endsection

