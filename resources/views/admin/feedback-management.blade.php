@extends('layouts.admin')

@section('title', 'HandaPH — Feedback Management')
@section('topbar_title', 'Feedback Management')

@section('content')

<div class="admin-page-header d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
  <div>
    <h1>System Evaluation Logs</h1>
    <p class="page-subtext mb-0">ISO/IEC 25010 Quality Model Analytics.</p>
  </div>
  
  <form method="GET" action="{{ route('admin.feedback') }}" class="d-flex gap-2 align-items-center">
      <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}" aria-label="Start Date">
      <span class="text-muted small">to</span>
      <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}" aria-label="End Date">
      <button type="submit" class="btn btn-sm btn-primary">Filter</button>
      @if(request()->has('start_date'))
        <a href="{{ route('admin.feedback') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
      @endif
      <a href="{{ route('admin.feedback.export') }}?{{ http_build_query(request()->all()) }}" target="_blank" class="btn btn-sm btn-outline-danger shadow-sm ms-2">
        <i class="fa-solid fa-file-pdf me-2"></i>PDF
      </a>
      <a href="{{ route('admin.feedback.export_excel') }}?{{ http_build_query(request()->all()) }}" class="btn btn-sm btn-outline-success shadow-sm ms-1">
        <i class="fa-solid fa-file-excel me-2"></i>Excel
      </a>
  </form>
</div>

@if($analytics)
<!-- Overall Summary Cards -->
<div class="row mb-4 g-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Total Respondents</h6>
                <h2 class="mb-0 fw-bold text-primary">{{ $analytics['total'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-9">
        <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-uppercase mb-2 text-white-50" style="font-size: 0.75rem;">Overall System Mean</h6>
                    <h2 class="mb-0 fw-bold">{{ $analytics['overall']['mean'] }} / 5.00</h2>
                </div>
                <div class="text-end">
                    <h6 class="fw-bold text-uppercase mb-2 text-white-50" style="font-size: 0.75rem;">Interpretation</h6>
                    <h3 class="mb-0 fw-bold text-warning">{{ $analytics['overall']['interpretation'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4 g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h6 class="fw-bold text-primary mb-0"><i class="fa-solid fa-chart-bar me-2"></i>Category Averages</h6>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h6 class="fw-bold text-primary mb-0"><i class="fa-solid fa-list-check me-2"></i>Category Summary</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Category</th>
                            <th class="text-center">Mean</th>
                            <th class="pe-3">Interpretation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($analytics['categories'] as $catName => $data)
                        <tr>
                            <td class="fw-medium ps-3">{{ $catName }}</td>
                            <td class="text-center fw-bold">{{ $data['mean'] }}</td>
                            <td class="pe-3"><span class="badge bg-secondary">{{ $data['interpretation'] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tally Tables -->
<div class="card border-0 shadow-sm mb-5">
    <div class="card-header bg-white border-bottom pt-4 pb-3">
        <h6 class="fw-bold text-primary mb-0"><i class="fa-solid fa-table me-2"></i>Detailed ISO/IEC 25010 Tally</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0" style="font-size: 0.9rem;">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Criteria</th>
                        <th class="text-center">Respondents (N)</th>
                        <th class="text-center">Total Score (&Sigma;)</th>
                        <th class="text-center">Mean Average (x&#772;)</th>
                        <th class="pe-3">Verbal Interpretation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analytics['criteria'] as $criterion => $data)
                    <tr>
                        <td class="text-capitalize ps-3">{{ str_replace('_', ' ', $criterion) }}</td>
                        <td class="text-center">{{ $analytics['total'] }}</td>
                        <td class="text-center">{{ $data['sum'] }}</td>
                        <td class="text-center fw-bold">{{ $data['mean'] }}</td>
                        <td class="pe-3"><span class="badge bg-info text-dark">{{ $data['interpretation'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@else
<div class="alert alert-info border-0 shadow-sm mb-4">
    <i class="fa-solid fa-circle-info me-2"></i>No evaluation data available for the selected period.
</div>
@endif


<h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Raw Submissions</h2>
<div class="admin-table-wrapper mb-5">
  <div class="table-responsive">
    <table class="table admin-table align-middle" aria-label="User Feedback Submissions" style="font-size: 0.85rem;">
      <thead class="text-center">
        <tr>
          <th scope="col" rowspan="2" class="align-middle text-start">Date</th>
          <th scope="col" rowspan="2" class="align-middle text-start">Respondent Name</th>
          <th scope="col" rowspan="2" class="align-middle text-start">Course & Section</th>
          <th scope="col" rowspan="2" class="align-middle" title="Effectiveness">Effec.</th>
          <th scope="col" rowspan="2" class="align-middle" title="Efficiency">Effic.</th>
          <th scope="col" colspan="4" class="border-bottom-0 pb-0">Satisfaction</th>
          <th scope="col" colspan="3" class="border-bottom-0 pb-0">Risk Freedom</th>
          <th scope="col" rowspan="2" class="align-middle" title="Context Coverage">Cont.</th>
          <th scope="col" rowspan="2" class="align-middle" title="Flexibility">Flex.</th>
        </tr>
        <tr>
          <th scope="col" title="Usefulness" class="fw-normal text-muted border-top-0 pt-0">Use</th>
          <th scope="col" title="Trust" class="fw-normal text-muted border-top-0 pt-0">Tru</th>
          <th scope="col" title="Pleasure" class="fw-normal text-muted border-top-0 pt-0">Ple</th>
          <th scope="col" title="Comfort" class="fw-normal text-muted border-top-0 pt-0">Com</th>
          <th scope="col" title="Economic" class="fw-normal text-muted border-top-0 pt-0">Eco</th>
          <th scope="col" title="Health/Safety" class="fw-normal text-muted border-top-0 pt-0">Hea</th>
          <th scope="col" title="Environmental" class="fw-normal text-muted border-top-0 pt-0">Env</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @forelse($feedbacks as $fb)
          <tr>
            <td class="text-start" style="white-space: nowrap;">{{ $fb->created_at->format('M d, Y g:i A') }}</td>
            <td class="text-start">{{ $fb->respondent_name ?? 'Anonymous' }}</td>
            <td class="text-start">{{ $fb->course_section ?? 'N/A' }}</td>
            <td><span class="badge bg-primary">{{ $fb->effectiveness }}</span></td>
            <td><span class="badge bg-info">{{ $fb->efficiency }}</span></td>
            <td><span class="badge bg-success">{{ $fb->satisfaction_usefulness }}</span></td>
            <td><span class="badge bg-success">{{ $fb->satisfaction_trust }}</span></td>
            <td><span class="badge bg-success">{{ $fb->satisfaction_pleasure }}</span></td>
            <td><span class="badge bg-success">{{ $fb->satisfaction_comfort }}</span></td>
            <td><span class="badge bg-warning text-dark">{{ $fb->risk_economic }}</span></td>
            <td><span class="badge bg-warning text-dark">{{ $fb->risk_health_safety }}</span></td>
            <td><span class="badge bg-warning text-dark">{{ $fb->risk_environmental }}</span></td>
            <td><span class="badge bg-danger">{{ $fb->context_coverage }}</span></td>
            <td><span class="badge bg-secondary">{{ $fb->flexibility }}</span></td>
          </tr>
        @empty
          <tr>
            <td colspan="14" class="text-center">
              <div class="table-empty-state py-4">
                <i class="fa-solid fa-inbox text-muted fs-3 border-0"></i>
                <p class="mb-0 mt-2 fw-medium">No Evaluation Submissions Yet</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  
  @if($feedbacks->hasPages())
    <div class="mt-4">
      {{ $feedbacks->links() }}
    </div>
  @endif
</div>

<h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Written Comments/Suggestions</h2>
<div class="admin-table-wrapper mb-5">
  <table class="table admin-table" aria-label="Written Feedback Comments">
    <thead>
      <tr>
        <th scope="col" style="width: 15%">Date</th>
        <th scope="col" style="width: 20%">Respondent Name</th>
        <th scope="col" style="width: 20%">Course & Section</th>
        <th scope="col">Improvement Suggestion</th>
      </tr>
    </thead>
    <tbody>
      @php
        $commentsList = $feedbacks->filter(fn($f) => !empty($f->comments));
      @endphp
      @forelse($commentsList as $fb)
        <tr>
          <td style="white-space: nowrap;">{{ $fb->created_at->format('M d, Y') }}</td>
          <td>{{ $fb->respondent_name ?? 'Anonymous' }}</td>
          <td>{{ $fb->course_section ?? 'N/A' }}</td>
          <td>{{ $fb->comments }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
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

@if($analytics)
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        
        const labels = {!! json_encode(array_keys($analytics['categories'])) !!};
        const data = {!! json_encode(array_map(function($cat) { return $cat['mean']; }, $analytics['categories'])) !!};
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Category Mean Score',
                    data: data,
                    backgroundColor: 'rgba(52, 144, 220, 0.7)',
                    borderColor: 'rgba(52, 144, 220, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endif

@endsection
