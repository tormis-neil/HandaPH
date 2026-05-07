@extends('layouts.public')

@section('title', 'HandaPH — Create Your Checklist')
@section('description', 'Answer 4 quick questions and get a personalized typhoon preparedness plan for your household.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/checklist.css') }}">
@endpush

@section('content')

<section class="checklist-page-header">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-12 col-lg-7">
        <h1 class="checklist-page-title">Create Your Plan</h1>
        <p class="checklist-page-subtext">
          Answer a few questions to generate a personalized preparedness checklist.
        </p>
      </div>
    </div>
  </div>
</section>

@if (! isset($results))
{{-- ============ FORM (shown when no results yet) ============ --}}
<section class="questionnaire-section section-pad" aria-label="Preparedness questionnaire">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-7">

        <div class="progress-wrapper" id="progressWrapper" aria-label="Questionnaire progress">
          <div class="progress-header">
            <span class="progress-label" id="progressLabel">Question 1 of 4</span>
            <span class="progress-pct" id="progressPct">25%</span>
          </div>
          <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" id="progressBar" style="width: 25%;"></div>
          </div>
        </div>

        <form action="{{ route('checklist.generate') }}" method="POST" id="checklistForm">
          @csrf

          <input type="hidden" name="location" id="input-location" value="">
          <input type="hidden" name="household_size" id="input-household-size" value="">
          <input type="hidden" name="house_type" id="input-house-type" value="">
          <div id="input-special-needs-container"></div>

          {{-- Step 1 — Location --}}
          <div class="step-card" id="step1" role="group" aria-labelledby="step1-question">
            <p class="step-question" id="step1-question">
              <span class="step-number" aria-hidden="true">1</span>
              What type of area do you live in?
            </p>
            <div class="option-grid">
              <button class="option-btn" data-step="1" data-value="coastal" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-water"></i></span>
                <span class="option-text">Coastal Area</span>
              </button>
              <button class="option-btn" data-step="1" data-value="mountainous" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-mountain"></i></span>
                <span class="option-text">Mountainous Area</span>
              </button>
              <button class="option-btn" data-step="1" data-value="inland" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-city"></i></span>
                <span class="option-text">Inland or Urban Area</span>
              </button>
              <button class="option-btn" data-step="1" data-value="flood-prone" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-house-flood-water"></i></span>
                <span class="option-text">Flood-Prone Area</span>
              </button>
            </div>
            <div class="step-nav step-nav--first">
              <div></div>
              <button class="btn btn-primary step-next-btn" id="step1Next" type="button" disabled>
                Next <i class="fa-solid fa-arrow-right"></i>
              </button>
            </div>
          </div>

          {{-- Step 2 — Household size --}}
          <div class="step-card" id="step2" role="group" hidden>
            <p class="step-question">
              <span class="step-number">2</span>
              How many people live in your household?
            </p>
            <div class="option-grid">
              <button class="option-btn" data-step="2" data-value="1" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-user"></i></span>
                <span class="option-text">1 Person</span>
              </button>
              <button class="option-btn" data-step="2" data-value="2-4" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-user-group"></i></span>
                <span class="option-text">2–4 People</span>
              </button>
              <button class="option-btn" data-step="2" data-value="5-7" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-people-group"></i></span>
                <span class="option-text">5–7 People</span>
              </button>
              <button class="option-btn" data-step="2" data-value="8-plus" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-people-roof"></i></span>
                <span class="option-text">8 or More</span>
              </button>
            </div>
            <div class="step-nav">
              <button class="btn btn-outline-primary step-back-btn" type="button" data-target="1">
                <i class="fa-solid fa-arrow-left"></i> Back
              </button>
              <button class="btn btn-primary step-next-btn" id="step2Next" type="button" disabled>
                Next <i class="fa-solid fa-arrow-right"></i>
              </button>
            </div>
          </div>

          {{-- Step 3 — Special needs (multi) --}}
          <div class="step-card" id="step3" role="group" hidden>
            <p class="step-question">
              <span class="step-number">3</span>
              Does your household include any of the following?
            </p>
            <p class="step-hint">
              <i class="fa-solid fa-circle-info"></i>
              Select all that apply. You may skip this if none apply.
            </p>
            <div class="option-grid">
              <button class="option-btn option-btn--multi" data-step="3" data-value="children" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-child"></i></span>
                <span class="option-text">Children (0–12 years)</span>
                <span class="option-check"><i class="fa-solid fa-check"></i></span>
              </button>
              <button class="option-btn option-btn--multi" data-step="3" data-value="seniors" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-person-cane"></i></span>
                <span class="option-text">Senior Citizens (60+)</span>
                <span class="option-check"><i class="fa-solid fa-check"></i></span>
              </button>
              <button class="option-btn option-btn--multi" data-step="3" data-value="pwd" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-wheelchair"></i></span>
                <span class="option-text">Persons with Disabilities</span>
                <span class="option-check"><i class="fa-solid fa-check"></i></span>
              </button>
              <button class="option-btn option-btn--multi" data-step="3" data-value="pets" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-paw"></i></span>
                <span class="option-text">Pets</span>
                <span class="option-check"><i class="fa-solid fa-check"></i></span>
              </button>
            </div>
            <div class="step-nav">
              <button class="btn btn-outline-primary step-back-btn" type="button" data-target="2">
                <i class="fa-solid fa-arrow-left"></i> Back
              </button>
              <button class="btn btn-primary step-next-btn" id="step3Next" type="button">
                Next <i class="fa-solid fa-arrow-right"></i>
              </button>
            </div>
          </div>

          {{-- Step 4 — House material --}}
          <div class="step-card" id="step4" role="group" hidden>
            <p class="step-question">
              <span class="step-number">4</span>
              What is your house mainly made of?
            </p>
            <div class="option-grid option-grid--3">
              <button class="option-btn" data-step="4" data-value="light" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-tree"></i></span>
                <span class="option-text">Light Materials</span>
                <span class="option-subtext">Bamboo, wood, nipa</span>
              </button>
              <button class="option-btn" data-step="4" data-value="semi-concrete" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-layer-group"></i></span>
                <span class="option-text">Semi-Concrete</span>
                <span class="option-subtext">Mixed hollow blocks & wood</span>
              </button>
              <button class="option-btn" data-step="4" data-value="concrete" aria-pressed="false" type="button">
                <span class="option-icon"><i class="fa-solid fa-building"></i></span>
                <span class="option-text">Concrete</span>
                <span class="option-subtext">Full hollow blocks or CHB</span>
              </button>
            </div>
            <div class="step-nav">
              <button class="btn btn-outline-primary step-back-btn" type="button" data-target="3">
                <i class="fa-solid fa-arrow-left"></i> Back
              </button>
              <button class="btn btn-primary" id="generateBtn" type="submit" disabled>
                <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Checklist
              </button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</section>
@endif

@if (isset($results))
{{-- ============ RESULTS (shown after successful POST) ============ --}}
<section class="results-section checklist-results" aria-label="Your personalized checklist">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9">

        <div class="results-header text-center">
          <div class="results-badge"><i class="fa-solid fa-shield-halved"></i></div>
          <h2 class="results-title">Your Personalized Checklist</h2>
          <p class="results-subtext">Based on your household details, here's what you need to prepare.</p>

          <div class="results-summary">
            @php
              $locLabels  = ['coastal'=>'Coastal Area','mountainous'=>'Mountainous Area','inland'=>'Inland / Urban Area','flood-prone'=>'Flood-Prone Area'];
              $sizeLabels = ['1'=>'1 Person','2-4'=>'2–4 People','5-7'=>'5–7 People','8-plus'=>'8+ People'];
              $needLabels = ['children'=>'Children','seniors'=>'Senior Citizens','pwd'=>'PWDs','pets'=>'Pets'];
              $houseLabels= ['light'=>'Light Materials','semi-concrete'=>'Semi-Concrete','concrete'=>'Concrete'];
            @endphp
            <span class="summary-pill"><i class="fa-solid fa-map-marker-alt"></i>{{ $locLabels[$selections['location']] }}</span>
            <span class="summary-pill"><i class="fa-solid fa-users"></i>{{ $sizeLabels[$selections['household_size']] }}</span>
            @if (count($selections['special_needs']) > 0)
              @foreach ($selections['special_needs'] as $need)
                <span class="summary-pill"><i class="fa-solid fa-heart"></i>{{ $needLabels[$need] }}</span>
              @endforeach
            @else
              <span class="summary-pill"><i class="fa-solid fa-heart"></i>No special needs selected</span>
            @endif
            <span class="summary-pill"><i class="fa-solid fa-house"></i>{{ $houseLabels[$selections['house_type']] }}</span>
          </div>
        </div>

        <div class="important-reminder" role="alert">
          <div class="reminder-label">
            <i class="fa-solid fa-triangle-exclamation"></i> Important Reminder
          </div>
          <p>
            Always follow official advisories from <strong>PAGASA</strong>, <strong>NDRRMC</strong>,
            and your <strong>local government unit</strong>. This guide provides general information
            and should not replace official instructions.
          </p>
        </div>

        <div class="results-actions">
          <button class="btn btn-dark-navy" type="button" onclick="window.print()">
            <i class="fa-solid fa-file-arrow-down"></i> Download Checklist
          </button>
          <a href="{{ route('checklist') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-rotate-left"></i> Start Over
          </a>
        </div>

        <div class="checklist-tabs-wrapper">
          <ul class="nav nav-tabs checklist-nav-tabs" id="checklistTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link checklist-tab-btn active" data-bs-toggle="tab" data-bs-target="#panel-before" type="button" role="tab">
                <i class="fa-solid fa-clock-rotate-left"></i> Before
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link checklist-tab-btn" data-bs-toggle="tab" data-bs-target="#panel-during" type="button" role="tab">
                <i class="fa-solid fa-bolt"></i> During
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link checklist-tab-btn" data-bs-toggle="tab" data-bs-target="#panel-after" type="button" role="tab">
                <i class="fa-solid fa-sun"></i> After
              </button>
            </li>
          </ul>

          <div class="tab-content checklist-tab-content">
            @foreach (['before', 'during', 'after'] as $phase)
              <div class="tab-pane fade {{ $phase === 'before' ? 'show active' : '' }}" id="panel-{{ $phase }}" role="tabpanel">
                <ul class="checklist-items-list">
                  @forelse ($results[$phase] as $rule)
                    <li class="checklist-item">
                      <span class="checklist-item-check"><i class="fa-solid fa-check"></i></span>
                      <span class="checklist-item-text">{{ $rule->item_text }}</span>
                      <span class="checklist-item-tag {{ $rule->tag_class }}">{{ $rule->tag }}</span>
                    </li>
                  @empty
                    <li class="checklist-empty">
                      <i class="fa-solid fa-circle-check"></i>
                      <p>No specific items for this phase based on your selections.</p>
                    </li>
                  @endforelse
                </ul>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="feedback-cta">
    <div class="container">
      <div class="feedback-cta-inner">
        <div>
          <h3 class="feedback-cta-title">How was your experience?</h3>
          <p class="feedback-cta-text">Help us improve HandaPH for every Filipino family.</p>
        </div>
        <a href="{{ route('feedback') }}" class="btn btn-primary">
          <i class="fa-solid fa-star"></i> Give Feedback
        </a>
      </div>
    </div>
  </div>

</section>
@endif

@endsection

@push('scripts')
  @if (! isset($results))
    <script src="{{ asset('assets/js/checklist.js') }}"></script>
  @endif
@endpush