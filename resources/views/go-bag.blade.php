@extends('layouts.app')

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
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-essentials-tab" data-bs-toggle="pill" data-bs-target="#pills-essentials" type="button" role="tab" aria-controls="pills-essentials" aria-selected="true">Essentials</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-recommended-tab" data-bs-toggle="pill" data-bs-target="#pills-recommended" type="button" role="tab" aria-controls="pills-recommended" aria-selected="false">Recommended</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-optional-tab" data-bs-toggle="pill" data-bs-target="#pills-optional" type="button" role="tab" aria-controls="pills-optional" aria-selected="false">Optional</button>
            </li>
          </ul>

          <button class="btn btn-dark-navy" type="button" onclick="window.print()">
            <i class="fa-solid fa-file-pdf me-2"></i>Download Complete Guide
          </button>
        </div>

        <div class="tab-content" id="gobagPillsContent">
          <!-- ESSENTIALS TAB -->
          <div class="tab-pane fade show active" id="pills-essentials" role="tabpanel" aria-labelledby="pills-essentials-tab" tabindex="0">
            <div class="row g-3">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-bottle-water"></i></div>
                  <div class="gobag-item-content">
                    <h4>Drinking Water</h4>
                    <p>1 liter per person, per day (for 3 days).</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-utensils"></i></div>
                  <div class="gobag-item-content">
                    <h4>Non-Perishable Food</h4>
                    <p>Easy-to-open canned goods, biscuits, or MREs.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-kit-medical"></i></div>
                  <div class="gobag-item-content">
                    <h4>First Aid Kit & Meds</h4>
                    <p>Bandages, alcohol, and prescription medicines.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-folder-open"></i></div>
                  <div class="gobag-item-content">
                    <h4>Important Documents</h4>
                    <p>Copies of IDs, birth certificates in a sealed pouch.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-flashlight"></i></div>
                  <div class="gobag-item-content">
                    <h4>Flashlight & Batteries</h4>
                    <p>Keeps you visible and helps navigation at night.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-wind"></i></div>
                  <div class="gobag-item-content">
                    <h4>Whistle</h4>
                    <p>Used to signal rescuers safely if trapped nearby.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- RECOMMENDED TAB -->
          <div class="tab-pane fade" id="pills-recommended" role="tabpanel" aria-labelledby="pills-recommended-tab" tabindex="0">
            <div class="row g-3">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-battery-full"></i></div>
                  <div class="gobag-item-content">
                    <h4>Power Bank</h4>
                    <p>Keep your mobile devices charged for critical updates.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-shirt"></i></div>
                  <div class="gobag-item-content">
                    <h4>Change of Clothes</h4>
                    <p>Clean undergarments and a warm outer layer.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                  <div class="gobag-item-content">
                    <h4>Extra Cash</h4>
                    <p>Small bills or coins in case ATMs are fully down.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-radio"></i></div>
                  <div class="gobag-item-content">
                    <h4>Battery-Powered Radio</h4>
                    <p>Access emergency broadcasts manually.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- OPTIONAL TAB -->
          <div class="tab-pane fade" id="pills-optional" role="tabpanel" aria-labelledby="pills-optional-tab" tabindex="0">
            <div class="row g-3">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-box"></i></div>
                  <div class="gobag-item-content">
                    <h4>DIY Waterproof Pouches</h4>
                    <p>Cheap Ziploc bags or secure trash bags to guard electronics.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-recycle"></i></div>
                  <div class="gobag-item-content">
                    <h4>Recycled Containers</h4>
                    <p>Used soda bottles refilled with drinking water.</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="gobag-item-card">
                  <div class="gobag-item-icon"><i class="fa-solid fa-bed"></i></div>
                  <div class="gobag-item-content">
                    <h4>Extra Comfort Items</h4>
                    <p>Minimal blankets or a stuffed toy for younger kids.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Feedback CTA -->
      <div class="feedback-cta" aria-label="Share feedback">
        <div class="container">
          <div class="feedback-cta-inner text-center py-5 bg-white border rounded shadow-sm">
            <h3 class="feedback-cta-title mb-2">How was your experience?</h3>
            <p class="feedback-cta-text mb-4 text-muted">Help us improve HandaPH for every Filipino family.</p>
            <a href="./feedback.html" class="btn btn-primary btn-lg">
              <i class="fa-solid fa-star me-2" aria-hidden="true"></i>
              Give Feedback
            </a>
          </div>
        </div>
      </div>
    </main>
    <!-- ===== END MAIN CONTENT ===== -->

@endsection