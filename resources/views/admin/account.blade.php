@extends('layouts.admin')

@section('title', 'HandaPH — Admin Account Settings')
@section('topbar_title', 'Account Settings')

@push('styles')
<style>
  /* ---- Account Page Specific Styles ---- */
  .account-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary) 0%, #334155 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #fff;
    flex-shrink: 0;
  }

  .account-profile-card {
    background-color: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-sm);
    margin-bottom: var(--spacing-xl);
  }

  .account-section-card {
    background-color: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-sm);
    margin-bottom: var(--spacing-lg);
  }

  .account-section-card .section-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--color-border);
  }

  .account-section-card .section-header i {
    color: var(--color-secondary);
    font-size: 1rem;
  }

  .account-section-card .section-header h2 {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--color-primary);
    margin: 0;
  }

  .danger-zone-card {
    background-color: #FEF2F2;
    border: 1px solid #FECACA;
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-sm);
    margin-bottom: var(--spacing-xl);
  }

  .danger-zone-card .section-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-md);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid #FECACA;
  }

  .danger-zone-card .section-header i {
    color: #DC2626;
  }

  .danger-zone-card .section-header h2 {
    font-size: 0.95rem;
    font-weight: 700;
    color: #DC2626;
    margin: 0;
  }

  .account-badge {
    background-color: rgba(234, 88, 12, 0.1);
    color: var(--color-secondary);
    border: 1px solid rgba(234, 88, 12, 0.25);
    border-radius: var(--radius-sm);
    font-size: 0.72rem;
    font-weight: 700;
    padding: 2px 8px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }
</style>
@endpush

@section('content')

<div class="admin-page-header">
  <div>
    <h1>Admin Account</h1>
    <p class="page-subtext">View and manage your administrator credentials and account settings.</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
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

<!-- ── PROFILE OVERVIEW CARD ── -->
<div class="account-profile-card">
  <div class="d-flex align-items-center gap-4 flex-wrap">
    <div class="account-avatar" aria-hidden="true">
      <i class="fa-solid fa-user-shield"></i>
    </div>
    <div>
      <div class="d-flex align-items-center gap-2 mb-1">
        <h2 class="h5 fw-bold mb-0" style="color: var(--color-primary);">{{ auth()->user()->name }}</h2>
        <span class="account-badge">Administrator</span>
      </div>
      <p class="small text-muted mb-0">
        <i class="fa-solid fa-at me-1" aria-hidden="true"></i>
        <span>{{ auth()->user()->email }}</span>
      </p>
      <p class="small text-muted mb-0 mt-1">
        <i class="fa-solid fa-clock me-1" aria-hidden="true"></i>
        Account Created: <span class="fw-medium">{{ auth()->user()->created_at->format('M d, Y') }}</span>
      </p>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-12 col-lg-6">

    <!-- ── CHANGE USERNAME SECTION ── -->
    <div class="account-section-card h-100">
      <div class="section-header">
        <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
        <h2>Change Username</h2>
      </div>
      <form action="{{ route('admin.account.profile') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label fw-semibold small text-muted">Current Email</label>
          <input type="text" class="form-control form-control-sm" value="{{ auth()->user()->email }}" readonly style="background-color: #F8FAFC; color: var(--color-text-muted);">
        </div>
        <div class="mb-3">
          <label for="name" class="form-label fw-semibold small text-muted">Username</label>
          <input type="text" name="name" class="form-control form-control-sm" id="name" value="{{ old('name', auth()->user()->name) }}" required minlength="3">
        </div>
        <div class="d-flex justify-content-start mt-4">
          <button type="submit" class="btn btn-primary btn-sm px-4 fw-medium">
            <i class="fa-solid fa-floppy-disk me-1"></i> Save Username
          </button>
        </div>
      </form>
    </div>

  </div>
  <div class="col-12 col-lg-6">

    <!-- ── CHANGE PASSWORD SECTION ── -->
    <div class="account-section-card h-100">
      <div class="section-header">
        <i class="fa-solid fa-lock" aria-hidden="true"></i>
        <h2>Change Password</h2>
      </div>
      <form action="{{ route('admin.account.password') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="current_password" class="form-label fw-semibold small text-muted">Current Password</label>
          <input type="password" name="current_password" class="form-control form-control-sm" id="current_password" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold small text-muted">New Password</label>
          <input type="password" name="password" class="form-control form-control-sm" id="password" required minlength="8">
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label fw-semibold small text-muted">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-control form-control-sm" id="password_confirmation" required>
        </div>
        <div class="d-flex justify-content-start mt-4">
          <button type="submit" class="btn btn-primary btn-sm px-4 fw-medium">
            <i class="fa-solid fa-floppy-disk me-1"></i> Save Password
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

<!-- ── DANGER ZONE ── -->
<div class="danger-zone-card mt-4">
  <div class="section-header">
    <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
    <h2>Danger Zone</h2>
  </div>
  <div class="d-flex flex-column align-items-center text-center gap-3">
    <div>
      <p class="fw-semibold mb-1" style="color: #DC2626; font-size: 0.9rem;">Delete Administrator Account</p>
      <p class="small text-muted mb-0">Permanently remove this admin account and all associated access. This action cannot be undone.</p>
    </div>
    <button class="btn btn-sm fw-semibold px-4" style="background-color: #DC2626; color: #fff; border: none;" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
      <i class="fa-solid fa-trash-can me-1"></i> Delete Account
    </button>
  </div>
</div>

<!-- ===== DELETE ACCOUNT CONFIRMATION MODAL ===== -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pb-0 pt-4 px-4">
        <div class="d-flex align-items-center gap-2">
          <div style="width:36px;height:36px;border-radius:50%;background:#FEE2E2;display:flex;align-items:center;justify-content:center;">
            <i class="fa-solid fa-triangle-exclamation" style="color:#DC2626;font-size:0.85rem;"></i>
          </div>
          <h2 class="h6 fw-bold mb-0" id="deleteAccountModalLabel" style="color:#DC2626;">Delete Admin Account</h2>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('admin.account.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body px-4 py-3">
          <p class="small text-muted mb-3">Are you sure you want to permanently delete your account? This will remove all admin access and cannot be reversed.</p>
          <div class="p-3 rounded-2 mb-2" style="background:#FEF2F2;border:1px solid #FECACA;">
            <p class="small mb-1 fw-semibold" style="color:#DC2626;">
              <i class="fa-solid fa-circle-xmark me-1"></i> You will be signed out immediately.
            </p>
            <p class="small mb-0 fw-semibold" style="color:#DC2626;">
              <i class="fa-solid fa-circle-xmark me-1"></i> All admin privileges will be revoked.
            </p>
          </div>
          <div class="mt-3">
            <label for="deleteConfirmText" class="form-label small fw-semibold text-muted">Type <code>DELETE</code> to confirm</label>
            <input type="text" name="delete_confirm" class="form-control form-control-sm" id="deleteConfirmText" placeholder="Type DELETE here..." required>
          </div>
        </div>

        <div class="modal-footer border-0 px-4 pb-4 pt-2">
          <button type="button" class="btn btn-outline-secondary btn-sm fw-medium px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm fw-semibold px-4" id="confirmDeleteBtn" style="background-color:#DC2626;color:#fff;opacity:0.5;" disabled>
            <i class="fa-solid fa-trash-can me-1"></i> Permanently Delete
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteInput = document.getElementById('deleteConfirmText');
    const deleteBtn = document.getElementById('confirmDeleteBtn');

    if (deleteInput && deleteBtn) {
      deleteInput.addEventListener('input', function () {
        if (this.value === 'DELETE') {
          deleteBtn.disabled = false;
          deleteBtn.style.opacity = '1';
        } else {
          deleteBtn.disabled = true;
          deleteBtn.style.opacity = '0.5';
        }
      });
      
      const deleteModal = document.getElementById('deleteAccountModal');
      deleteModal.addEventListener('hidden.bs.modal', function () {
        deleteInput.value = '';
        deleteBtn.disabled = true;
        deleteBtn.style.opacity = '0.5';
      });
    }
  });
</script>
@endpush
