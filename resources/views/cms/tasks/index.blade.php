@extends('cms.layouts.master')
@section('title', 'Tasks')
@section('big_title', 'Tasks Page')
@section('main_page', 'Tasks')
@section('sub_page', 'index')


@section('content')
    <div class="col-12">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-header">
                <h3 class="card-title">All Tasks</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            {{-- @can('Update-Tasks') --}}
                            <th>Settings</th>
                            {{-- @endcan --}}

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>

                                <td>{{ $task->name }}</td>
                                {{-- <td>@if ($task->active) Active @else Disable @endif </td> --}}
                                {{-- <td> <span
                                        class="badge @if ($task->active) bg-success @else bg-danger @endif">{{ $task->status }}</span>
                                </td> --}}

                                <td>{{ $task->description }}</td>
                                <td>{{ $task->category->name }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td> {{ $task->updated_at }} </td>
                                {{-- @can('Update-Tasks') --}}


                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">
                                            <i class="far fa-edit"></i>
                                        </a>
                                                {{-- <form method="POST" action="{{route('tasks.destroy',$task->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form> --}}

                                        <a href="#" class="btn btn-danger"
                                            onclick="confirmDestroy({{ $task->id }} , this)">
                                            <i class="far fa-trash-alt"></i>
                                        </a>


                                    </div>
                                </td>
                                {{-- @endcan --}}
                            </tr>
                        @empty
                            <tr>No data Found</tr>
                        @endforelse


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
            axios.delete('/cms/admin/tasks/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    referance.closest('tr').remove();
                    showMessage(response.data);
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
