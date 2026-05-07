'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const colorPrimary   = '#1E293B';
  const colorSecondary = '#EA580C';
  const colorMuted     = '#64748B';
  const colorDanger    = '#DC2626';
  const colorSuccess   = '#16A34A';

  Chart.defaults.font.family = "'Inter', 'Roboto', sans-serif";
  Chart.defaults.color = colorMuted;
  Chart.defaults.plugins.tooltip.padding = 10;
  Chart.defaults.plugins.tooltip.cornerRadius = 8;

  const meta = document.querySelector('meta[name="analytics-url"]');
  if (!meta) return;
  const url = meta.getAttribute('content');

  fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
    .then((r) => {
      if (!r.ok) throw new Error('Analytics request failed: ' + r.status);
      return r.json();
    })
    .then((data) => {
      buildLocationChart(data.location);
      buildHouseholdSizeChart(data.household_size);
      buildSpecialNeedsChart(data.special_needs);
      buildHouseTypeChart(data.house_type);
    })
    .catch((err) => {
      console.error(err);
    });

  function buildLocationChart(d) {
    const ctx = document.getElementById('locationChart');
    if (!ctx) return;
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Coastal', 'Mountainous', 'Inland', 'Flood-Prone'],
        datasets: [{
          label: 'Submissions',
          data: [d['coastal'], d['mountainous'], d['inland'], d['flood-prone']],
          backgroundColor: [colorSecondary, colorPrimary, '#3B82F6', colorDanger],
          borderRadius: 4,
        }],
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          x: { grid: { display: false } },
        },
      },
    });
  }

  function buildHouseholdSizeChart(d) {
    const ctx = document.getElementById('householdSizeChart');
    if (!ctx) return;
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['1 Person', '2-4 People', '5-7 People', '8 or more'],
        datasets: [{
          data: [d['1'], d['2-4'], d['5-7'], d['8-plus']],
          backgroundColor: ['#94A3B8', colorPrimary, colorSecondary, colorDanger],
          borderWidth: 0,
          hoverOffset: 4,
        }],
      },
      options: {
        responsive: true, maintainAspectRatio: false, cutout: '70%',
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } },
      },
    });
  }

  function buildSpecialNeedsChart(d) {
    const ctx = document.getElementById('specialNeedsChart');
    if (!ctx) return;
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Children', 'Seniors', 'PWDs', 'Pets'],
        datasets: [{
          label: 'Count',
          data: [d['children'], d['seniors'], d['pwd'], d['pets']],
          backgroundColor: [colorPrimary, '#3B82F6', colorSuccess, colorSecondary],
          borderRadius: 4,
        }],
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          x: { grid: { display: false } },
        },
      },
    });
  }

  function buildHouseTypeChart(d) {
    const ctx = document.getElementById('houseTypeChart');
    if (!ctx) return;
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Light Materials', 'Semi-Concrete', 'Concrete'],
        datasets: [{
          label: 'Submissions',
          data: [d['light'], d['semi-concrete'], d['concrete']],
          backgroundColor: colorPrimary,
          borderRadius: 4,
        }],
      },
      options: {
        indexAxis: 'y',
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { beginAtZero: true, grid: { borderDash: [4, 4] } },
          y: { grid: { display: false } },
        },
      },
    });
  }
});