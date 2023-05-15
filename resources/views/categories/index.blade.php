@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('categories.create') }}"><button class="btn btn-success mt-3 mb-3">Add Category</button></a>
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Popular</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $c)
                    <tr>
                        <th>{{ $c->id }}</th>
                        <td>{{ $c->name }}</td>
                        <td>
                            <img src="{{ asset('storage/imgs/categories/'.$c->id.'/'.$c->image) }}" alt="image" style="height: 80px;">
                        </td>
                        <td>{{ $c->description }}</td>
                        <td>{{ $c->popular }}</td>
                        <td>
                            <a href="{{ route('categories.edit', ['category' => $c->id]) }}"><button class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $c->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $c->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                    Are you sure you want to delete <span class="text-danger">{{ $c->name }}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('categories.destroy', ['category' => $c->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $categories->currentPage() }}">
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>
        {{ $categories->links() }}
    </div>

@endsection

@section('scripts')
    @if(app('request')->input('success'))
        <script>
            showSuccessToast('{{ app('request')->input('success') }}');
        </script>
    @endif
@endsection
