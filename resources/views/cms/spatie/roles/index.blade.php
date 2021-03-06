
@extends('cms.layouts.master')
@section('title', 'Roles')
@section('big_title', 'Roles Page')
@section('main_page', 'Roles')
@section('sub_page', 'index')


@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">All Roles</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Permissions</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            @can('role-edit')
                            <th>Settings</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td><span class="badge bg-success" >{{ $role->guard_name }}</span></td>
                                <td> <a href="{{ route('roles.permissions.index', $role->id) }}" class="btn btn-info">({{$role->permissions_count}}) Permissions</a></td>

                                <td>{{ $role->created_at }}</td>
                                <td> {{ $role->updated_at }} </td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-danger"
                                            onclick="confirmDestroy({{ $role->id }} , this)">
                                            <i class="far fa-trash-alt"></i>
                                        </a>

                                    </div>
                                </td>

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
        function confirmDestroy(id, referance) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, referance);
                }
            })
        }

        function destroy(id, referance) {
            axios.delete('/cms/admin/roles/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    referance.closest('tr').remove();
                    showMessage(response.data );
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showMessage(error.response.data);
                })
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
@endsection

