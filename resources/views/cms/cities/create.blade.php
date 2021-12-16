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
      <form method="post" action="{{route('cities.store')}}">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">City Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
          </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </div>
        <!-- /.card-body -->
      </form>
    </div>
    <!-- /.card -->

  </div>


@endsection



@section('scripts')

@endsection
