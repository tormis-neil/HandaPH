'use strict';

/* HandaPH — checklist.js (Day 3 server-side version)
   Handles step navigation and updates hidden form inputs.
   The form is submitted normally; PHP handles rule filtering. */

const userSelections = {
  location: null,
  household_size: null,
  special_needs: [],
  house_type: null,
};

const steps = {
  1: document.getElementById('step1'),
  2: document.getElementById('step2'),
  3: document.getElementById('step3'),
  4: document.getElementById('step4'),
};

const progressBar     = document.getElementById('progressBar');
const progressLabel   = document.getElementById('progressLabel');
const progressPct     = document.getElementById('progressPct');

const inputLocation   = document.getElementById('input-location');
const inputSize       = document.getElementById('input-household-size');
const inputHouseType  = document.getElementById('input-house-type');
const needsContainer  = document.getElementById('input-special-needs-container');

let currentStep = 1;

function showStep(stepNumber) {
  Object.keys(steps).forEach(function (key) {
    const el = steps[key];
    if (parseInt(key) === stepNumber) {
      el.removeAttribute('hidden');
    } else {
      el.setAttribute('hidden', '');
    }
  });
  currentStep = stepNumber;
  updateProgress(stepNumber);
  document.querySelector('.questionnaire-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function updateProgress(stepNumber) {
  const pct = stepNumber * 25;
  progressBar.style.width = pct + '%';
  progressBar.setAttribute('aria-valuenow', pct);
  progressLabel.textContent = 'Question ' + stepNumber + ' of 4';
  progressPct.textContent = pct + '%';
}

function syncSpecialNeedsInputs() {
  needsContainer.innerHTML = '';
  userSelections.special_needs.forEach(function (value) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'special_needs[]';
    input.value = value;
    needsContainer.appendChild(input);
  });
}

function handleSingleSelect(btn) {
  const step = parseInt(btn.getAttribute('data-step'));
  const value = btn.getAttribute('data-value');

  document.querySelectorAll('.option-btn[data-step="' + step + '"]').forEach(function (sib) {
    sib.classList.remove('selected');
    sib.setAttribute('aria-pressed', 'false');
  });

  btn.classList.add('selected');
  btn.setAttribute('aria-pressed', 'true');

  if (step === 1) { userSelections.location = value;       inputLocation.value = value; }
  if (step === 2) { userSelections.household_size = value; inputSize.value = value; }
  if (step === 4) { userSelections.house_type = value;     inputHouseType.value = value; }

  enableNextButton(step);
}

function handleMultiSelect(btn) {
  const value = btn.getAttribute('data-value');
  const pressed = btn.getAttribute('aria-pressed') === 'true';

  if (pressed) {
    btn.classList.remove('selected');
    btn.setAttribute('aria-pressed', 'false');
    userSelections.special_needs = userSelections.special_needs.filter(function (v) { return v !== value; });
  } else {
    btn.classList.add('selected');
    btn.setAttribute('aria-pressed', 'true');
    userSelections.special_needs.push(value);
  }
  syncSpecialNeedsInputs();
}

function enableNextButton(step) {
  const map = { 1: 'step1Next', 2: 'step2Next', 4: 'generateBtn' };
  const el = document.getElementById(map[step]);
  if (el) el.disabled = false;
}

document.querySelectorAll('.option-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    if (btn.classList.contains('option-btn--multi')) {
      handleMultiSelect(btn);
    } else {
      handleSingleSelect(btn);
    }
  });
});

document.querySelectorAll('.step-next-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    showStep(currentStep + 1);
  });
});

document.querySelectorAll('.step-back-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    showStep(parseInt(btn.getAttribute('data-target')));
  });
});

showStep(1);