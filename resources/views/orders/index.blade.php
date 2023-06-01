@extends('layouts.default')

@section('styles')
@endsection

@section('contents')
    <div class="container mb-5">
        <a href="{{ route('orders.create') }}"><button class="btn btn-success mt-3 mb-3">Add Order</button></a>
        <table class="table table-hover" id="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total (USD)</th>
                    <th scope="col">Status</th>
                    {{-- <th scope="col">Shipping</th> --}}
                    <th scope="col">Payment</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $o)
                    <tr>
                        <th>{{ $orders->count()-$index }}</th>
                        <td>{{ $o->user->name }}</td>
                        {{-- <td>
                            @if ($o->products->count() > 0)
                                <div class="row justify-content-center mb-4">
                                    <div class="col-md-5">
                                        <img src="{{ asset('storage/imgs/products/' . $o->products[0]->id . '/' . $o->products[0]->image) }}"
                                            class="w-100" style="object-fit:contain" height="100px" alt="image" />
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-bold">{{ $o->products[0]->name }}</p>
                                        <p class="mb-1">
                                            <span
                                                class="text-muted me-2">Category:</span><span>{{ $o->products[0]->category->name }}</span>
                                        </p>
                                        <p>
                                            <span
                                                class="text-muted me-2">Price:</span><span>${{ number_format($o->products[0]->original_price, 2, '.', ',') }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="text-end">x{{ $o->order_items[0]->qty }}</div>
                                    </div>
                                </div>
                            @endif
                        </td> --}}
                        <td>{{ $o->uuid }}</td>
                        <td class="text-end">{{ $o->products->count() }}</td>
                        <td class="text-end">{{ number_format($o->total_price, 2, '.', ',') }}</td>
                        <td>
                            @switch($o->status)
                                @case(1)
                                    <span class="badge bg-secondary">Unconfirmed</span>
                                @break

                                @case(2)
                                    <span class="badge bg-primary">Confirmed</span>
                                @break

                                @case(3)
                                    <span class="badge bg-warning">Delivery</span>
                                @break

                                @case(4)
                                    <span class="badge bg-success">Complete</span>
                                @break

                                @default
                                    <span class="badge bg-danger">Cancel</span>
                            @endswitch
                        </td>
                        <td>{!! $o->payment_mode == 1
                            ? '<span class="badge bg-secondary">Unpaid</span>'
                            : '<span class="badge bg-success">Paid</span>' !!}</td>
                        <td>{{ $o->created_at }}</td>

                        <td>
                            <a href="{{ route('orders.edit', ['order' => $o->uuid]) }}"><button
                                    class="btn btn-primary">View</button></a>
                            @if ($o->status < 2 && Auth::user()->role_as === 1)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $o->id }}">
                                    Cancel
                                </button>
                            @endif
                        </td>
                    </tr>

                    @if (Auth::user()->role_as === 1)
                        <div class="modal fade" id="deleteModal{{ $o->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><i
                                                class="bi bi-exclamation-circle-fill text-danger"></i> Warning!!!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to cancel <span class="text-danger">{{ $o->uuid }}</span>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <form action="{{ route('orders.changeStatus', [$o->id, 5]) }}" method="post">
                                                @method('put')
                                                @csrf
                                                <button class="btn btn-danger me-1">Cancel</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $('#table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [2, 8]
            }],
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "pagingType": "full_numbers",
            "order": [
                [7, 'desc']
            ]
        });
    </script>
    @if (session('success'))
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
@endsection
