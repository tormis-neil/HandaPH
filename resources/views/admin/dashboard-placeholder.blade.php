@extends('layouts.admin')

@section('title', 'HandaPH — Admin Dashboard')
@section('topbar_title', 'Dashboard')

@section('content')
  <div class="admin-page-header">
    <div>
      <h1>Welcome, {{ auth()->user()->name }}</h1>
      <p class="page-subtext">Admin dashboard placeholder. Real analytics arrive on Day 4.</p>
    </div>
  </div>

  <div class="card p-4">
    <p class="mb-3">You are successfully signed in. ✓</p>

    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-outline-danger">
        <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Sign Out
      </button>
    </form>
  </div>
@endsection