@extends('layouts.default')

@section('styles')
@endsection

@section('contents')
    <div class="container mb-5">
        <a href="{{ route('users.create') }}"><button class="btn btn-success mt-3 mb-3">Add User</button></a>
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_as }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"><button
                                    class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><i
                                            class="bi bi-exclamation-circle-fill text-danger"></i> Warning!!!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <span class="text-danger">{{ $user->name }}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $users->currentPage() }}">
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
