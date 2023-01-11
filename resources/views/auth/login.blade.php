@extends('layouts.app', ['title' => 'Login'])
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-5">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bolder mb-3">Login</h2>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary form-control">Login</button>
                        </form>
                    </div>
                    <div class="text-center">
                        <p class="text-muted">Not a member? <a href="{{ route('show-register') }}"
                                class="fw-bold text-body">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
