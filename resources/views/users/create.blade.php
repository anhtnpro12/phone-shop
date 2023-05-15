@extends('layouts.default')

@section('styles')

@endsection

@section('contents')
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('users.store') }}" method="post" style="width: 50%;">
            @method('post')
            @csrf
            <h3 class="text-center">Add User</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control @if ($errors->has('address')) is-invalid @endif" id="address" >
                @foreach ($errors->get('address') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" value="{{ old('phone') }}" name="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif" id="phone" >
                @foreach ($errors->get('phone') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" >
                @foreach ($errors->get('email') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" value="{{ old('password') }}" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" id="password" >
                @foreach ($errors->get('password') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="role_as" class="form-label">Role</label>
                <input type="number" value="{{ old('role_as') }}" name="role_as" class="form-control @if ($errors->has('role_as')) is-invalid @endif" id="role_as" >
                @foreach ($errors->get('role_as') as $message)
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
            showErrorToast('Create Category failed!!');
        </script>
    @endif
@endsection
