'use strict';

/**
 * Go-Bag Page Interactions
 * Handles any custom behavior for the Go-Bag tabs or download actions.
 */

document.addEventListener('DOMContentLoaded', () => {
  // Download button simulate print/PDF export
  const downloadBtn = document.querySelector('.btn-dark-navy');
  if (downloadBtn) {
    downloadBtn.addEventListener('click', () => {
      // In Phase 6, printing the page acts as the PDF export
      window.print();
    });
  }
});
