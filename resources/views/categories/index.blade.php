@extends('layouts.default')

@section('styles')

@endsection

@section('contents')
    <div class="container mb-5">
        @can('create', App\Models\Category::class)
            <a href="{{ route('categories.create') }}"><button class="btn btn-success mt-3 mb-3">Add Category</button></a>
        @else
            <div class="mb-3"></div>
        @endcan
        <table class="table table-hover" id="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Popular</th>
                    @canany(['update', 'forceDelete'], App\Models\Category::class)
                        <th scope="col">Action</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $c)
                    <tr>
                        <th>{{ $c->id }}</th>
                        <td>{{ $c->name }}</td>
                        <td>
                            <div class="mb-4">
                                <img src="{{ asset('storage/imgs/categories/'.$c->id.'/'.$c->image) }}"
                                    class="w-100 " style="object-fit:contain" height="100px" alt="image" >
                            </div>
                        </td>
                        <td>{{ $c->description }}</td>
                        <td>{!! $c->popular==1?'<span class="badge bg-danger"><i class="fa-solid fa-fire fa-beat text-warning"></i> Trending</span>'
                                :'<span class="badge bg-secondary">Normal</span>' !!}</td>

                        @canany(['update', 'forceDelete'], App\Models\Category::class)
                            <td>
                                <a href="{{ route('categories.edit', ['category' => $c->id]) }}"><button class="btn btn-primary">Edit</button></a>
                                <button type="button" class="btn btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $c->id }}">
                                    Delete
                                </button>
                            </td>
                        @endcanany
                    </tr>

                    @canany(['forceDelete'], App\Models\Category::class)
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
                    @endcanany
                @endforeach

            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        $('#table').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            "pagingType": "full_numbers",
            "columnDefs": [
                { "width": "20%", "targets": 2 },
                {
                    orderable: false,
                    targets: [2, @canany(['update', 'forceDelete'], App\Models\Product::class) 5 @endcanany]
                }
            ]
        });
    </script>
    @if(session('success'))
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
    @if(session('error'))
        <script>
            showErrorToast('{{ session('error') }}');
        </script>
    @endif
@endsection
