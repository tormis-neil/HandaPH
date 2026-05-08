@extends('layouts.public')

@section('title', 'HandaPH — Emergency Go-Bag Guide')
@section('description', 'A visual, tabbed guide for packing an emergency Go-Bag so you can evacuate quickly.')

@section('content')

  <!-- ===== MAIN CONTENT ===== -->
    <main class="page-content" id="main-content">

      <!-- PAGE HEADER -->
      <section class="section-pad pb-4">
        <div class="container text-center">
          <div class="row justify-content-center">
            <div class="col-12 col-md-8">
              <h1 class="section-heading">Emergency Go-Bag Guide</h1>
              <p class="section-subtext mb-4">
                A Go Bag contains survival essentials you need when you have to evacuate quickly.
                It should be packed and ready at all times.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- CAROUSEL SECTION -->
      <section class="container pb-5">
        <div id="goBagCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators mb-3">
            <button type="button" data-bs-target="#goBagCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#goBagCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#goBagCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner shadow-sm rounded-4">
            <!-- Slide 1 -->
            <div class="carousel-item active">
              <div class="gobag-carousel-slide gobag-slide-dark">
                <i class="fa-solid fa-suitcase-medical fa-3x mb-3 text-warning"></i>
                <h3 class="mb-2 text-white">General Tips</h3>
                <p class="mb-0" style="max-width: 500px; opacity: 0.9;">Maintain a 72-hour survival kit consisting of non-perishable food, water, and first aid ready for grab-and-go emergencies.</p>
              </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
              <div class="gobag-carousel-slide gobag-slide-light">
                <i class="fa-solid fa-users text-primary fa-3x mb-3"></i>
                <h3 class="mb-2 text-primary">Special Needs</h3>
                <p class="mb-0" style="max-width: 500px;">Include extra diapers, medications, baby formulas, and accessibility items tailored to the specific individuals relying on your bag.</p>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
              <div class="gobag-carousel-slide gobag-slide-dark">
                <i class="fa-solid fa-piggy-bank text-success fa-3x mb-3"></i>
                <h3 class="mb-2 text-white">Budget Alternatives</h3>
                <p class="mb-0" style="max-width: 500px; opacity: 0.9;">A capable Go-Bag doesn't have to be expensive. Recycled water containers and household first-aid scraps go a long way.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#goBagCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-secondary rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#goBagCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-secondary rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>

      <!-- TABS SECTION -->
      <section class="container pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
          <!-- Pills -->
          <ul class="nav nav-pills gobag-nav-pills" id="gobagPills" role="tablist">
            @forelse($categories as $categoryName => $items)
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                  id="pills-{{ Str::slug($categoryName) }}-tab" 
                  data-bs-toggle="pill" 
                  data-bs-target="#pills-{{ Str::slug($categoryName) }}" 
                  type="button" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                  {{ $categoryName }}
                </button>
              </li>
            @empty
              <li class="nav-item">
                <button class="nav-link active">No Categories</button>
              </li>
            @endforelse
          </ul>

          <button class="btn btn-dark-navy" type="button" onclick="window.print()">
            <i class="fa-solid fa-file-pdf me-2"></i>Download Complete Guide
          </button>
        </div>

        <div class="tab-content" id="gobagPillsContent">
          @forelse($categories as $categoryName => $items)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
              id="pills-{{ Str::slug($categoryName) }}" 
              role="tabpanel" 
              aria-labelledby="pills-{{ Str::slug($categoryName) }}-tab" tabindex="0">
              <div class="row g-3">
                @foreach($items as $item)
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="gobag-item-card h-100 d-flex flex-column">
                      <div class="gobag-item-icon mb-3"><i class="fa-solid fa-box text-primary fs-3"></i></div>
                      <div class="gobag-item-content flex-grow-1">
                        <h4 class="mb-2">{{ $item->name }}</h4>
                        <p class="mb-0 text-muted">{{ $item->description }}</p>
                      </div>
                      @if($item->budget_alternative)
                        <div class="mt-3 pt-3 border-top small">
                          <span class="text-success fw-bold"><i class="fa-solid fa-piggy-bank me-1"></i> Budget Alt:</span>
                          <span class="text-muted">{{ $item->budget_alternative }}</span>
                        </div>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @empty
            <div class="text-center py-5">
              <i class="fa-solid fa-backpack text-muted fa-3x mb-3 opacity-50"></i>
              <p class="text-muted fw-medium">Check back soon! We are packing our recommended Go-Bag items.</p>
            </div>
          @endforelse
        </div>
      </section>

      <!-- Feedback CTA -->
      <div class="feedback-cta" aria-label="Share feedback">
        <div class="container">
          <div class="feedback-cta-inner text-center py-5 bg-white border rounded shadow-sm">
            <h3 class="feedback-cta-title mb-2">How was your experience?</h3>
            <p class="feedback-cta-text mb-4 text-muted">Help us improve HandaPH for every Filipino family.</p>
            <a href="{{ route('feedback') }}" class="btn btn-primary btn-lg">
              <i class="fa-solid fa-star me-2" aria-hidden="true"></i>
              Give Feedback
            </a>
          </div>
        </div>
      </div>
    </main>
    <!-- ===== END MAIN CONTENT ===== -->

@endsection