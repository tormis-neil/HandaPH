@extends('layouts.admin')

@section('title', 'HandaPH — Admin Dashboard')
@section('topbar_title', 'Overview')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Analytics</h1>
    <p class="page-subtext">Manage your platform content and track incoming statistics.</p>
  </div>
</div>

<div class="stat-row">
  <div class="stat-card">
    <div class="stat-value text-primary">{{ number_format($totalQueries) }}</div>
    <div class="stat-label">Total Queries</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-secondary">{{ number_format($totalFeedback) }}</div>
    <div class="stat-label">Feedback Received</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-success">{{ number_format($activeTips) }}</div>
    <div class="stat-label">Active Tip Sets</div>
  </div>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-6">
    <div class="chart-card">
      <h3 class="chart-title">Location Type Distribution</h3>
      <p class="chart-subtitle">Breakdown of reported resident living zones</p>
      <canvas id="locationChart" aria-label="Location Distribution Chart" role="img"></canvas>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="chart-card">
      <h3 class="chart-title">Household Size</h3>
      <p class="chart-subtitle">Average family count queries</p>
      <canvas id="householdSizeChart" aria-label="Household Size Donut Chart" role="img"></canvas>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="chart-card">
      <h3 class="chart-title">Special Needs</h3>
      <p class="chart-subtitle">Children, Seniors, PWDs, Pets</p>
      <canvas id="specialNeedsChart" aria-label="Special Needs Bar Chart" role="img"></canvas>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="chart-card">
      <h3 class="chart-title">House Material Types</h3>
      <p class="chart-subtitle">Reported structural integrity of queried homes</p>
      <canvas id="houseTypeChart" aria-label="House Material Distribution Chart" role="img"></canvas>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <meta name="analytics-url" content="{{ route('admin.api.analytics') }}">
  <script src="{{ asset('assets/js/admin-charts.js') }}"></script>
@endpush