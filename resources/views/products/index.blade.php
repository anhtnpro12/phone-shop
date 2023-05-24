@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('products.create') }}"><button class="btn btn-success mt-3 mb-3">Add Product</button></a>
        <table class="table table-hover" id="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Trending</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <th>{{ $p->id }}</th>
                        <td>{{ $p->name }}</td>
                        <td>
                            <img src="{{ asset('storage/imgs/products/'.$p->id.'/'.$p->image) }}" alt="image" style="max-height: 15vh; max-width: 20vh;">
                        </td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>{{ $p->original_price }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>
                            @switch($p->status)
                                @case(1)
                                    <span class="badge bg-secondary">4hand</span>
                                    @break
                                @case(2)
                                    <span class="badge bg-primary">3hand</span>
                                    @break
                                @case(3)
                                    <span class="badge bg-warning">2hand</span>
                                    @break
                                @default
                                    <span class="badge bg-success">New</span>
                            @endswitch
                        </td>
                        <td>{!! $p->trending==1?'<span class="badge bg-danger"><i class="fa-solid fa-fire fa-beat text-warning"></i> Trending</span>'
                                :'<span class="badge bg-secondary">Normal</span>' !!}</td>
                        <td>
                            <a href="{{ route('products.edit', ['product' => $p->id]) }}"><button class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $p->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                    Are you sure you want to delete <span class="text-danger">{{ $p->name }}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('products.destroy', ['product' => $p->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $products->currentPage() }}">
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        $('#table').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            "pagingType": "full_numbers"
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
