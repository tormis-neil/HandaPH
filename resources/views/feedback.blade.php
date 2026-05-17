@extends('layouts.public')

@section('title', 'HandaPH — ISO/IEC 25010 Quality Evaluation')
@section('description', 'Evaluate the system using the ISO/IEC 25010 standard.')

@section('content')

<section class="section-pad pb-4">
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10">
        <h1 class="section-heading">System Evaluation Form</h1>
        <p class="section-subtext mb-2">Based on ISO/IEC 25010 System and Software Quality Models.</p>
      </div>
    </div>
  </div>
</section>

<section class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">

      @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
          <i class="fa-solid fa-circle-check fs-4"></i>
          <span class="fw-bold">{{ session('success') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <div class="fw-bold mb-2">Please correct the following errors:</div>
          <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
        </div>
      @endif

      <div class="card p-4 p-md-5 shadow-sm border-0 rounded-4">
        
        <div class="mb-4 alert alert-info bg-light border-0 text-muted">
            <h5 class="fw-bold mb-3 text-primary">Rating Scale Guide</h5>
            <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <tr><td style="width:40px"><span class="badge bg-primary">5</span></td><td style="width:180px" class="fw-bold">Highly Acceptable</td><td>If the condition is highly extensive and functioning excellently.</td></tr>
                        <tr><td><span class="badge bg-primary">4</span></td><td class="fw-bold">Acceptable</td><td>If the condition is extensive and functioning well.</td></tr>
                        <tr><td><span class="badge bg-primary">3</span></td><td class="fw-bold">Moderately Acceptable</td><td>If the condition is lightly extensive and functioning moderately.</td></tr>
                        <tr><td><span class="badge bg-primary">2</span></td><td class="fw-bold">Slightly Acceptable</td><td>If the condition is lightly extensive but functioning fairly.</td></tr>
                        <tr><td><span class="badge bg-primary">1</span></td><td class="fw-bold">Not Acceptable</td><td>If the condition is not extensive and functioning poorly.</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="mt-3 mb-0"><strong>Instruction:</strong> Please put a check in the box for the answer of your choice for each criteria below.</p>
        </div>

        <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm" novalidate>
          @csrf

          @php
          $categories = [
              'A. Effectiveness' => [
                  ['name' => 'effectiveness', 'desc' => 'Accuracy and completeness with which users achieve specified goals.']
              ],
              'B. Efficiency' => [
                  ['name' => 'efficiency', 'desc' => 'Resources expended in relation to the accuracy and completeness with which users achieve goals.']
              ],
              'C. Satisfaction' => [
                  ['name' => 'satisfaction_usefulness', 'desc' => '<b>Usefulness</b> – degree to which a user is satisfied with their perceived achievement of pragmatic goals, including the results of use and the consequences of use.'],
                  ['name' => 'satisfaction_trust', 'desc' => '<b>Trust</b> - degree to which a user or other stakeholder has confidence that a product or system will behave as intended.'],
                  ['name' => 'satisfaction_pleasure', 'desc' => '<b>Pleasure</b> - degree to which a user obtains pleasure from fulfilling their personal needs.<br><small class="text-muted d-block mt-1">Note: Personal needs can include needs to acquire new knowledge and skills, to communicate personal identity and to provoke pleasant memories.</small>'],
                  ['name' => 'satisfaction_comfort', 'desc' => '<b>Comfort</b> - degree to which the user is satisfied with physical comfort.']
              ],
              'D. Freedom from risk' => [
                  ['name' => 'risk_economic', 'desc' => '<b>Economic risk mitigation</b> - degree to which a product or system mitigates the potential risk to financial status, efficient operation, commercial property, reputation or other resources in the intended contexts of use.'],
                  ['name' => 'risk_health_safety', 'desc' => '<b>Health and safety risk mitigation</b> - degree to which a product or system mitigates the potential risk to people in the intended contexts of use.'],
                  ['name' => 'risk_environmental', 'desc' => '<b>Environmental risk mitigation</b> - degree to which a product or system mitigates the potential risk to property or the environment in the intended contexts of use.']
              ],
              'E. Context Coverage' => [
                  ['name' => 'context_coverage', 'desc' => 'Degree to which a product or system can be used with effectiveness, efficiency, freedom from risk and satisfaction in all the specified contexts of use.']
              ],
              'F. Flexibility' => [
                  ['name' => 'flexibility', 'desc' => 'Degree to which a product or system can be used with effectiveness, efficiency, freedom from risk and satisfaction in contexts beyond those initially specified in the requirements.']
              ],
          ];
          @endphp

          @foreach($categories as $catTitle => $items)
          <div class="mb-5">
            <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">{{ $catTitle }}</h5>
            
            <div class="table-responsive">
              <table class="table table-borderless align-middle mb-0">
                <thead class="text-center small text-muted">
                  <tr>
                    <th class="text-start">Criteria</th>
                    <th style="width: 60px">5</th>
                    <th style="width: 60px">4</th>
                    <th style="width: 60px">3</th>
                    <th style="width: 60px">2</th>
                    <th style="width: 60px">1</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <tr class="border-bottom">
                    <td class="py-3 pe-4">
                      <div class="text-dark">{!! $item['desc'] !!}</div>
                    </td>
                    @for($i = 5; $i >= 1; $i--)
                    <td class="text-center py-3">
                      <input class="form-check-input fs-5 border-secondary shadow-sm" style="cursor: pointer;" type="radio" name="{{ $item['name'] }}" id="{{ $item['name'] }}_{{ $i }}" value="{{ $i }}" required>
                    </td>
                    @endfor
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @endforeach

          <div class="mb-4 mt-5">
            <label for="improveComments" class="form-label fw-bold text-primary mb-2">Comments/Suggestions:</label>
            <textarea class="form-control" id="improveComments" name="comments" rows="4" placeholder="Optional comments, suggestions, or features you'd like to see..."></textarea>
          </div>

          <div class="d-grid mt-5">
            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">Submit Evaluation</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

@endsection