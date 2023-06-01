@extends('layouts.default')

@section('styles')

@endsection

@section('contents')
    <div class="container mt-5 mb-5 d-flex flex-column align-items-center">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post" style="width: 50%;">
            @method('PUT')
            @csrf

            <h3 class="text-center">User</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('name', $user->name) }}" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name">
                @foreach ($errors->get('name') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('address', $user->address) }}" name="address" class="form-control @if ($errors->has('address')) is-invalid @endif" id="address" >
                @foreach ($errors->get('address') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" value="{{ old('phone', $user->phone) }}" name="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif" id="phone" >
                @foreach ($errors->get('phone') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" value="{{ old('email', $user->email) }}" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" >
                @foreach ($errors->get('email') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            @if (Auth::user()->role_as === 1)
                <div class="mb-3">
                    <label for="role_as" class="form-label">Role <span class="text-danger">*</span></label>
                    <select id="role_as" name="role_as" class="selectpicker"
                            data-live-search="true" data-width="100%"
                            data-style="border" data-size="5">
                            <option value="1" {{ $user->role_as==1 ? 'selected' : '' }} data-content='<span class="badge bg-primary">Admin</span>'>Admin</option>
                            <option value="2" {{ $user->role_as==2 ? 'selected' : '' }} data-content='<span class="badge bg-secondary">Customer</span>'>Customer</option>
                    </select>
                </div>
            @else
                <input type="hidden" name="role_as" value="2">
            @endif
            <input type="submit" name="submit" value="Update now" class="btn btn-primary">
            @if (Auth::user()->role_as === 1)
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            @endif
        </form>
        <form action="{{ route('users.changePassword', ['id' => $user->id]) }}" method="post" style="width: 50%;">
            @method('PUT')
            @csrf
            <h3 class="text-center mt-3">Change Password</h3>

            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" value="" name="old_password"
                            class="form-control @if ($errors->has('old_password')) is-invalid @endif" id="old_password" style="display: inline-block" >
                    <div class="input-group-text togglePassword">
                        <i class="bi bi-eye-fill " style="cursor: pointer;"></i>
                    </div>
                </div>
                @foreach ($errors->get('old_password') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" value="" name="password"
                            class="form-control @if ($errors->has('password')) is-invalid @endif" id="password" style="display: inline-block" >
                    <div class="input-group-text togglePassword">
                        <i class="bi bi-eye-fill" style="cursor: pointer;"></i>
                    </div>
                </div>
                @foreach ($errors->get('password') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="password_confirmation"
                    class="col-form-label text-md-end text-start">Confirm New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation"
                        name="password_confirmation">
                    <div class="input-group-text togglePassword">
                        <i class="bi bi-eye-fill" style="cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Change now" class="btn btn-primary">
            @if (Auth::user()->role_as === 1)
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            @endif
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const togglePasswords = document.querySelectorAll('.togglePassword');
        togglePasswords.forEach((tp) => {
            tp.addEventListener('click', (e) => {
                const input = tp.parentElement.querySelector('input');
                const eye = tp.querySelector('i');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                eye.classList.toggle('bi-eye-fill');
                eye.classList.toggle('bi-eye-slash-fill');
            });
        });
    </script>
    @if($errors->any())
        <script>
            showErrorToast('Update User failed!!');
        </script>
    @endif
    @if(session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
@endsection
