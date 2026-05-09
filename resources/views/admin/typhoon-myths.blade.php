@extends('layouts.admin')

@section('title', 'HandaPH — Manage Typhoon Myths')
@section('topbar_title', 'Typhoon Myths')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Typhoon Myths</h1>
    <p class="page-subtext">Manage common misconceptions and correct them with facts.</p>
  </div>
  <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addMythModal">
    <i class="fa-solid fa-plus me-1"></i> Add Myth
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
    <div class="stat-value text-primary">{{ $myths->where('is_active', true)->count() }}</div>
    <div class="stat-label">Total Live Myths</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-secondary">{{ $myths->count() }}</div>
    <div class="stat-label">Total Myth Records</div>
  </div>
</div>

<div class="admin-table-wrapper mb-5">
  <table class="table admin-table mb-0" aria-label="CMS Typhoon Myths">
    <thead>
      <tr>
        <th scope="col" style="width: 35%">Myth</th>
        <th scope="col" style="width: 35%">Fact</th>
        <th scope="col">Status</th>
        <th scope="col" class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($myths as $myth)
        <tr>
          <td class="fw-bold">{{ str($myth->myth)->limit(50) }}</td>
          <td>{{ str($myth->fact)->limit(50) }}</td>
          <td>
            @if($myth->is_active)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-danger">Inactive</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-table-action btn-edit me-1" 
              data-bs-toggle="modal" 
              data-bs-target="#editMythModal"
              data-id="{{ $myth->id }}"
              data-myth="{{ $myth->myth }}"
              data-fact="{{ $myth->fact }}"
              data-action_text="{{ $myth->action }}"
              data-active="{{ $myth->is_active ? 1 : 0 }}">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </button>
            <button class="btn-table-action btn-delete" 
              data-bs-toggle="modal" 
              data-bs-target="#deleteMythModal"
              data-id="{{ $myth->id }}"
              data-myth="{{ str($myth->myth)->limit(60) }}">
              <i class="fa-solid fa-trash-can"></i> Del
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
            <div class="table-empty-state py-4">
              <i class="fa-solid fa-cloud-bolt text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Typhoon Myths Found</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addMythModal" tabindex="-1" aria-labelledby="addMythModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="addMythModalLabel">Add Typhoon Myth</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close form"></button>
      </div>
      <form action="{{ route('admin.typhoon-myths.store') }}" method="POST">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Myth</label>
            <textarea name="myth" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Fact</label>
            <textarea name="fact" class="form-control form-control-sm" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Action / What to do</label>
            <textarea name="action" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="add_myth_active" checked value="1">
            <label class="form-check-label fw-bold text-muted small" for="add_myth_active">Is Active</label>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3">
          <button type="button" class="btn btn-outline-secondary fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary fw-medium px-4">Save Myth</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editMythModal" tabindex="-1" aria-labelledby="editMythModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="editMythModalLabel">Edit Typhoon Myth</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Myth</label>
            <textarea name="myth" id="edit_myth" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Fact</label>
            <textarea name="fact" id="edit_fact" class="form-control form-control-sm" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Action / What to do</label>
            <textarea name="action" id="edit_action" class="form-control form-control-sm" rows="2" required></textarea>
          </div>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="edit_active" value="1">
            <label class="form-check-label fw-bold text-muted small" for="edit_active">Is Active</label>
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
<div class="modal fade" id="deleteMythModal" tabindex="-1" aria-labelledby="deleteMythModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pt-4 px-4 pb-0">
        <h2 class="h6 fw-bold mb-0 text-danger" id="deleteMythModalLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delete Myth</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body px-4 py-3">
          <p class="small text-muted mb-0">Are you sure you want to delete <strong id="deleteMythPreview">this myth</strong>? This cannot be undone.</p>
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
    const editModal = document.getElementById('editMythModal');
    if (editModal) {
      editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        
        document.getElementById('editForm').action = `/admin/typhoon-myths/${button.dataset.id}`;
        document.getElementById('edit_myth').value = button.dataset.myth;
        document.getElementById('edit_fact').value = button.dataset.fact;
        document.getElementById('edit_action').value = button.dataset.action_text;
        document.getElementById('edit_active').checked = button.dataset.active == '1';
      });
    }

    const deleteModal = document.getElementById('deleteMythModal');
    if (deleteModal) {
      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('deleteForm').action = `/admin/typhoon-myths/${button.dataset.id}`;
        document.getElementById('deleteMythPreview').textContent = button.dataset.myth;
      });
    }
  });
</script>
@endpush
