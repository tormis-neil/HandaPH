'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('feedbackForm');
  const starBtns = document.querySelectorAll('.star-btn');
  const ratingInput = document.getElementById('ratingValue');
  const ratingError = document.getElementById('ratingError');
  const starWidget = document.getElementById('starRatingWidget');

  let currentRating = 0;

  function renderStars(hoverThreshold = 0, activeThreshold = currentRating) {
    starBtns.forEach((btn, index) => {
      const starValue = index + 1;
      btn.classList.remove('hovered', 'active');
      btn.setAttribute('aria-checked', 'false');
      if (starValue <= hoverThreshold) btn.classList.add('hovered');
      if (starValue <= activeThreshold) {
        btn.classList.add('active');
        if (starValue === activeThreshold) btn.setAttribute('aria-checked', 'true');
      }
    });
  }

  starBtns.forEach((btn, index) => {
    const starValue = index + 1;
    btn.addEventListener('mouseenter', () => renderStars(starValue, currentRating));
    btn.addEventListener('click', () => {
      currentRating = starValue;
      ratingInput.value = currentRating;
      if (ratingError) ratingError.style.display = 'none';
      renderStars(0, currentRating);
    });
  });

  if (starWidget) {
    starWidget.addEventListener('mouseleave', () => renderStars(0, currentRating));
  }

  if (form) {
    form.addEventListener('submit', (e) => {
      if (ratingInput.value === '0') {
        e.preventDefault();
        if (ratingError) ratingError.style.display = 'block';
      }
    });
  }
});