<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('description', 'HandaPH Admin')">
  <title>@yield('title', 'HandaPH — Admin')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

  @stack('styles')
</head>
<body>

  <div class="admin-wrapper">

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Admin sidebar">
      <a href="#" class="sidebar-brand">
        <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
        Handa<span class="brand-accent">PH</span>
      </a>

      <div class="sidebar-admin-label">Main Menu</div>

      <nav class="sidebar-nav" aria-label="Admin navigation">
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-chart-pie" aria-hidden="true"></i> Analytics
        </a>
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-comments" aria-hidden="true"></i> Feedback Management
        </a>
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-list-check" aria-hidden="true"></i> Checklist Rules
        </a>
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-lightbulb" aria-hidden="true"></i> Preparedness Tips
        </a>
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Go-Bag Items
        </a>
      </nav>

      <div class="sidebar-signout">
        <a href="#" class="sidebar-nav-link">
          <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i> Sign Out
        </a>
      </div>
    </aside>

    <main class="admin-main">

      <header class="admin-topbar">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="adminSidebar">
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
        </button>
        <h2 class="topbar-title">@yield('topbar_title', 'Overview')</h2>
        <div class="topbar-user">
          <a href="#" class="topbar-user-link" aria-label="Admin account settings">
            <i class="fa-solid fa-circle-user fs-5 text-primary" aria-hidden="true"></i>
            <span class="d-none d-sm-inline fw-medium">Admin User</span>
          </a>
        </div>
      </header>

      <div class="admin-body">
        @yield('content')
      </div>

    </main>

  </div>

  <div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/admin-nav.js') }}"></script>

  @stack('scripts')

</body>
</html>