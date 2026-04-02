'use strict';

/**
 * Admin Dashboard Charts Integration
 * Built using Chart.js to map incoming queries and metric feedback.
 * Currently uses placeholder data awaiting PHP/MySQL integration.
 */

document.addEventListener('DOMContentLoaded', () => {
  // Chart.js default brand token mappings based on style.css
  const colorPrimary = '#1E293B';    // Slate Navy
  const colorSecondary = '#EA580C';  // Safety Orange
  const colorMuted = '#64748B';      // Muted label
  const colorDanger = '#DC2626';     // Emergency label red
  const colorSuccess = '#16A34A';    // Success green tint

  // Chart defaults for aesthetic spacing and modern styling
  Chart.defaults.font.family = "'Inter', 'Roboto', sans-serif";
  Chart.defaults.color = colorMuted;
  Chart.defaults.plugins.tooltip.padding = 10;
  Chart.defaults.plugins.tooltip.cornerRadius = 8;
  
  // -------------------------------------------------------------
  // 1. Location Type (Area / Line Chart)
  // -------------------------------------------------------------
  const ctxLocation = document.getElementById('locationChart');
  if (ctxLocation) {
    new Chart(ctxLocation, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Coastal',
          data: [120, 190, 300, 350, 420, 480],
          borderColor: colorSecondary,
          backgroundColor: 'rgba(234, 88, 12, 0.1)',
          fill: true,
          tension: 0.4,
          borderWidth: 2
        },
        {
          label: 'Flood-Prone',
          data: [200, 250, 320, 410, 500, 580],
          borderColor: colorPrimary,
          backgroundColor: 'rgba(30, 41, 59, 0.1)',
          fill: true,
          tension: 0.4,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  // -------------------------------------------------------------
  // 2. Household Size (Donut Chart)
  // -------------------------------------------------------------
  const ctxHousehold = document.getElementById('householdSizeChart');
  if (ctxHousehold) {
    new Chart(ctxHousehold, {
      type: 'doughnut',
      data: {
        labels: ['1 Person', '2-4 People', '5-7 People', '8 or more'],
        datasets: [{
          data: [15, 45, 30, 10],
          backgroundColor: [
            '#94A3B8',       // slate-400
            colorPrimary,    // Slate Navy
            colorSecondary,  // Safety Orange
            colorDanger      // Emergency Red
          ],
          borderWidth: 0,
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
          legend: { position: 'bottom', labels: { boxWidth: 12 } }
        }
      }
    });
  }

  // -------------------------------------------------------------
  // 3. Special Household Needs (Bar Chart)
  // -------------------------------------------------------------
  const ctxNeeds = document.getElementById('specialNeedsChart');
  if (ctxNeeds) {
    new Chart(ctxNeeds, {
      type: 'bar',
      data: {
        labels: ['Children', 'Seniors', 'PWDs', 'Pets'],
        datasets: [{
          label: 'Count',
          data: [450, 280, 110, 520],
          backgroundColor: [
            colorPrimary,
            '#3B82F6', // Blue
            colorSuccess,
            colorSecondary
          ],
          borderRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  // -------------------------------------------------------------
  // 4. House Type Distribution (Horizontal Bar Chart)
  // -------------------------------------------------------------
  const ctxHouseType = document.getElementById('houseTypeChart');
  if (ctxHouseType) {
    new Chart(ctxHouseType, {
      type: 'bar', // Horizontal bar in Chart.js v3+ uses 'indexAxis: y'
      data: {
        labels: ['Light Materials', 'Semi-Concrete', 'Concrete'],
        datasets: [{
          label: 'Submissions',
          data: [320, 540, 890],
          backgroundColor: colorPrimary,
          borderRadius: 4
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          x: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          y: { grid: { display: false } }
        }
      }
    });
  }
});
