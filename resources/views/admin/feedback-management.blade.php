@extends('layouts.admin')

@section('title', 'HandaPH — Feedback Management')
@section('topbar_title', 'Feedback Management')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>User Feedback Logs</h1>
    <p class="page-subtext">Review submitted platform survey ratings and comments.</p>
  </div>
</div>

<div class="stat-row">
  <div class="stat-card">
    <div class="stat-value text-primary">{{ $stats['avgRating'] }}</div>
    <div class="stat-label">Average Star Rating</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-secondary">{{ number_format($stats['total']) }}</div>
    <div class="stat-label">Total Submissions</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-success">{{ $stats['veryEasyPercent'] }}%</div>
    <div class="stat-label">Reported 'Very Easy'</div>
  </div>
</div>

<div class="card p-3 mb-4 shadow-sm border-0">
  <form action="{{ route('admin.feedback') }}" method="GET" class="row gy-2 gx-3 align-items-center">
    <div class="col-sm-3">
      <label class="visually-hidden" for="filterRating">Rating Filter</label>
      <select class="form-select" id="filterRating" name="rating">
        <option value="all" {{ request('rating') == 'all' || !request('rating') ? 'selected' : '' }}>All Ratings</option>
        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
      </select>
    </div>
    <div class="col-sm-3">
      <label class="visually-hidden" for="filterRegion">Region Filter</label>
      <select class="form-select" id="filterRegion" name="region">
        <option value="all" {{ request('region') == 'all' || !request('region') ? 'selected' : '' }}>All Regions</option>
        <option value="NCR" {{ request('region') == 'NCR' ? 'selected' : '' }}>NCR</option>
        <option value="Region III" {{ request('region') == 'Region III' ? 'selected' : '' }}>Region III</option>
        <!-- The live system captures full strings, these are common defaults -->
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fa-solid fa-filter" aria-hidden="true"></i> Apply Filters
      </button>
      @if(request()->has('rating') || request()->has('region'))
        <a href="{{ route('admin.feedback') }}" class="btn btn-light ms-2">Clear</a>
      @endif
    </div>
  </form>
</div>

<div class="admin-table-wrapper mb-5">
  <table class="table admin-table" aria-label="User Feedback Submissions">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Rating</th>
        <th scope="col">Understandability</th>
        <th scope="col">Helpfulness</th>
        <th scope="col">Location</th>
      </tr>
    </thead>
    <tbody>
      @forelse($feedbacks as $fb)
        <tr>
          <td>{{ $fb->created_at->format('M d, Y g:i A') }}</td>
          <td>
            @for($i=1; $i<=5; $i++)
              <i class="fa-solid fa-star {{ $i <= $fb->rating ? 'text-warning' : 'text-muted' }}"></i>
            @endfor
          </td>
          <td>
            @if($fb->easy_to_understand == 'yes_very_easy')
              <span class="badge bg-success">Very Easy</span>
            @elseif($fb->easy_to_understand == 'somewhat')
              <span class="badge bg-warning text-dark">Somewhat</span>
            @elseif($fb->easy_to_understand == 'confusing')
              <span class="badge bg-danger">Confusing</span>
            @else
              <span class="text-muted">-</span>
            @endif
          </td>
          <td>
            @if($fb->helpful_prepare == 'yes_very_helpful')
              <span class="badge bg-success">Very Helpful</span>
            @elseif($fb->helpful_prepare == 'somewhat_helpful')
              <span class="badge bg-warning text-dark">Somewhat</span>
            @elseif($fb->helpful_prepare == 'no_not_really')
              <span class="badge bg-danger">Not Really</span>
            @else
              <span class="text-muted">-</span>
            @endif
          </td>
          <td>{{ $fb->region ?: '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">
            <div class="table-empty-state py-4">
              <i class="fa-solid fa-inbox text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Feedback Submissions Yet</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
  
  @if($feedbacks->hasPages())
    <div class="mt-4">
      {{ $feedbacks->links() }}
    </div>
  @endif
</div>

<h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Written Suggestions</h2>
<div class="admin-table-wrapper">
  <table class="table admin-table" aria-label="Written Feedback Comments">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Region</th>
        <th scope="col">Improvement Suggestion</th>
      </tr>
    </thead>
    <tbody>
      @php
        $comments = $feedbacks->filter(fn($f) => !empty($f->improve_comments));
      @endphp
      @forelse($comments as $fb)
        <tr>
          <td style="white-space: nowrap;">{{ $fb->created_at->format('M d, Y') }}</td>
          <td>{{ $fb->region ?: '-' }}</td>
          <td>{{ $fb->improve_comments }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="3">
            <div class="table-empty-state py-4">
              <i class="fa-regular fa-comment-dots text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Comments Found</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
