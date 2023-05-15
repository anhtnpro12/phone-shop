@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mb-5">
        <a href="{{ route('categories.create') }}"><button class="btn btn-success mt-3 mb-3">Add Product</button></a>
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
                            <img src="{{ asset('storage/imgs/'.$c->id.'/'.$c->image) }}" alt="image" style="width: 100px;">
                        </td>
                        <td>{{ $c->description }}</td>
                        <td>{{ $c->popular }}</td>
                        <td>
                            <a href="{{ route('categories.edit', ['category' => $c->id]) }}"><button class="btn btn-primary">Edit</button></a>
                            <a href="#">
                                <button class="btn btn-danger">Deactivate</button>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $categories->links() }}
    </div>

@endsection

@section('scripts')

@endsection
