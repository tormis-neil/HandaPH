@extends('layouts.public')

@section('title', 'HandaPH — Share Your Feedback')
@section('description', 'Share your thoughts on our preparedness checklist to help us improve.')

@section('content')

<section class="section-pad pb-4">
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8">
        <h1 class="section-heading">Share Your Feedback</h1>
        <p class="section-subtext mb-2">Help us improve this resource.</p>
      </div>
    </div>
  </div>
</section>

<section class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">

      @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
          <i class="fa-solid fa-circle-check fs-4"></i>
          <span class="fw-bold">{{ session('success') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <div class="card p-4 p-md-5 shadow-sm border-0 rounded-4">
        <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm" novalidate>
          @csrf

          <div class="mb-5">
            <label class="form-label fw-bold text-primary mb-3">Overall Rating</label>
            <div class="star-rating-widget" id="starRatingWidget" role="radiogroup" aria-label="Rate your experience from 1 to 5 stars">
              <button type="button" class="star-btn" data-value="1" aria-label="1 star" role="radio" aria-checked="false"><i class="fa-solid fa-star"></i></button>
              <button type="button" class="star-btn" data-value="2" aria-label="2 stars" role="radio" aria-checked="false"><i class="fa-solid fa-star"></i></button>
              <button type="button" class="star-btn" data-value="3" aria-label="3 stars" role="radio" aria-checked="false"><i class="fa-solid fa-star"></i></button>
              <button type="button" class="star-btn" data-value="4" aria-label="4 stars" role="radio" aria-checked="false"><i class="fa-solid fa-star"></i></button>
              <button type="button" class="star-btn" data-value="5" aria-label="5 stars" role="radio" aria-checked="false"><i class="fa-solid fa-star"></i></button>
            </div>
            <input type="hidden" name="rating" id="ratingValue" value="0">
            <div class="invalid-feedback" id="ratingError">Please provide a rating.</div>
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold text-primary mb-2">Was the checklist easy to understand?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="easy_to_understand" id="easyYes" value="yes_very_easy">
              <label class="form-check-label text-muted" for="easyYes">Yes, very easy</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="easy_to_understand" id="easySomewhat" value="somewhat">
              <label class="form-check-label text-muted" for="easySomewhat">Somewhat</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="easy_to_understand" id="easyConfusing" value="confusing">
              <label class="form-check-label text-muted" for="easyConfusing">Confusing</label>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold text-primary mb-2">Did the checklist help you identify what to prepare?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="helpful_prepare" id="helpYes" value="yes_very_helpful">
              <label class="form-check-label text-muted" for="helpYes">Yes, very helpful</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="helpful_prepare" id="helpSomewhat" value="somewhat_helpful">
              <label class="form-check-label text-muted" for="helpSomewhat">Somewhat helpful</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="helpful_prepare" id="helpNo" value="no_not_really">
              <label class="form-check-label text-muted" for="helpNo">No, not really</label>
            </div>
          </div>

          <div class="mb-4">
            <label for="improveComments" class="form-label fw-bold text-primary mb-2">What would you like to improve?</label>
            <textarea class="form-control" id="improveComments" name="improve_comments" rows="4" placeholder="Optional comments, suggestions, or features you'd like to see..."></textarea>
          </div>

          <div class="mb-5">
            <label for="locationSelect" class="form-label fw-bold text-primary mb-2">Share your general location</label>
            <select class="form-select text-muted" id="locationSelect" name="region">
              <option value="" selected disabled>Select your region / province</option>
              <option value="NCR">National Capital Region (NCR)</option>
              <option value="CAR">Cordillera Administrative Region (CAR)</option>
              <option value="Region I">Region I (Ilocos Region)</option>
              <option value="Region II">Region II (Cagayan Valley)</option>
              <option value="Region III">Region III (Central Luzon)</option>
              <option value="Region IV-A">Region IV-A (CALABARZON)</option>
              <option value="Region IV-B">Region IV-B (MIMAROPA)</option>
              <option value="Region V">Region V (Bicol Region)</option>
              <option value="Region VI">Region VI (Western Visayas)</option>
              <option value="Region VII">Region VII (Central Visayas)</option>
              <option value="Region VIII">Region VIII (Eastern Visayas)</option>
              <option value="Region IX">Region IX (Zamboanga Peninsula)</option>
              <option value="Region X">Region X (Northern Mindanao)</option>
              <option value="Region XI">Region XI (Davao Region)</option>
              <option value="Region XII">Region XII (SOCCSKSARGEN)</option>
              <option value="Region XIII">Region XIII (Caraga)</option>
              <option value="BARMM">Bangsamoro Autonomous Region (BARMM)</option>
            </select>
          </div>

          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">Submit Feedback</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
  <script src="{{ asset('assets/js/feedback.js') }}"></script>
@endpush