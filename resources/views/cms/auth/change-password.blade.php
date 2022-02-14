@extends('cms.layouts.master')
@section('title', 'Change Password')
@section('big_title', 'Change Password')
@section('main_page', 'Home')
@section('sub_page', 'Change Password')


@section('content')

    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Current Password</label>
                        <input type="password" class="form-control" id="current_password"
                            value="{{ old('current_password') }}" placeholder="Enter Current Password">
                    </div>

                    <div class="form-group">
                        <label for="name">New Password</label>
                        <input type="password" class="form-control" id="new_password" value="{{ old('new_password') }}"
                            placeholder="Enter New Password">
                    </div>

                    <div class="form-group">
                        <label for="name">New Password Confirmation</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            value="{{ old('new_password_confirmation') }}" placeholder="Enter current Password">
                    </div>


                </div>

                <div class="card-footer">
                    <button type="button" onclick="update()" class="btn btn-primary">Update Password</button>
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
        // function update() {

        //     let formData = new FormData();
        //     formData.append('current-password', document.getElementById('current-password').value);
        //     formData.append('new-password', document.getElementById('new-password').value);
        //     formData.append('new-password-confirmation', document.getElementById('new-password-confirmation').value);


        //     axios.put('/cms/admin/update-password', formData)
        //         .then(function(response) {
        //             // handle success
        //             console.log(response);
        //             toastr.success(response.data.message);

        //             document.getElementById('create-form').reset();


        //         })
        //         .catch(function(error) {
        //             // handle error
        //             console.log(error);
        //             toastr.error(error.response.data.message);
        //         })


        // }

            function update(){

        axios.put('/cms/admin/update-password',{
            current_password: document.getElementById('current_password').value,
            new_password:document.getElementById('new_password').value,
            new_password_confirmation:document.getElementById('new_password_confirmation').value
        })
            .then(function (response) {
                // handle success
                console.log(response);
                toastr.success(response.data.message);

                document.getElementById('create-form').reset();
                // window.location.href="/cms/admin/categories";

            })
            .catch(function (error) {
                // handle error
                console.log(error);
                toastr.error(error.response.data.message);
            })


        }
    </script>

@endsection
