@extends('layouts.default')

@section('content')
    <div class="auth-page-content">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Create New Account</h5>
                                <p class="text-muted">Get your free account now</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" novalidate method="POST"
                                      action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="useremail" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" id="useremail"
                                               placeholder="Enter email address" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please enter email
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="username" class="form-label">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}" id="username"
                                               placeholder="Enter username" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please enter username
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="userpassword" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               id="userpassword" placeholder="Enter password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                    <div class=" mb-2">
                                        <label for="input-password">Confirm Password</label>
                                        <input type="password"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               name="password_confirmation" id="input-password"
                                               placeholder="Enter Confirm Password" required>

                                        <div class="form-floating-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree the
                                            <a href="#"
                                               class="text-primary text-decoration-underline fst-normal fw-medium">
                                                Terms of Use
                                            </a>
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                        </div>

                                        <div>
                                            <button type="button"
                                                    class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                    class="ri-facebook-fill fs-16"></i></button>
                                            <button type="button"
                                                    class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                    class="ri-google-fill fs-16"></i></button>
                                            <button type="button"
                                                    class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                    class="ri-github-fill fs-16"></i></button>
                                            <button type="button"
                                                    class="btn btn-info btn-icon waves-effect waves-light"><i
                                                    class="ri-twitter-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account? <a href="/login"
                                                                    class="fw-semibold text-primary text-decoration-underline">
                                Sign in </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            JohnVera.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
