'use strict';

/* =============================================================
   HandaPH — checklist.js
   Description: 4-step questionnaire logic and rule engine.
                Handles step navigation, user selections,
                and dynamic checklist rendering.
   ============================================================= */


/* =============================================================
   RULE DATA — checklist items mapped to user selections
   Structure per rule:
   {
     item:         string — the checklist action text
     phase:        string — "before" | "during" | "after"
     tag:          string — category label for the badge
     tagClass:     string — CSS class for the badge color
     locations:    array  — [] means applies to ALL locations
     sizes:        array  — [] means applies to ALL sizes
     specialNeeds: array  — [] means applies to ALL (no special need required)
     houseTypes:   array  — [] means applies to ALL house types
   }
   ============================================================= */
const checklistRules = [

  /* ---- BEFORE: Universal (all households) ---- */
  {
    item: "Store at least 3 liters of water per person per day for a minimum of 3 days",
    phase: "before", tag: "Water", tagClass: "tag-water",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Prepare a 3-day supply of non-perishable food (canned goods, instant noodles, biscuits)",
    phase: "before", tag: "Food", tagClass: "tag-food",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Assemble a basic first aid kit (bandages, antiseptic, pain relievers, gauze)",
    phase: "before", tag: "Medical", tagClass: "tag-medical",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Make waterproof copies of important documents (IDs, birth certificates, land titles, insurance)",
    phase: "before", tag: "Documents", tagClass: "tag-documents",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Prepare a working flashlight and extra batteries",
    phase: "before", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Keep a battery-powered or hand-crank radio to receive PAGASA and NDRRMC updates",
    phase: "before", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Pack at least 3 days of clothing, including rain gear and sturdy closed footwear",
    phase: "before", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Fully charge all mobile phones and power banks before the typhoon arrives",
    phase: "before", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Set aside emergency cash in small denominations inside a waterproof container",
    phase: "before", tag: "Documents", tagClass: "tag-documents",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Identify your nearest evacuation center and plan your evacuation route in advance",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Secure or bring inside loose outdoor items (furniture, flowerpots, signs) that can become flying debris",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Assign a family meeting point and designate an out-of-area contact person",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- BEFORE: Location-specific ---- */
  {
    item: "Prepare sandbags to block doorways and low-lying openings against rising floodwater",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: ["flood-prone", "coastal"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Know your storm surge risk zone — if in Zone 1 to 4, be ready to evacuate immediately when ordered",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: ["coastal"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Monitor river water levels and identify elevated ground or vertical evacuation points near your home",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: ["flood-prone"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Watch for landslide warning signs: ground cracks, unusual sounds, and tilting trees near slopes",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: ["mountainous"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Check and clear drainage canals and gutters around your property to reduce urban flooding risk",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: ["inland"], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- BEFORE: House type-specific ---- */
  {
    item: "Reinforce walls and roof with extra tie-down wires or rope before the typhoon arrives",
    phase: "before", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: ["light"]
  },
  {
    item: "Identify the strongest interior room in your house (away from windows) as your shelter spot",
    phase: "before", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: ["light", "semi-concrete"]
  },
  {
    item: "Plan to evacuate early — light-material homes face high risk of structural failure in strong typhoons",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: ["light"]
  },
  {
    item: "Reinforce windows and glass doors with masking tape or wooden boards to reduce shattering risk",
    phase: "before", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: ["semi-concrete", "concrete"]
  },

  /* ---- BEFORE: Household size-specific ---- */
  {
    item: "Calculate your total water and food needs: 3 liters per person per day, multiplied by 3 days minimum",
    phase: "before", tag: "Water", tagClass: "tag-water",
    locations: [], sizes: ["5-7", "8-plus"], specialNeeds: [], houseTypes: []
  },
  {
    item: "Coordinate evacuation transport for your large household — contact your barangay for vehicle assistance if needed",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: ["8-plus"], specialNeeds: [], houseTypes: []
  },

  /* ---- BEFORE: Special needs ---- */
  {
    item: "Prepare infant formula, diapers, baby wipes, and baby medicines for at least 3 days",
    phase: "before", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["children"], houseTypes: []
  },
  {
    item: "Pack small entertainment items for children (toys, coloring books) to reduce stress during shelter-in-place",
    phase: "before", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["children"], houseTypes: []
  },
  {
    item: "Prepare a written list of medications and dosages for senior family members with at least 7 days of supply",
    phase: "before", tag: "Medical", tagClass: "tag-medical",
    locations: [], sizes: [], specialNeeds: ["seniors"], houseTypes: []
  },
  {
    item: "Set up a buddy system — assign a household member to assist the senior during evacuation",
    phase: "before", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["seniors"], houseTypes: []
  },
  {
    item: "Ensure mobility aids (wheelchair, walker, crutches) are accessible and included in the Go-Bag area",
    phase: "before", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pwd"], houseTypes: []
  },
  {
    item: "Inform your barangay DRRM office about PWD household members to receive priority evacuation assistance",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: ["pwd"], houseTypes: []
  },
  {
    item: "Prepare a pet carrier or crate, leash, pet food, water bowl, and vaccination records",
    phase: "before", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pets"], houseTypes: []
  },
  {
    item: "Locate pet-friendly evacuation centers in your area — most public centers do not allow animals",
    phase: "before", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: ["pets"], houseTypes: []
  },

  /* ---- DURING: Universal ---- */
  {
    item: "Stay indoors and move away from windows, glass doors, and exterior walls",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Monitor PAGASA bulletins and LGU announcements continuously on your battery-powered radio",
    phase: "during", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Do NOT go outside during the eye of the typhoon — the most dangerous eyewall returns shortly after",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Use your flashlight instead of candles or open flames to eliminate fire risk",
    phase: "during", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Unplug all appliances and turn off the main circuit breaker if floodwater begins to enter",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Keep all windows and doors tightly shut and sealed throughout the entire storm",
    phase: "during", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Send text messages instead of calls to conserve battery power and reduce network congestion",
    phase: "during", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- DURING: Location-specific ---- */
  {
    item: "Move to the highest floor or rooftop immediately if floodwater rises rapidly — do not wait",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: ["flood-prone", "coastal"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Never attempt to cross flooded roads or rivers — fast-moving water can sweep away an adult",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: ["flood-prone", "coastal", "inland"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Evacuate immediately upon hearing rumbling sounds, cracking, or unusual noises near slopes",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: ["mountainous"], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- DURING: House type-specific ---- */
  {
    item: "Evacuate immediately if your home shows structural stress — do not shelter in a light-material house during a strong typhoon",
    phase: "during", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: ["light"]
  },

  /* ---- DURING: Special needs ---- */
  {
    item: "Keep children calm with simple, reassuring explanations of what is happening around them",
    phase: "during", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["children"], houseTypes: []
  },
  {
    item: "Ensure senior family members take medications on schedule and monitor their condition throughout",
    phase: "during", tag: "Medical", tagClass: "tag-medical",
    locations: [], sizes: [], specialNeeds: ["seniors"], houseTypes: []
  },
  {
    item: "Keep PWD family members close and ensure immediate access to mobility aids at all times",
    phase: "during", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pwd"], houseTypes: []
  },
  {
    item: "Keep pets confined in their carrier or a secure interior room — frightened animals can become aggressive",
    phase: "during", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pets"], houseTypes: []
  },

  /* ---- AFTER: Universal ---- */
  {
    item: "Wait for the official all-clear from PAGASA and your LGU before going outside",
    phase: "after", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Do not drink tap water until authorities declare it safe — use your stored or bottled water",
    phase: "after", tag: "Water", tagClass: "tag-water",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Inspect your home for structural damage before re-entering — check walls, roof, and foundation",
    phase: "after", tag: "Shelter", tagClass: "tag-shelter",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Document all property damage with photos and video for insurance claims or government assistance",
    phase: "after", tag: "Documents", tagClass: "tag-documents",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Discard any food that came in contact with floodwater — it is unsafe to consume",
    phase: "after", tag: "Food", tagClass: "tag-food",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Assume all downed electrical wires are live — stay away and report to your electric cooperative",
    phase: "after", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Report injuries, missing persons, and road blockages to your barangay or NDRRMC hotline 911",
    phase: "after", tag: "Safety", tagClass: "tag-safety",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Sanitize all surfaces, containers, and utensils that may have been exposed to floodwater",
    phase: "after", tag: "Medical", tagClass: "tag-medical",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Replenish all Go-Bag supplies used during the typhoon: water, food, batteries, and medicines",
    phase: "after", tag: "Tools", tagClass: "tag-tools",
    locations: [], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- AFTER: Location-specific ---- */
  {
    item: "Do not return to flood-prone or coastal areas until water has fully receded and LGU declares it safe",
    phase: "after", tag: "Safety", tagClass: "tag-safety",
    locations: ["flood-prone", "coastal"], sizes: [], specialNeeds: [], houseTypes: []
  },
  {
    item: "Watch for post-typhoon landslide warnings — rainfall during cleanup can trigger secondary landslides",
    phase: "after", tag: "Safety", tagClass: "tag-safety",
    locations: ["mountainous"], sizes: [], specialNeeds: [], houseTypes: []
  },

  /* ---- AFTER: Special needs ---- */
  {
    item: "Watch for signs of typhoon trauma or emotional distress in children — seek psychosocial support if needed",
    phase: "after", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["children"], houseTypes: []
  },
  {
    item: "Monitor senior family members for post-typhoon illness, dehydration, or emotional stress",
    phase: "after", tag: "Medical", tagClass: "tag-medical",
    locations: [], sizes: [], specialNeeds: ["seniors"], houseTypes: []
  },
  {
    item: "Coordinate with barangay health workers or social workers for PWD recovery and rehabilitation support",
    phase: "after", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pwd"], houseTypes: []
  },
  {
    item: "Check pets for injuries, dehydration, or stress after the typhoon — visit a vet if needed",
    phase: "after", tag: "Special", tagClass: "tag-special",
    locations: [], sizes: [], specialNeeds: ["pets"], houseTypes: []
  }

];


/* =============================================================
   USER SELECTIONS — stores answers from all 4 steps
   ============================================================= */
const userSelections = {
  location:     null,
  size:         null,
  specialNeeds: [],
  houseType:    null
};


/* =============================================================
   DOM REFERENCES — cached once, reused throughout
   ============================================================= */
const steps = {
  1: document.getElementById('step1'),
  2: document.getElementById('step2'),
  3: document.getElementById('step3'),
  4: document.getElementById('step4')
};

const progressBar     = document.getElementById('progressBar');
const progressLabel   = document.getElementById('progressLabel');
const progressPct     = document.getElementById('progressPct');
const progressWrapper = document.getElementById('progressWrapper');

const resultsSection  = document.getElementById('resultsSection');
const resultsSummary  = document.getElementById('resultsSummary');

const listBefore = document.getElementById('list-before');
const listDuring = document.getElementById('list-during');
const listAfter  = document.getElementById('list-after');

const generateBtn  = document.getElementById('generateBtn');
const startOverBtn = document.getElementById('startOverBtn');
const downloadBtn  = document.getElementById('downloadBtn');

let currentStep = 1;


/* =============================================================
   STEP NAVIGATION
   ============================================================= */
function showStep(stepNumber) {
  Object.keys(steps).forEach(function (key) {
    const el = steps[key];
    if (parseInt(key) === stepNumber) {
      el.removeAttribute('hidden');
      el.setAttribute('aria-hidden', 'false');
    } else {
      el.setAttribute('hidden', '');
      el.setAttribute('aria-hidden', 'true');
    }
  });

  currentStep = stepNumber;
  updateProgress(stepNumber);

  const questSection = document.querySelector('.questionnaire-section');
  if (questSection) {
    questSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

function updateProgress(stepNumber) {
  const pct = stepNumber * 25;
  progressBar.style.width = pct + '%';
  progressBar.setAttribute('aria-valuenow', pct);
  progressLabel.textContent = 'Question ' + stepNumber + ' of 4';
  progressPct.textContent   = pct + '%';
}


/* =============================================================
   OPTION BUTTON SELECTION
   ============================================================= */
function handleSingleSelect(btn) {
  const step  = parseInt(btn.getAttribute('data-step'));
  const value = btn.getAttribute('data-value');

  document.querySelectorAll('.option-btn[data-step="' + step + '"]').forEach(function (sib) {
    sib.classList.remove('selected');
    sib.setAttribute('aria-pressed', 'false');
  });

  btn.classList.add('selected');
  btn.setAttribute('aria-pressed', 'true');

  if (step === 1) userSelections.location  = value;
  if (step === 2) userSelections.size      = value;
  if (step === 4) userSelections.houseType = value;

  enableNextButton(step);
}

function handleMultiSelect(btn) {
  const value   = btn.getAttribute('data-value');
  const pressed = btn.getAttribute('aria-pressed') === 'true';

  if (pressed) {
    btn.classList.remove('selected');
    btn.setAttribute('aria-pressed', 'false');
    userSelections.specialNeeds = userSelections.specialNeeds.filter(function (v) {
      return v !== value;
    });
  } else {
    btn.classList.add('selected');
    btn.setAttribute('aria-pressed', 'true');
    userSelections.specialNeeds.push(value);
  }
}

function enableNextButton(step) {
  const map = { 1: 'step1Next', 2: 'step2Next', 4: 'generateBtn' };
  const el  = document.getElementById(map[step]);
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


/* =============================================================
   RULE ENGINE
   ============================================================= */
function matchesRule(rule) {
  const locMatch = rule.locations.length === 0 ||
                   rule.locations.includes(userSelections.location);

  const sizeMatch = rule.sizes.length === 0 ||
                    rule.sizes.includes(userSelections.size);

  const needsMatch = rule.specialNeeds.length === 0 ||
                     rule.specialNeeds.some(function (need) {
                       return userSelections.specialNeeds.includes(need);
                     });

  const houseMatch = rule.houseTypes.length === 0 ||
                     rule.houseTypes.includes(userSelections.houseType);

  return locMatch && sizeMatch && needsMatch && houseMatch;
}

function generateChecklistItems() {
  const filtered = checklistRules.filter(matchesRule);
  return {
    before: filtered.filter(function (r) { return r.phase === 'before'; }),
    during: filtered.filter(function (r) { return r.phase === 'during'; }),
    after:  filtered.filter(function (r) { return r.phase === 'after';  })
  };
}


/* =============================================================
   RENDER
   ============================================================= */
function buildItemHTML(rule) {
  return '<li class="checklist-item" role="checkbox" aria-checked="false" tabindex="0">' +
           '<span class="checklist-item-check" aria-hidden="true">' +
             '<i class="fa-solid fa-check"></i>' +
           '</span>' +
           '<span class="checklist-item-text">' + escapeHTML(rule.item) + '</span>' +
           '<span class="checklist-item-tag ' + rule.tagClass + '">' + escapeHTML(rule.tag) + '</span>' +
         '</li>';
}

function renderPanel(listEl, items) {
  if (items.length === 0) {
    listEl.innerHTML =
      '<li class="checklist-empty">' +
        '<i class="fa-solid fa-circle-check" aria-hidden="true"></i>' +
        '<p>No specific items for this phase based on your selections.</p>' +
      '</li>';
    return;
  }

  listEl.innerHTML = items.map(buildItemHTML).join('');

  listEl.querySelectorAll('.checklist-item').forEach(function (item) {
    item.addEventListener('click', toggleChecklistItem);
    item.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleChecklistItem.call(item);
      }
    });
  });
}

function toggleChecklistItem() {
  const isChecked = this.classList.toggle('checked');
  this.setAttribute('aria-checked', isChecked.toString());
}

function renderResults(grouped) {
  renderPanel(listBefore, grouped.before);
  renderPanel(listDuring, grouped.during);
  renderPanel(listAfter,  grouped.after);
}


/* =============================================================
   SUMMARY PILLS
   ============================================================= */
function renderSummary() {
  const locationLabels = {
    'coastal':     'Coastal Area',
    'mountainous': 'Mountainous Area',
    'inland':      'Inland / Urban Area',
    'flood-prone': 'Flood-Prone Area'
  };
  const sizeLabels = {
    '1':      '1 Person',
    '2-4':    '2–4 People',
    '5-7':    '5–7 People',
    '8-plus': '8+ People'
  };
  const needsLabels = {
    'children': 'Children',
    'seniors':  'Senior Citizens',
    'pwd':      'PWDs',
    'pets':     'Pets'
  };
  const houseLabels = {
    'light':         'Light Materials',
    'semi-concrete': 'Semi-Concrete',
    'concrete':      'Concrete'
  };

  const pills = [];

  if (userSelections.location) {
    pills.push(pill('fa-map-marker-alt', locationLabels[userSelections.location]));
  }
  if (userSelections.size) {
    pills.push(pill('fa-users', sizeLabels[userSelections.size]));
  }
  if (userSelections.specialNeeds.length > 0) {
    userSelections.specialNeeds.forEach(function (need) {
      pills.push(pill('fa-heart', needsLabels[need]));
    });
  } else {
    pills.push(pill('fa-heart', 'No special needs selected'));
  }
  if (userSelections.houseType) {
    pills.push(pill('fa-house', houseLabels[userSelections.houseType]));
  }

  resultsSummary.innerHTML = pills.join('');
}

function pill(icon, label) {
  return '<span class="summary-pill">' +
           '<i class="fa-solid ' + icon + '" aria-hidden="true"></i>' +
           escapeHTML(label) +
         '</span>';
}


/* =============================================================
   GENERATE / START OVER / DOWNLOAD
   ============================================================= */
generateBtn.addEventListener('click', function () {
  document.querySelector('.questionnaire-section').setAttribute('hidden', '');
  progressWrapper.setAttribute('hidden', '');

  resultsSection.removeAttribute('hidden');
  resultsSection.setAttribute('aria-hidden', 'false');

  const grouped = generateChecklistItems();
  renderSummary();
  renderResults(grouped);

  resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

startOverBtn.addEventListener('click', function () {
  userSelections.location     = null;
  userSelections.size         = null;
  userSelections.specialNeeds = [];
  userSelections.houseType    = null;

  document.querySelectorAll('.option-btn').forEach(function (btn) {
    btn.classList.remove('selected');
    btn.setAttribute('aria-pressed', 'false');
  });

  ['step1Next', 'step2Next', 'generateBtn'].forEach(function (id) {
    const el = document.getElementById(id);
    if (el) el.disabled = true;
  });

  document.querySelector('.questionnaire-section').removeAttribute('hidden');
  progressWrapper.removeAttribute('hidden');
  resultsSection.setAttribute('hidden', '');

  showStep(1);
});

downloadBtn.addEventListener('click', function () {
  window.print();
});


/* =============================================================
   UTILITY — safe string escaping
   ============================================================= */
function escapeHTML(str) {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}


/* =============================================================
   INIT
   ============================================================= */
showStep(1);
