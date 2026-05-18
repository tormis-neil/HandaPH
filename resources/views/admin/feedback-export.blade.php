<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISO-IEC 25010 Evaluation Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header-title { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        .text-start { text-align: left; }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

@if(empty($isExcel) || !$isExcel)
<div class="no-print" style="text-align: center; margin-bottom: 20px;">
    <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; cursor: pointer; background-color: #0d6efd; color: white; border: none; border-radius: 4px; margin-right: 10px;">Print / Save as PDF</button>
    <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px; cursor: pointer; background-color: #6c757d; color: white; border: none; border-radius: 4px;">Close</button>
</div>
<script>
    window.onload = function() { window.print(); }
</script>
@endif

<div class="header-title">
    <h2>HandaPH System Evaluation Report</h2>
    <p>ISO/IEC 25010 Quality Model Submissions</p>
    <p>Generated: {{ now()->format('F j, Y g:i A') }}</p>
</div>

@if($analytics)
<h4>Overall Summary</h4>
<table>
    <tr>
        <th>Total Respondents</th>
        <th>Overall System Mean</th>
        <th>Interpretation</th>
    </tr>
    <tr>
        <td>{{ $analytics['total'] }}</td>
        <td>{{ $analytics['overall']['mean'] }}</td>
        <td>{{ $analytics['overall']['interpretation'] }}</td>
    </tr>
</table>

<h4>Category Averages</h4>
<table>
    <tr>
        <th class="text-start">Category</th>
        <th>Mean</th>
        <th>Interpretation</th>
    </tr>
    @foreach($analytics['categories'] as $catName => $data)
    <tr>
        <td class="text-start">{{ $catName }}</td>
        <td>{{ $data['mean'] }}</td>
        <td>{{ $data['interpretation'] }}</td>
    </tr>
    @endforeach
</table>

<h4>Detailed ISO/IEC 25010 Tally</h4>
<table>
    <tr>
        <th class="text-start">Criteria</th>
        <th>Total Score</th>
        <th>Mean Average</th>
        <th>Interpretation</th>
    </tr>
    @foreach($analytics['criteria'] as $criterion => $data)
    <tr>
        <td class="text-start text-capitalize">{{ str_replace('_', ' ', $criterion) }}</td>
        <td>{{ $data['sum'] }}</td>
        <td>{{ $data['mean'] }}</td>
        <td>{{ $data['interpretation'] }}</td>
    </tr>
    @endforeach
</table>
@endif

<h4>Raw Submissions</h4>
<table>
    <thead>
        <tr>
            <th rowspan="2">Date</th>
            <th rowspan="2">Effectiveness</th>
            <th rowspan="2">Efficiency</th>
            <th colspan="4">Satisfaction</th>
            <th colspan="3">Risk Freedom</th>
            <th rowspan="2">Context Coverage</th>
            <th rowspan="2">Flexibility</th>
        </tr>
        <tr>
            <th>Usefulness</th>
            <th>Trust</th>
            <th>Pleasure</th>
            <th>Comfort</th>
            <th>Economic</th>
            <th>Health/Safety</th>
            <th>Environmental</th>
        </tr>
    </thead>
    <tbody>
        @forelse($feedbacks as $fb)
            <tr>
                <td>{{ $fb->created_at->format('M d, Y') }}</td>
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
                <td colspan="12">No Submissions Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
