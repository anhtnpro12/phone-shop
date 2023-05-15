@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('products.create') }}"><button class="btn btn-success mt-3 mb-3">Add Product</button></a>
        <table class="table">
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
                            <img src="{{ asset('storage/imgs/products/'.$p->id.'/'.$p->image) }}" alt="image" style="height: 80px;">
                        </td>
                        <td>{{ $p->description }}</td>                        
                        <td>{{ $p->category->name }}</td>                        
                        <td>{{ $p->original_price }}</td>                        
                        <td>{{ $p->qty }}</td>                        
                        <td>{{ $p->status }}</td>                        
                        <td>{{ $p->trending }}</td>                        

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
        {{ $products->links() }}
    </div>

@endsection

@section('scripts')
    @if(app('request')->input('success'))
        <script>
            showSuccessToast('{{ app('request')->input('success') }}');
        </script>
    @endif
@endsection
