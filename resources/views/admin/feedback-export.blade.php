<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISO/IEC 25010 Evaluation Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            font-size: 12px;
            padding: 20px;
        }
        .header-title {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }
        .stats-table th, .stats-table td {
            text-align: center;
            padding: 8px;
        }
        .stats-table th {
            background-color: #f8f9fa;
        }
        table.table-bordered {
            border: 1px solid #dee2e6;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; font-size: 10px; }
            .page-break { page-break-after: always; }
        }
        
        .main-table th {
            background-color: #e9ecef !important;
            font-size: 10px;
        }
    </style>
</head>
<body onload="window.print()">

<div class="no-print mb-4 text-center">
    <button onclick="window.print()" class="btn btn-primary">Print / Save as PDF</button>
    <button onclick="window.close()" class="btn btn-secondary">Close</button>
</div>

<div class="header-title">
    <h2 class="mb-1">HandaPH System Evaluation Report</h2>
    <p class="mb-0 text-muted">ISO/IEC 25010 Quality Model Submissions</p>
    <p class="mb-0 text-muted">Generated: {{ now()->format('F j, Y g:i A') }}</p>
</div>

<h4 class="mb-3">Overall Average Metric Scores (Out of 5)</h4>
<div class="table-responsive mb-4">
    <table class="table table-bordered stats-table">
        <tr>
            <th>Total Submissions</th>
            <th>Effectiveness</th>
            <th>Efficiency</th>
            <th>Satisfaction (Avg)</th>
            <th>Risk Freedom (Avg)</th>
            <th>Context Coverage</th>
            <th>Flexibility</th>
        </tr>
        <tr>
            <td class="fw-bold">{{ $stats['total'] }}</td>
            <td>{{ $stats['effectiveness'] }}</td>
            <td>{{ $stats['efficiency'] }}</td>
            <td>{{ number_format(($stats['satisfaction_usefulness'] + $stats['satisfaction_trust'] + $stats['satisfaction_pleasure'] + $stats['satisfaction_comfort']) / 4, 1) }}</td>
            <td>{{ number_format(($stats['risk_economic'] + $stats['risk_health_safety'] + $stats['risk_environmental']) / 3, 1) }}</td>
            <td>{{ $stats['context_coverage'] }}</td>
            <td>{{ $stats['flexibility'] }}</td>
        </tr>
    </table>
</div>

<h4 class="mb-3">Detailed Evaluation Logs</h4>
<div class="table-responsive mb-4">
    <table class="table table-bordered table-sm main-table align-middle text-center">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle text-start">Date</th>
                <th rowspan="2" class="align-middle">Effec.</th>
                <th rowspan="2" class="align-middle">Effic.</th>
                <th colspan="4">Satisfaction</th>
                <th colspan="3">Risk Freedom</th>
                <th rowspan="2" class="align-middle">Cont.</th>
                <th rowspan="2" class="align-middle">Flex.</th>
            </tr>
            <tr>
                <th>Use</th>
                <th>Tru</th>
                <th>Ple</th>
                <th>Com</th>
                <th>Eco</th>
                <th>Hea</th>
                <th>Env</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $fb)
                <tr>
                    <td class="text-start" style="white-space: nowrap;">{{ $fb->created_at->format('M d, Y g:i A') }}</td>
                    <td>{{ $fb->effectiveness }}</td>
                    <td>{{ $fb->efficiency }}</td>
                    <td>{{ $fb->satisfaction_usefulness }}</td>
                    <td>{{ $fb->satisfaction_trust }}</td>
                    <td>{{ $fb->satisfaction_pleasure }}</td>
                    <td>{{ $fb->satisfaction_comfort }}</td>
                    <td>{{ $fb->risk_economic }}</td>
                    <td>{{ $fb->risk_health_safety }}</td>
                    <td>{{ $fb->risk_environmental }}</td>
                    <td>{{ $fb->context_coverage }}</td>
                    <td>{{ $fb->flexibility }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center py-4">No Evaluation Submissions Yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@php
    $commentsList = $feedbacks->filter(fn($f) => !empty($f->comments));
@endphp

@if($commentsList->count() > 0)
<div class="page-break"></div>
<h4 class="mb-3">Written Comments & Suggestions</h4>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th style="width: 20%; background-color: #e9ecef;">Date</th>
                <th style="background-color: #e9ecef;">Comment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commentsList as $fb)
                <tr>
                    <td>{{ $fb->created_at->format('M d, Y g:i A') }}</td>
                    <td>{{ $fb->comments }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

</body>
</html>
