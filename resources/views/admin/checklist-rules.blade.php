@extends('layouts.admin')

@section('title', 'HandaPH — Checklist Rules')
@section('topbar_title', 'Checklist Rules')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Checklist Rules</h1>
    <p class="page-subtext">Manage dynamic preparedness items triggered by the rule engine.</p>
  </div>
  <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addItemModal">
    <i class="fa-solid fa-plus me-1"></i> Add Rule
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="stat-row">
  <div class="stat-card">
    <div class="stat-value text-primary">{{ $rules->count() }}</div>
    <div class="stat-label">Total Rules</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-success">{{ $rules->where('is_active', true)->count() }}</div>
    <div class="stat-label">Active Rules</div>
  </div>
</div>

<div class="admin-table-wrapper mb-5">
  <table class="table admin-table mb-0" aria-label="CMS Items Registry">
    <thead>
      <tr>
        <th scope="col" style="width: 40%">Item Text</th>
        <th scope="col">Phase & Tag</th>
        <th scope="col">Status</th>
        <th scope="col" class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($rules as $rule)
        <tr>
          <td>{{ $rule->item_text }}</td>
          <td>
            <span class="badge bg-secondary">{{ ucfirst($rule->phase) }}</span>
            <span class="badge bg-light text-dark border">{{ $rule->tag }}</span>
          </td>
          <td>
            @if($rule->is_active)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-danger">Inactive</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-table-action btn-edit me-1" 
              data-bs-toggle="modal" 
              data-bs-target="#editItemModal"
              data-id="{{ $rule->id }}"
              data-item="{{ $rule->item_text }}"
              data-phase="{{ $rule->phase }}"
              data-tag="{{ $rule->tag }}"
              data-tagclass="{{ $rule->tag_class }}"
              data-active="{{ $rule->is_active ? 1 : 0 }}"
              data-locations="{{ json_encode($rule->locations) }}"
              data-sizes="{{ json_encode($rule->sizes) }}"
              data-needs="{{ json_encode($rule->special_needs) }}"
              data-house="{{ json_encode($rule->house_types) }}">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </button>
            <button class="btn-table-action btn-delete" 
              data-bs-toggle="modal" 
              data-bs-target="#deleteItemModal"
              data-id="{{ $rule->id }}"
              data-text="{{ str($rule->item_text)->limit(60) }}">
              <i class="fa-solid fa-trash-can"></i> Del
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
            <div class="table-empty-state py-4">
              <i class="fa-solid fa-inbox text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Checklist Rules Found</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="addItemModalLabel">Add Checklist Rule</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.checklist-rules.store') }}" method="POST">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Item Text</label>
            <textarea name="item_text" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Phase</label>
              <select name="phase" class="form-select form-select-sm text-muted" required>
                <option value="before">Before</option>
                <option value="during">During</option>
                <option value="after">After</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Tag (Display Name)</label>
              <input type="text" name="tag" class="form-control form-control-sm" placeholder="e.g. Food & Water" required>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Tag Class (CSS)</label>
              <input type="text" name="tag_class" class="form-control form-control-sm" placeholder="e.g. tag-water" required>
            </div>
          </div>
          <hr>
          <p class="small text-muted mb-2">Leave checkboxes empty if the rule applies to ALL users.</p>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Locations</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['coastal', 'mountainous', 'inland', 'flood-prone'] as $loc)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="locations[]" value="{{ $loc }}" id="add_loc_{{ $loc }}">
                    <label class="form-check-label small" for="add_loc_{{ $loc }}">{{ ucfirst($loc) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Household Sizes</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['1', '2-4', '5-7', '8-plus'] as $sz)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="sizes[]" value="{{ $sz }}" id="add_sz_{{ $sz }}">
                    <label class="form-check-label small" for="add_sz_{{ $sz }}">{{ $sz }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Special Needs</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['children', 'seniors', 'pwd', 'pets'] as $nd)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="special_needs[]" value="{{ $nd }}" id="add_nd_{{ $nd }}">
                    <label class="form-check-label small" for="add_nd_{{ $nd }}">{{ ucfirst($nd) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">House Types</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['light', 'semi-concrete', 'concrete'] as $ht)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="house_types[]" value="{{ $ht }}" id="add_ht_{{ $ht }}">
                    <label class="form-check-label small" for="add_ht_{{ $ht }}">{{ ucfirst($ht) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <hr>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="add_active" checked value="1">
            <label class="form-check-label fw-bold text-muted small" for="add_active">Is Active (Show to public)</label>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3">
          <button type="button" class="btn btn-outline-secondary fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary fw-medium px-4">Save Rule</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="editItemModalLabel">Edit Checklist Rule</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Item Text</label>
            <textarea name="item_text" id="edit_item_text" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Phase</label>
              <select name="phase" id="edit_phase" class="form-select form-select-sm text-muted" required>
                <option value="before">Before</option>
                <option value="during">During</option>
                <option value="after">After</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Tag (Display Name)</label>
              <input type="text" name="tag" id="edit_tag" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-bold text-muted small">Tag Class (CSS)</label>
              <input type="text" name="tag_class" id="edit_tag_class" class="form-control form-control-sm" required>
            </div>
          </div>
          <hr>
          <p class="small text-muted mb-2">Leave checkboxes empty if the rule applies to ALL users.</p>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Locations</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['coastal', 'mountainous', 'inland', 'flood-prone'] as $loc)
                  <div class="form-check">
                    <input class="form-check-input edit-locations" type="checkbox" name="locations[]" value="{{ $loc }}" id="edit_loc_{{ $loc }}">
                    <label class="form-check-label small" for="edit_loc_{{ $loc }}">{{ ucfirst($loc) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Household Sizes</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['1', '2-4', '5-7', '8-plus'] as $sz)
                  <div class="form-check">
                    <input class="form-check-input edit-sizes" type="checkbox" name="sizes[]" value="{{ $sz }}" id="edit_sz_{{ $sz }}">
                    <label class="form-check-label small" for="edit_sz_{{ $sz }}">{{ $sz }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">Special Needs</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['children', 'seniors', 'pwd', 'pets'] as $nd)
                  <div class="form-check">
                    <input class="form-check-input edit-needs" type="checkbox" name="special_needs[]" value="{{ $nd }}" id="edit_nd_{{ $nd }}">
                    <label class="form-check-label small" for="edit_nd_{{ $nd }}">{{ ucfirst($nd) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-muted small">House Types</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach(['light', 'semi-concrete', 'concrete'] as $ht)
                  <div class="form-check">
                    <input class="form-check-input edit-house" type="checkbox" name="house_types[]" value="{{ $ht }}" id="edit_ht_{{ $ht }}">
                    <label class="form-check-label small" for="edit_ht_{{ $ht }}">{{ ucfirst($ht) }}</label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <hr>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="edit_active" value="1">
            <label class="form-check-label fw-bold text-muted small" for="edit_active">Is Active (Show to public)</label>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3">
          <button type="button" class="btn btn-outline-secondary fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary fw-medium px-4">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pt-4 px-4 pb-0">
        <h2 class="h6 fw-bold mb-0 text-danger" id="deleteItemModalLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delete Rule</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body px-4 py-3">
          <p class="small text-muted mb-0">Are you sure you want to delete <strong id="deleteItemPreview">this rule</strong>? This cannot be undone.</p>
        </div>
        <div class="modal-footer border-0 px-4 pb-4 pt-2">
          <button type="button" class="btn btn-outline-secondary btn-sm fw-medium" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger btn-sm fw-semibold px-4">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editItemModal');
    if (editModal) {
      editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        
        document.getElementById('editForm').action = `/admin/checklist-rules/${button.dataset.id}`;
        document.getElementById('edit_item_text').value = button.dataset.item;
        document.getElementById('edit_phase').value = button.dataset.phase;
        document.getElementById('edit_tag').value = button.dataset.tag;
        document.getElementById('edit_tag_class').value = button.dataset.tagclass;
        document.getElementById('edit_active').checked = button.dataset.active == '1';

        // Reset all checkboxes first
        document.querySelectorAll('.edit-locations, .edit-sizes, .edit-needs, .edit-house').forEach(cb => cb.checked = false);

        // Check the ones that apply
        let locations = JSON.parse(button.dataset.locations || '[]');
        if (locations) locations.forEach(val => { let cb = document.getElementById('edit_loc_' + val); if (cb) cb.checked = true; });
        
        let sizes = JSON.parse(button.dataset.sizes || '[]');
        if (sizes) sizes.forEach(val => { let cb = document.getElementById('edit_sz_' + val); if (cb) cb.checked = true; });
        
        let needs = JSON.parse(button.dataset.needs || '[]');
        if (needs) needs.forEach(val => { let cb = document.getElementById('edit_nd_' + val); if (cb) cb.checked = true; });
        
        let house = JSON.parse(button.dataset.house || '[]');
        if (house) house.forEach(val => { let cb = document.getElementById('edit_ht_' + val); if (cb) cb.checked = true; });
      });
    }

    const deleteModal = document.getElementById('deleteItemModal');
    if (deleteModal) {
      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('deleteForm').action = `/admin/checklist-rules/${button.dataset.id}`;
        document.getElementById('deleteItemPreview').textContent = button.dataset.text;
      });
    }
  });
</script>
@endpush
