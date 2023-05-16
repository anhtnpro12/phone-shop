@extends('layouts.default')

@section('styles')

@endsection

@section('contents')
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('ships.store') }}" method="post" style="width: 50%;">
            @method('post')
            @csrf
            <h3 class="text-center">Add Shipping Method</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" value="{{ old('description') }}" name="description"
                        class="form-control @if ($errors->has('description')) is-invalid @endif" id="description" >
                @foreach ($errors->get('description') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <input type="submit" name="submit" value="Add now" class="btn btn-primary">
        </form>
    </div>
@endsection

@section('scripts')
    @if($errors->any())
        <script>
            showErrorToast('Create Shipping Method Failed!!');
        </script>
    @endif
@endsection
