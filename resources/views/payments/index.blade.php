@extends('layouts.default')

@section('styles')
@endsection

@section('contents')
    <div class="container mb-5">
        <a href="{{ route('payments.create') }}"><button class="btn btn-success mt-3 mb-3">Add Payment Method</button></a>
        <table class="table table-hover" id="table">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $p)
                    <tr>
                        <th>{{ $p->id }}</th>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>

                        <td>
                            <a href="{{ route('payments.edit', ['payment' => $p->id]) }}"><button
                                    class="btn btn-primary">Edit</button></a>
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
                                    <form action="{{ route('payments.destroy', ['payment' => $p->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $payments->currentPage() }}">
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        {{ $payments->links() }}
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
    <script>
        $('#table').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            "pagingType": "full_numbers"
        });
    </script>
    @if(app('request')->input('success'))
        <script>
            showSuccessToast('{{ app('request')->input('success') }}');
        </script>
    @endif
    @if(session('error'))
        <script>
            showErrorToast('{{ session('error') }}');
        </script>
    @endif
@endsection
