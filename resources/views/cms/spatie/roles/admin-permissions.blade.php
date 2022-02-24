 

@extends('cms.layouts.master')
@section('title', 'Admin Permissions')
@section('big_title', 'Admin Permissions Page')
@section('main_page', 'Admin Permissions')
@section('sub_page', 'index')


@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">{{ $admin->name }} Permissions</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Guard</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>

                                <td>{{ $permission->name }}</td>
                                <td><span class="badge bg-success" >{{ $permission->guard_name }}</span></td>
                                 <td> <div class="icheck-primary d-inline">
                                    <input onchange="assignedPermission({{$admin->id}},{{$permission->id}})"
                                    type="checkbox" id="permission_{{$permission->id}}" @if($permission->assigned)checked @endif >
                                    <label for="permission_{{$permission->id}}">
                                    </label>
                                  </div></td>


                            @empty
                            <tr>No data Found</tr>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('scripts')
    <script>


        function assignedPermission(adminId, permissionId) {
            axios.post('/cms/admin/roles/ '+adminId+' /permissions/' ,{
                permission_id: permissionId
            })

                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                toastr.error(error.response.data.message);
                })
        }


    </script>
@endsection









