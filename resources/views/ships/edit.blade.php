@extends('layouts.default')

@section('styles')

@endsection

@section('contents')
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('ships.update', ['ship' => $ship->id]) }}" method="post" style="width: 50%;">
            @method('put')
            @csrf
            <h3 class="text-center">Update Shipping Method</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name', $ship->name) }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ $ship->description }}</textarea>
            </div>
            <input type="submit" name="submit" value="Update now" class="btn btn-primary">
        </form>
    </div>
@endsection

@section('scripts')
    @if($errors->any())
        <script>
            showErrorToast('Update Shipping Method Failed!!');
        </script>
    @endif
    @if(request()->success && !$errors->any())
        <script>
            showSuccessToast('{{ request()->success }}');
        </script>
    @endif
@endsection