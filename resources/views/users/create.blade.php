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
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control @if ($errors->has('address')) is-invalid @endif" id="address" >
                @foreach ($errors->get('address') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('phone') }}" name="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif" id="phone" >
                @foreach ($errors->get('phone') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" value="{{ old('email') }}" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" >
                @foreach ($errors->get('email') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" value="{{ old('password') }}" name="password"
                            class="form-control @if ($errors->has('password')) is-invalid @endif" id="password" style="display: inline-block" >
                    <div class="input-group-text">
                        <i class="bi bi-eye-fill" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                </div>
                @foreach ($errors->get('password') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="role_as" class="form-label">Role <span class="text-danger">*</span></label>
                <select id="role_as" name="role_as" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        <option value="1" data-content='<span class="badge bg-primary">Admin</span>'>Admin</option>
                        <option value="2" selected data-content='<span class="badge bg-secondary">Customer</span>'>Customer</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Add now" class="btn btn-primary">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>  
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            e.target.classList.toggle('bi-eye-fill');
            e.target.classList.toggle('bi-eye-slash-fill');
        });
    </script>
    @if($errors->any())
        <script>
            showErrorToast('Create Users failed!!');
        </script>
    @endif
@endsection
