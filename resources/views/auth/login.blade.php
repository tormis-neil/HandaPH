@extends('layouts.auth')

@section('title', 'HandaPH — Admin Login')

@section('content')
<div class="login-container px-3">

  <div class="text-center mb-4">
    <a href="{{ route('home') }}" class="text-decoration-none d-inline-block">
      <h1 class="h3 fw-bold mb-0" style="color: var(--color-primary); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
        <i class="fa-solid fa-shield-halved" style="color: var(--color-brand);"></i>
        <span>Handa<span class="brand-accent">PH</span></span>
      </h1>
    </a>
    <p class="text-muted small mt-1">Admin Portal</p>
  </div>

  <div class="card p-4 shadow-sm border-0 rounded-4">
    <h2 class="h5 fw-bold text-center mb-4 text-primary">Sign In</h2>

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label fw-semibold small text-muted">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}"
               placeholder="admin@handaph.local" required autofocus>
      </div>

      <div class="mb-4">
        <label for="password" class="form-label fw-semibold small text-muted">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password" placeholder="••••••••" required>
      </div>

      <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary fw-bold py-2">Sign In</button>
      </div>

      <div class="text-center">
        <a href="{{ route('home') }}" class="small text-decoration-none text-muted">
          <i class="fa-solid fa-arrow-left me-1"></i> Back to Home
        </a>
      </div>
    </form>
  </div>

</div>
@endsection