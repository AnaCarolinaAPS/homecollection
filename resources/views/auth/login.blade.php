@extends('auth.master')

@section('title')
    <title>Login | HomeController</title>
@endsection

@section('auth')

    <h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>

    <div class="p-3">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-3">
            @csrf

            <div class="form-group mb-3 row">
                <div class="col-12">
                    <input class="form-control" type="text" required="" placeholder="Email" id="email" name="email" :value="old('email')" autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="form-group mb-3 row">
                <div class="col-12">
                    <input class="form-control" type="password" required="" placeholder="Password" id="password" name="password" autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="form-group mb-3 row">
                <div class="col-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                        <label class="form-label ms-1" for="remember_me">Remember me</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3 text-center row mt-3 pt-1">
                <div class="col-12">
                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                </div>
            </div>

            <div class="form-group mb-0 row mt-2">
                <div class="col-sm-7 mt-3">
                    <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                </div>
                <div class="col-sm-5 mt-3">
                    <a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                </div>
            </div>
        </form>
    </div>
    <!-- end -->
@endsection
