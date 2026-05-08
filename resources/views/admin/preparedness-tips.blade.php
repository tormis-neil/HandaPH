@extends('layouts.admin')

@section('title', 'HandaPH — Manage Preparedness Tips')
@section('topbar_title', 'Tips Content')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Preparedness Tips</h1>
    <p class="page-subtext">Control the logic-linked tips showing up in Before, During, and After results.</p>
  </div>
  <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addTipModal">
    <i class="fa-solid fa-plus me-1"></i> Add Tip
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
    <div class="stat-value text-primary">{{ $tips->where('is_active', true)->count() }}</div>
    <div class="stat-label">Total Live Tips</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-secondary">{{ $tips->count() }}</div>
    <div class="stat-label">Total Tip Records</div>
  </div>
</div>

<div class="admin-table-wrapper mb-5">
  <table class="table admin-table mb-0" aria-label="CMS Preparedness Tips">
    <thead>
      <tr>
        <th scope="col" style="width: 15%">Logic ID</th>
        <th scope="col" style="width: 45%">Tip Title</th>
        <th scope="col">Timeline Tag</th>
        <th scope="col">Status</th>
        <th scope="col" class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tips as $tip)
        <tr>
          <td class="text-muted fw-bold">{{ $tip->logic_id }}</td>
          <td>{{ $tip->title }}</td>
          <td>
            @if($tip->tag === 'before')
              <span class="tag-pill tag-before px-3 py-1">Before</span>
            @elseif($tip->tag === 'during')
              <span class="tag-pill tag-during px-3 py-1">During</span>
            @elseif($tip->tag === 'after')
              <span class="tag-pill tag-after px-3 py-1">After</span>
            @endif
          </td>
          <td>
            @if($tip->is_active)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-danger">Inactive</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-table-action btn-edit me-1" 
              data-bs-toggle="modal" 
              data-bs-target="#editTipModal"
              data-id="{{ $tip->id }}"
              data-logic="{{ $tip->logic_id }}"
              data-title="{{ $tip->title }}"
              data-content="{{ $tip->content }}"
              data-tag="{{ $tip->tag }}"
              data-active="{{ $tip->is_active ? 1 : 0 }}">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </button>
            <button class="btn-table-action btn-delete" 
              data-bs-toggle="modal" 
              data-bs-target="#deleteTipModal"
              data-id="{{ $tip->id }}"
              data-title="{{ str($tip->title)->limit(60) }}">
              <i class="fa-solid fa-trash-can"></i> Del
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">
            <div class="table-empty-state py-4">
              <i class="fa-solid fa-lightbulb text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Preparedness Tips Found</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addTipModal" tabindex="-1" aria-labelledby="addTipModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="addTipModalLabel">Add Preparedness Tip</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close form"></button>
      </div>
      <form action="{{ route('admin.tips.store') }}" method="POST">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="row g-2 mb-3">
            <div class="col-8 col-sm-9">
              <label class="form-label fw-bold text-muted small">Tip Title</label>
              <input type="text" name="title" class="form-control form-control-sm" placeholder="E.g., Turn off your main breaker..." required>
            </div>
            <div class="col-4 col-sm-3">
              <label class="form-label fw-bold text-muted small">Logic ID</label>
              <input type="text" name="logic_id" class="form-control form-control-sm" placeholder="TIP-101" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Timeline Logic Tag</label>
            <select name="tag" class="form-select form-select-sm text-muted fw-medium" required>
              <option value="" selected disabled>Select rendering phase</option>
              <option value="before" class="text-primary">Before</option>
              <option value="during" class="text-warning text-dark">During</option>
              <option value="after" class="text-success">After</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Tip Detail Content</label>
            <textarea name="content" class="form-control form-control-sm" rows="3" placeholder="Provide context and instructions regarding the tip..." required></textarea>
          </div>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="add_tip_active" checked value="1">
            <label class="form-check-label fw-bold text-muted small" for="add_tip_active">Is Active</label>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3">
          <button type="button" class="btn btn-outline-secondary fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary fw-medium px-4">Publish Tip</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editTipModal" tabindex="-1" aria-labelledby="editTipModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="editTipModalLabel">Edit Preparedness Tip</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body px-4 py-3">
          <div class="row g-2 mb-3">
            <div class="col-8 col-sm-9">
              <label class="form-label fw-bold text-muted small">Tip Title</label>
              <input type="text" name="title" id="edit_title" class="form-control form-control-sm" required>
            </div>
            <div class="col-4 col-sm-3">
              <label class="form-label fw-bold text-muted small">Logic ID</label>
              <input type="text" name="logic_id" id="edit_logic_id" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Timeline Logic Tag</label>
            <select name="tag" id="edit_tag" class="form-select form-select-sm text-muted fw-medium" required>
              <option value="before" class="text-primary">Before</option>
              <option value="during" class="text-warning text-dark">During</option>
              <option value="after" class="text-success">After</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Tip Detail Content</label>
            <textarea name="content" id="edit_content" class="form-control form-control-sm" rows="3" required></textarea>
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
<div class="modal fade" id="deleteTipModal" tabindex="-1" aria-labelledby="deleteTipModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pt-4 px-4 pb-0">
        <h2 class="h6 fw-bold mb-0 text-danger" id="deleteTipModalLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delete Tip</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body px-4 py-3">
          <p class="small text-muted mb-0">Are you sure you want to delete <strong id="deleteTipPreview">this tip</strong>? This cannot be undone.</p>
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
    const editModal = document.getElementById('editTipModal');
    if (editModal) {
      editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        
        document.getElementById('editForm').action = `/admin/tips/${button.dataset.id}`;
        document.getElementById('edit_logic_id').value = button.dataset.logic;
        document.getElementById('edit_title').value = button.dataset.title;
        document.getElementById('edit_content').value = button.dataset.content;
        document.getElementById('edit_tag').value = button.dataset.tag;
        document.getElementById('edit_active').checked = button.dataset.active == '1';
      });
    }

    const deleteModal = document.getElementById('deleteTipModal');
    if (deleteModal) {
      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('deleteForm').action = `/admin/tips/${button.dataset.id}`;
        document.getElementById('deleteTipPreview').textContent = button.dataset.title;
      });
    }
  });
</script>
@endpush
