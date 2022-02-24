
@extends('cms.layouts.master')
@section('title', 'Role Permissions')
@section('big_title', 'Role Permissions Page')
@section('main_page', 'Role Permissions')
@section('sub_page', 'index')


@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">{{ $role->name }} Permissions</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Guard</th>
                            @can('permission-edit')
                            <th>Status</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>

                                <td>{{ $permission->name }}</td>
                                <td><span class="badge bg-success" >{{ $permission->guard_name }}</span></td>
                                 {{-- @can('permission-edit') --}}
                                <td> <div class="icheck-primary d-inline">
                                    <input onchange="assignedPermission({{$role->id}},{{$permission->id}})"
                                    type="checkbox" id="permission_{{$permission->id}}" @if($permission->assigned)checked @endif >
                                    <label for="permission_{{$permission->id}}">
                                    </label>
                                  </div></td>
                                  {{-- @endcan --}}

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


        function assignedPermission(roleId, permissionId) {
            axios.post('/cms/admin/roles/ '+roleId+' /permissions/' ,{
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








