@extends('layouts.default')

@section('contents')
    <div class="container d-flex justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
                                Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-md-4 col-form-label text-md-end text-start">Phone</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    <div class="input-group-text">
                                        <i class="bi bi-eye-fill" id="togglePassword" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordConfirmation = document.querySelector('#password_confirmation');
        togglePassword.addEventListener('click', (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConfirmation.setAttribute('type', type);
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
