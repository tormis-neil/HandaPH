'use strict';

/**
 * Feedback Page Interactions
 * Handles the custom Star Rating widget and prevents form submission, displaying an inline success text.
 */

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('feedbackForm');
  const submitBtn = document.getElementById('submitBtn');
  const successMessage = document.getElementById('successMessage');
  const starBtns = document.querySelectorAll('.star-btn');
  const ratingInput = document.getElementById('ratingValue');
  const ratingError = document.getElementById('ratingError');
  const starWidget = document.getElementById('starRatingWidget');

  let currentRating = 0;

  // Render stars up to the given threshold (0-5)
  function renderStars(hoverThreshold = 0, activeThreshold = currentRating) {
    starBtns.forEach((btn, index) => {
      const starValue = index + 1;
      
      // Clear states
      btn.classList.remove('hovered', 'active');
      btn.setAttribute('aria-checked', 'false');

      // Update hover visual
      if (starValue <= hoverThreshold) {
        btn.classList.add('hovered');
      }

      // Update active visual
      if (starValue <= activeThreshold) {
        btn.classList.add('active');
        if (starValue === activeThreshold) {
          btn.setAttribute('aria-checked', 'true');
        }
      }
    });
  }

  // Bind Star Rating Handlers
  starBtns.forEach((btn, index) => {
    const starValue = index + 1;
    
    // Mouse Enter
    btn.addEventListener('mouseenter', () => {
      renderStars(starValue, currentRating);
    });

    // Click Selection
    btn.addEventListener('click', () => {
      currentRating = starValue;
      ratingInput.value = currentRating;
      ratingError.style.display = 'none'; // Hide error if user clicked valid rating
      renderStars(0, currentRating);
    });
  });

  // Mouse leave container restores standard active views
  if (starWidget) {
    starWidget.addEventListener('mouseleave', () => {
      renderStars(0, currentRating);
    });
  }

  // Form Submission
  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Basic validation constraint for Star Widget
      if (ratingInput.value === '0') {
        ratingError.style.display = 'block';
        return;
      }

      // UX: Disable submit to prevent rapid duplicate clicks
      submitBtn.disabled = true;
      submitBtn.textContent = 'Submitting...';

      // Simulate backend routing wait time
      setTimeout(() => {
        // Render success UI display
        successMessage.classList.add('show');
        
        // Reset form controls safely
        form.reset();
        
        // Reset interactive widget custom states
        currentRating = 0;
        ratingInput.value = 0;
        renderStars(0, 0);

        // Reset submit action state
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Feedback';
      }, 700);
    });
  }
});
