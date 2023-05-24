@extends('layouts.default')

@section('styles')
@endsection

@section('contents')
    <div class="container mb-5">
        <a href="{{ route('ships.create') }}"><button class="btn btn-success mt-3 mb-3">Add Shipping Method</button></a>
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
                @foreach ($ships as $s)
                    <tr>
                        <th>{{ $s->id }}</th>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->description }}</td>

                        <td>
                            <a href="{{ route('ships.edit', ['ship' => $s->id]) }}"><button
                                    class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $s->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                    Are you sure you want to delete <span class="text-danger">{{ $s->name }}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="{{ route('ships.destroy', ['ship' => $s->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="page" value="{{ $ships->currentPage() }}">
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
