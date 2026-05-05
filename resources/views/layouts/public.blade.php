<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('description', 'HandaPH — A personalized typhoon preparedness system.')">
  <title>@yield('title', 'HandaPH')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  @stack('styles')
</head>
<body>

  <div class="page-wrapper">

    <header>
      <nav class="navbar navbar-expand-lg handaph-navbar" aria-label="Main navigation">
        <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
            Handa<span class="brand-accent">PH</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavMenu" aria-controls="mainNavMenu" aria-expanded="false" aria-label="Toggle navigation menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mainNavMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Checklist</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('go-bag') ? 'active' : '' }}" href="{{ route('go-bag') }}">Go-Bag</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Feedback</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="page-content" id="main-content">
      @yield('content')
    </main>

    <footer class="handaph-footer" aria-label="Site footer">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 mb-4 mb-md-0">
            <div class="footer-brand">
              <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
              Handa<span class="brand-accent">PH</span>
            </div>
            <p class="footer-tagline">
              Personalized typhoon preparedness for every Filipino household.
            </p>
          </div>
          <div class="col-6 col-md-2 mb-4 mb-md-0">
            <h2 class="footer-heading">Quick Links</h2>
            <nav class="footer-links" aria-label="Footer quick links">
              <a href="{{ route('home') }}">Home</a>
              <a href="#">Checklist</a>
              <a href="{{ route('go-bag') }}">Go-Bag</a>
              <a href="#">Feedback</a>
            </nav>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h2 class="footer-heading">Resources</h2>
            <nav class="footer-links" aria-label="External resources">
              <a href="https://www.pagasa.dost.gov.ph" target="_blank" rel="noopener noreferrer">PAGASA</a>
              <a href="https://www.ndrrmc.gov.ph" target="_blank" rel="noopener noreferrer">NDRRMC</a>
              <a href="https://www.dilg.gov.ph" target="_blank" rel="noopener noreferrer">DILG</a>
            </nav>
          </div>
          <div class="col-12 col-md-3">
            <h2 class="footer-heading">Admin</h2>
            <nav class="footer-links" aria-label="Admin access">
              <a href="{{ route('login') }}">Admin Login</a>
            </nav>
          </div>
        </div>
        <hr class="footer-divider">
        <p class="footer-disclaimer">
          <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
          Not affiliated with any government agency. For official advisories, always follow PAGASA, NDRRMC, and your local government unit.
        </p>
        <p class="footer-copyright">
          &copy; {{ date('Y') }} HandaPH. Built to help Filipino families stay prepared.
        </p>
      </div>
    </footer>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')

</body>
</html>