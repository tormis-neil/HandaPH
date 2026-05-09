@extends('layouts.admin')

@section('title', 'HandaPH — Manage Go-Bag')
@section('topbar_title', 'Go-Bag Content')

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Go-Bag Items</h1>
    <p class="page-subtext">Manage the recommended emergency supply items for 72-hour survival kits.</p>
  </div>
  <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addItemModal">
    <i class="fa-solid fa-plus me-1"></i> Add Item
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
    <div class="stat-value text-primary">{{ $items->where('is_active', true)->count() }}</div>
    <div class="stat-label">Total Live Items</div>
  </div>
  <div class="stat-card">
    <div class="stat-value text-secondary">{{ $items->count() }}</div>
    <div class="stat-label">Total Item Records</div>
  </div>
</div>

<div class="admin-table-wrapper mb-5">
  <table class="table admin-table mb-0" aria-label="CMS Go-Bag Items">
    <thead>
      <tr>
        <th scope="col" style="width: 25%">Item Name</th>
        <th scope="col" style="width: 20%">Category</th>
        <th scope="col">Status</th>
        <th scope="col" class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $item)
        <tr>
          <td class="fw-bold">{{ $item->name }}</td>
          <td><span class="badge bg-light text-dark border">{{ $item->category }}</span></td>
          <td>
            @if($item->is_active)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-danger">Inactive</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-table-action btn-edit me-1" 
              data-bs-toggle="modal" 
              data-bs-target="#editItemModal"
              data-id="{{ $item->id }}"
              data-category="{{ $item->category }}"
              data-name="{{ $item->name }}"
              data-description="{{ $item->description }}"
              data-budget="{{ $item->budget_alternative }}"
              data-active="{{ $item->is_active ? 1 : 0 }}">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </button>
            <button class="btn-table-action btn-delete" 
              data-bs-toggle="modal" 
              data-bs-target="#deleteItemModal"
              data-id="{{ $item->id }}"
              data-name="{{ str($item->name)->limit(60) }}">
              <i class="fa-solid fa-trash-can"></i> Del
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
            <div class="table-empty-state py-4">
              <i class="fa-solid fa-backpack text-muted fs-3 border-0"></i>
              <p class="mb-0 mt-2 fw-medium">No Go-Bag Items Found</p>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="addItemModalLabel">Add Go-Bag Item</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close form"></button>
      </div>
      <form action="{{ route('admin.go-bag-items.store') }}" method="POST">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Item Name</label>
            <input type="text" name="name" class="form-control form-control-sm" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Category</label>
            <select name="category" class="form-select form-select-sm text-muted fw-medium" required>
              <option value="" selected disabled>Select category</option>
              <option value="essentials">Essentials</option>
              <option value="recommended">Recommended</option>
              <option value="optional">Optional</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Description</label>
            <textarea name="description" class="form-control form-control-sm" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Budget Alternative (Optional)</label>
            <input type="text" name="budget_alternative" class="form-control form-control-sm">
          </div>
          <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="add_item_active" checked value="1">
            <label class="form-check-label fw-bold text-muted small" for="add_item_active">Is Active</label>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3">
          <button type="button" class="btn btn-outline-secondary fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary fw-medium px-4">Save Item</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg cms-form-panel p-0 mb-0">
      <div class="modal-header border-bottom px-4 pt-4 pb-3">
        <h2 class="h5 fw-bold text-primary mb-0" id="editItemModalLabel">Edit Go-Bag Item</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Item Name</label>
            <input type="text" name="name" id="edit_name" class="form-control form-control-sm" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Category</label>
            <select name="category" id="edit_category" class="form-select form-select-sm text-muted fw-medium" required>
              <option value="essentials">Essentials</option>
              <option value="recommended">Recommended</option>
              <option value="optional">Optional</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Description</label>
            <textarea name="description" id="edit_description" class="form-control form-control-sm" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-muted small">Budget Alternative (Optional)</label>
            <input type="text" name="budget_alternative" id="edit_budget" class="form-control form-control-sm">
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
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pt-4 px-4 pb-0">
        <h2 class="h6 fw-bold mb-0 text-danger" id="deleteItemModalLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delete Item</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body px-4 py-3">
          <p class="small text-muted mb-0">Are you sure you want to delete <strong id="deleteItemPreview">this item</strong>? This cannot be undone.</p>
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
        
        document.getElementById('editForm').action = `/admin/go-bag-items/${button.dataset.id}`;
        document.getElementById('edit_name').value = button.dataset.name;
        document.getElementById('edit_category').value = button.dataset.category;
        document.getElementById('edit_description').value = button.dataset.description;
        document.getElementById('edit_budget').value = button.dataset.budget || '';
        document.getElementById('edit_active').checked = button.dataset.active == '1';
      });
    }

    const deleteModal = document.getElementById('deleteItemModal');
    if (deleteModal) {
      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('deleteForm').action = `/admin/go-bag-items/${button.dataset.id}`;
        document.getElementById('deleteItemPreview').textContent = button.dataset.name;
      });
    }
  });
</script>
@endpush
