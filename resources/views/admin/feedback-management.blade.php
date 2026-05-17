@extends('layouts.admin')

@section('title', 'HandaPH — Feedback Management')
@section('topbar_title', 'Feedback Management')

@section('content')

<div class="admin-page-header d-flex justify-content-between align-items-center mb-4">
  <div>
    <h1>System Evaluation Logs</h1>
    <p class="page-subtext mb-0">Review submitted ISO/IEC 25010 Quality Model evaluations.</p>
  </div>
  <div>
    <a href="{{ route('admin.feedback.export') }}" target="_blank" class="btn btn-outline-primary shadow-sm">
      <i class="fa-solid fa-file-pdf me-2"></i>Export to PDF
    </a>
  </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="fw-bold text-primary mb-0"><i class="fa-solid fa-chart-pie me-2"></i>Average Metric Scores (Out of 5)</h5>
            </div>
            <div class="card-body">
                <div class="row text-center gy-4">
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-primary">{{ $stats['effectiveness'] }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Effectiveness">Effect.</div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-info">{{ $stats['efficiency'] }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Efficiency">Effic.</div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-success">{{ number_format(($stats['satisfaction_usefulness'] + $stats['satisfaction_trust'] + $stats['satisfaction_pleasure'] + $stats['satisfaction_comfort']) / 4, 1) }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Satisfaction (Average of 4 metrics)">Satis.</div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-warning">{{ number_format(($stats['risk_economic'] + $stats['risk_health_safety'] + $stats['risk_environmental']) / 3, 1) }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Freedom from risk (Average of 3 metrics)">Risk F.</div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-danger">{{ $stats['context_coverage'] }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Context Coverage">Context</div>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="fs-3 fw-bold text-secondary">{{ $stats['flexibility'] }}</div>
                        <div class="text-muted small fw-bold text-uppercase" title="Flexibility">Flex.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="admin-table-wrapper mb-5">
  <div class="table-responsive">
    <table class="table admin-table align-middle" aria-label="User Feedback Submissions" style="font-size: 0.85rem;">
      <thead class="text-center">
        <tr>
          <th scope="col" rowspan="2" class="align-middle text-start">Date</th>
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
            <td colspan="12" class="text-center">
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
<div class="admin-table-wrapper">
  <table class="table admin-table" aria-label="Written Feedback Comments">
    <thead>
      <tr>
        <th scope="col" style="width: 15%">Date</th>
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
          <td>{{ $fb->comments }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="2">
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
