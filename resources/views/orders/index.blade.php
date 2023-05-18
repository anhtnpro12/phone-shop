@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('orders.create') }}"><button class="btn btn-success mt-3 mb-3">Add Order</button></a>
        <table class="table table-hover" id="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Products</th>
                    <th scope="col">Creator</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $o)
                    <tr>
                        <th>{{ $o->id }}</th>
                        <td>
                            @if ($o->products->count() > 0)
                                <div class="d-flex">
                                    <div class="">
                                        <img src="{{ asset('storage/imgs/products/'.$o->products[0]->id.'/'.$o->products[0]->image) }}"
                                                class="img-fluid" alt="image" style="max-height: 15vh; max-width: 20vh;">
                                    </div>
                                    <div class="ps-2">
                                        <h5>{{ $o->products[0]->name }}</h6>
                                        <div class="small">{{ $o->products[0]->category->name }}</div>
                                        <div class="small">${{ $o->products[0]->original_price }}</div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>{{ $o->user->name }}</td>
                        <td>{{ $o->total_price }}</td>
                        <td>{{ $o->status }}</td>
                        <td>{{ $o->payment_mode }}</td>
                        <td>{{ $o->created_at }}</td>

                        <td>
                            <a href="{{ route('orders.edit', ['order' => $o->id]) }}"><button class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $o->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $o->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                    Are you sure you want to delete <span class="text-danger">{{ $o->name }}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('orders.destroy', ['order' => $o->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $orders->currentPage() }}">
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
@endsection
