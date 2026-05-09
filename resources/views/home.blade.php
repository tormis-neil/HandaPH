@extends('layouts.public')

@section('title', 'HandaPH — Be Ready Before the Storm')
@section('description', 'HandaPH — A personalized typhoon preparedness system that helps Filipino families build their Go-Bag and action plan before, during, and after a storm.')

@section('content')

  <main class="page-content" id="main-content">


      <!-- ===== HERO SECTION ===== -->
      <section class="hero-section" aria-labelledby="hero-heading">
        <div class="container">
          <div class="row align-items-center">

            <!-- Hero Text Column -->
            <div class="col-12 col-lg-6 hero-text-col">
              <span class="hero-eyebrow">
                <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                Typhoon Preparedness
              </span>

              <h1 id="hero-heading" class="hero-heading">
                Be Ready<br>
                <span class="hero-heading-accent">Before the Storm</span>
              </h1>

              <p class="hero-subtext">
                HandaPH generates a personalized preparedness plan for your household — based on
                your location, family size, and special needs. No more guessing. No more
                last-minute panic.
              </p>

              <!-- Hero Stats Row -->
              <div class="hero-stats" aria-label="Key statistics">
                <div class="hero-stat">
                  <span class="hero-stat-value">20+</span>
                  <span class="hero-stat-label">Cyclones per year</span>
                </div>
                <div class="hero-stat-divider" aria-hidden="true"></div>
                <div class="hero-stat">
                  <span class="hero-stat-value">27%</span>
                  <span class="hero-stat-label">Have a Go-Bag ready</span>
                </div>
                <div class="hero-stat-divider" aria-hidden="true"></div>
                <div class="hero-stat">
                  <span class="hero-stat-value">3</span>
                  <span class="hero-stat-label">Phases covered</span>
                </div>
              </div>

              <!-- CTA Button -->
              <a href="{{ route('checklist') }}" class="btn btn-primary btn-hero">
                <i class="fa-solid fa-clipboard-list" aria-hidden="true"></i>
                Generate Your Plan
              </a>

              <p class="hero-note">
                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                No registration required. Completely free.
              </p>
            </div>

            <!-- Hero Illustration Column -->
            <div class="col-12 col-lg-6 hero-img-col" aria-hidden="true">
              <div class="hero-illustration">
                <svg viewBox="0 0 420 380" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">

                  <!-- Background circle -->
                  <circle cx="210" cy="190" r="170" fill="#F1F5F9" />

                  <!-- Storm cloud -->
                  <ellipse cx="290" cy="80" rx="55" ry="30" fill="#CBD5E1" />
                  <ellipse cx="265" cy="90" rx="40" ry="28" fill="#CBD5E1" />
                  <ellipse cx="318" cy="88" rx="38" ry="25" fill="#CBD5E1" />
                  <ellipse cx="290" cy="100" rx="58" ry="22" fill="#CBD5E1" />

                  <!-- Rain drops -->
                  <line x1="262" y1="115" x2="254" y2="132" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
                  <line x1="280" y1="118" x2="272" y2="135" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
                  <line x1="298" y1="116" x2="290" y2="133" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
                  <line x1="316" y1="118" x2="308" y2="135" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>

                  <!-- House base -->
                  <rect x="120" y="210" width="180" height="120" rx="4" fill="#FFFFFF" stroke="#E2E8F0" stroke-width="2"/>

                  <!-- House roof -->
                  <polygon points="105,215 210,135 315,215" fill="#1E293B"/>
                  <polygon points="210,140 295,210 210,210" fill="#0F172A" opacity="0.15"/>

                  <!-- Door -->
                  <rect x="188" y="268" width="44" height="62" rx="4" fill="#E2E8F0" stroke="#CBD5E1" stroke-width="1.5"/>
                  <circle cx="225" cy="300" r="3" fill="#94A3B8"/>

                  <!-- Left window -->
                  <rect x="135" y="230" width="46" height="40" rx="4" fill="#BAE6FD" stroke="#E2E8F0" stroke-width="1.5"/>
                  <line x1="158" y1="230" x2="158" y2="270" stroke="#E2E8F0" stroke-width="1.5"/>
                  <line x1="135" y1="250" x2="181" y2="250" stroke="#E2E8F0" stroke-width="1.5"/>

                  <!-- Right window -->
                  <rect x="239" y="230" width="46" height="40" rx="4" fill="#BAE6FD" stroke="#E2E8F0" stroke-width="1.5"/>
                  <line x1="262" y1="230" x2="262" y2="270" stroke="#E2E8F0" stroke-width="1.5"/>
                  <line x1="239" y1="250" x2="285" y2="250" stroke="#E2E8F0" stroke-width="1.5"/>

                  <!-- Shield overlapping roof -->
                  <path d="M210,148 L240,162 L240,188 Q240,208 210,218 Q180,208 180,188 L180,162 Z" fill="#EA580C" opacity="0.95"/>
                  <polyline points="196,184 206,196 226,172" fill="none" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>

                  <!-- Ground line -->
                  <rect x="90" y="328" width="240" height="6" rx="3" fill="#E2E8F0"/>

                  <!-- Tree left -->
                  <rect x="96" y="298" width="8" height="30" rx="2" fill="#CBD5E1"/>
                  <ellipse cx="100" cy="288" rx="18" ry="18" fill="#86EFAC"/>
                  <ellipse cx="100" cy="280" rx="14" ry="14" fill="#4ADE80"/>

                  <!-- Tree right -->
                  <rect x="316" y="298" width="8" height="30" rx="2" fill="#CBD5E1"/>
                  <ellipse cx="320" cy="288" rx="18" ry="18" fill="#86EFAC"/>
                  <ellipse cx="320" cy="280" rx="14" ry="14" fill="#4ADE80"/>

                </svg>
              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- ===== END HERO SECTION ===== -->


      <!-- ===== FEATURE CARDS SECTION ===== -->
      <section class="features-section section-pad" aria-labelledby="features-heading">
        <div class="container">

          <div class="section-header">
            <h2 id="features-heading" class="section-heading">Everything You Need to Prepare</h2>
            <p class="section-subtext">Personalized, actionable, and designed for Filipino families.</p>
          </div>

          <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-12 col-md-6 col-lg-3">
              <article class="feature-card h-100">
                <div class="feature-card-icon feature-icon-orange" aria-hidden="true">
                  <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h3 class="feature-card-title">Personalized Checklist</h3>
                <p class="feature-card-text">
                  Answer 4 quick questions about your household and get a tailored
                  preparedness plan for Before, During, and After the storm.
                </p>
                <a href="{{ route('checklist') }}" class="feature-card-link" aria-label="Go to Personalized Checklist">
                  Start checklist <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
              </article>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-md-6 col-lg-3">
              <article class="feature-card h-100">
                <div class="feature-card-icon feature-icon-navy" aria-hidden="true">
                  <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <h3 class="feature-card-title">Go-Bag Guide</h3>
                <p class="feature-card-text">
                  Learn exactly what to pack in your emergency bag — Essentials,
                  Recommended items, and budget-friendly alternatives.
                </p>
                <a href="{{ route('go-bag') }}" class="feature-card-link" aria-label="Go to Go-Bag Guide">
                  View guide <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
              </article>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-md-6 col-lg-3">
              <article class="feature-card h-100">
                <div class="feature-card-icon feature-icon-orange" aria-hidden="true">
                  <i class="fa-solid fa-star"></i>
                </div>
                <h3 class="feature-card-title">Share Feedback</h3>
                <p class="feature-card-text">
                  Help us improve HandaPH by rating your experience and sharing
                  suggestions. Your input shapes future updates.
                </p>
                <a href="{{ route('feedback') }}" class="feature-card-link" aria-label="Go to Feedback page">
                  Give feedback <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
              </article>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-md-6 col-lg-3">
              <article class="feature-card h-100">
                <div class="feature-card-icon feature-icon-navy" aria-hidden="true">
                  <i class="fa-solid fa-file-arrow-down"></i>
                </div>
                <h3 class="feature-card-title">Download Resources</h3>
                <p class="feature-card-text">
                  Save your personalized checklist as a PDF for offline access.
                  Works even when power and internet are out.
                </p>
                <a href="{{ route('checklist') }}" class="feature-card-link" aria-label="Generate and download your checklist">
                  Get your PDF <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
              </article>
            </div>

          </div>
        </div>
      </section>
      <!-- ===== END FEATURE CARDS SECTION ===== -->


      <!-- ===== HOW IT WORKS SECTION ===== -->
      <section class="how-section section-pad-sm" aria-labelledby="how-heading">
        <div class="container">

          <div class="section-header">
            <h2 id="how-heading" class="section-heading">How HandaPH Works</h2>
            <p class="section-subtext">Three simple steps to a complete household plan.</p>
          </div>

          <div class="row g-4 justify-content-center">

            <div class="col-12 col-md-4">
              <div class="how-step">
                <div class="how-step-number" aria-hidden="true">1</div>
                <h3 class="how-step-title">Answer 4 Questions</h3>
                <p class="how-step-text">
                  Tell us your location type, household size, any special members,
                  and your house material.
                </p>
              </div>
            </div>



            <div class="col-12 col-md-4">
              <div class="how-step">
                <div class="how-step-number how-step-number--orange" aria-hidden="true">2</div>
                <h3 class="how-step-title">Get Your Plan</h3>
                <p class="how-step-text">
                  We generate a personalized checklist covering Before, During,
                  and After the typhoon — tailored to your household.
                </p>
              </div>
            </div>



            <div class="col-12 col-md-4">
              <div class="how-step">
                <div class="how-step-number" aria-hidden="true">3</div>
                <h3 class="how-step-title">Save & Stay Ready</h3>
                <p class="how-step-text">
                  Download your checklist as a PDF. Keep it offline so you're
                  prepared even when the internet goes out.
                </p>
              </div>
            </div>

          </div>

          <div class="text-center mt-5">
            <a href="{{ route('checklist') }}" class="btn btn-primary btn-lg px-5">
              <i class="fa-solid fa-clipboard-list" aria-hidden="true"></i>
              Start Your Plan Now
            </a>
          </div>

        </div>
      </section>
      <!-- ===== END HOW IT WORKS SECTION ===== -->


      <!-- ===== MYTH-BUSTING SECTION ===== -->
      <section class="myths-section section-pad" aria-labelledby="myths-heading">
        <div class="container">

          <div class="section-header">
            <h2 id="myths-heading" class="section-heading">Common Typhoon Myths</h2>
            <p class="section-subtext">
              Dangerous misconceptions that put lives at risk — and the facts that correct them.
            </p>
          </div>

          <div class="accordion myths-accordion" id="mythsAccordion">

            @forelse($myths as $index => $myth)
            <!-- Myth {{ $index + 1 }} -->
            <div class="accordion-item myth-item">
              <h3 class="accordion-header">
                <button class="accordion-button myth-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#myth{{ $myth->id }}"
                  aria-expanded="false" aria-controls="myth{{ $myth->id }}">
                  <span class="myth-label" aria-label="Myth">MYTH</span>
                  "{{ $myth->myth }}"
                </button>
              </h3>
              <div id="myth{{ $myth->id }}" class="accordion-collapse collapse" data-bs-parent="#mythsAccordion">
                <div class="accordion-body myth-body">
                  <div class="myth-fact-label">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    The Fact
                  </div>
                  <p>
                    {{ $myth->fact }}
                  </p>
                  <p class="myth-action">
                    <strong>What to do:</strong> {{ $myth->action }}
                  </p>
                </div>
              </div>
            </div>
            @empty
              <p class="text-muted text-center py-4">No typhoon myths available yet.</p>
            @endforelse

          </div>
        </div>
      </section>
      <!-- ===== END MYTH-BUSTING SECTION ===== -->


      <!-- ===== CTA BANNER ===== -->
      <section class="cta-banner section-pad-sm" aria-labelledby="cta-heading">
        <div class="container">
          <div class="cta-banner-inner">
            <div class="cta-banner-text">
              <h2 id="cta-heading" class="cta-banner-heading">
                Don't wait for the warning signal.
              </h2>
              <p class="cta-banner-subtext">
                Build your family's plan today. It takes less than 2 minutes.
              </p>
            </div>
            <div class="cta-banner-actions">
              <a href="{{ route('checklist') }}" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-clipboard-list" aria-hidden="true"></i>
                Generate Your Plan
              </a>
              <a href="{{ route('go-bag') }}" class="btn btn-outline-light btn-lg">
                <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                View Go-Bag Guide
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- ===== END CTA BANNER ===== -->


    </main>
    <!-- ===== END MAIN CONTENT ===== -->

@endsection