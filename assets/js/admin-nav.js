'use strict';

/**
 * HandaPH Admin — Sidebar Navigation Toggle
 * Handles the hamburger menu for the off-canvas sidebar drawer on mobile.
 * Loaded on every admin page for consistent behaviour.
 */

document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn  = document.getElementById('sidebarToggle');
  const sidebar    = document.querySelector('.admin-sidebar');
  const overlay    = document.getElementById('sidebarOverlay');

  if (!toggleBtn || !sidebar || !overlay) return;

  // ── Open / close helpers ──
  function openSidebar() {
    sidebar.classList.add('sidebar-open');
    overlay.classList.add('active');
    toggleBtn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden'; // prevent background scroll
  }

  function closeSidebar() {
    sidebar.classList.remove('sidebar-open');
    overlay.classList.remove('active');
    toggleBtn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  // ── Hamburger click ──
  toggleBtn.addEventListener('click', () => {
    if (sidebar.classList.contains('sidebar-open')) {
      closeSidebar();
    } else {
      openSidebar();
    }
  });

  // ── Overlay click closes drawer ──
  overlay.addEventListener('click', closeSidebar);

  // ── Pressing Escape closes drawer ──
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && sidebar.classList.contains('sidebar-open')) {
      closeSidebar();
    }
  });

  // ── Clicking a nav link closes drawer on mobile ──
  // (so the page navigates without leaving the drawer open)
  sidebar.querySelectorAll('.sidebar-nav-link').forEach(link => {
    link.addEventListener('click', () => {
      // Only close via JS if viewport is mobile-sized
      if (window.innerWidth < 992) {
        closeSidebar();
      }
    });
  });

  // ── Auto-close if window is resized to desktop ──
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 992) {
      sidebar.classList.remove('sidebar-open');
      overlay.classList.remove('active');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
  });
});
