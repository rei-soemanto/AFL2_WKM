@extends('layout.mainlayout')

@section('name', 'My Profile')

@section('content')
<div class="container-fluid bg-black py-5" style="min-height: 100vh; background-color: #000000;">

    @if ($action === 'edit')
        <div class="container" style="max-width: 768px;">
            <div class="mb-4">
                <a href="{{ route('users.index') }}" class="text-white text-decoration-none d-flex align-items-center mb-2">
                    <svg class="me-1" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Profile
                </a>
                <h1 class="fw-bold" style="color: #e0bb35;">Edit Profile</h1>
            </div>

            <div class="card border shadow-lg overflow-hidden" style="background-color: #0f0f0f; border-color: #0f0f0f;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small" style="color: #e0bb35;">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                                class="form-control bg-transparent text-light" 
                                style="border-color: #e0bb35;">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold small" style="color: #e0bb35;">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                                class="form-control bg-transparent text-light" 
                                style="border-color: #e0bb35;">
                        </div>

                        <hr class="my-4" style="border-color: #e0bb35; opacity: 1;">

                        <h3 class="h5 fw-medium mb-3" style="color: #e0bb35;">
                            Change Password <span class="small text-secondary fw-normal">(Leave blank to keep current)</span>
                        </h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-bold small" style="color: #e0bb35;">New Password</label>
                                <input type="password" name="password" id="password" placeholder="New Password" 
                                    class="form-control bg-transparent text-light" 
                                    style="border-color: #e0bb35;">
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-bold small" style="color: #e0bb35;">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" 
                                    class="form-control bg-transparent text-light" 
                                    style="border-color: #e0bb35;">
                            </div>
                        </div>

                        <div class="mt-4 pt-4 d-flex justify-content-end gap-2" style="border-top: 1px solid #e0bb35;">
                            <a href="{{ route('users.index') }}" class="btn btn-light text-uppercase fw-bold shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
                                Cancel
                            </a>
                            <button type="submit" class="btn text-black text-uppercase fw-bold" style="background-color: #e0bb35; border-color: #e0bb35; font-size: 0.75rem; letter-spacing: 1px;">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @else
        <div class="container" style="max-width: 768px;">
            
            @if (session('success'))
                <div class="alert alert-success border-start border-5 border-success shadow-sm mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-0 shadow-lg overflow-hidden" style="background-color: #0f0f0f; border-radius: 1rem;">
                
                <div style="height: 128px; background: linear-gradient(to right, #e0bb35, #e3cf85);"></div>
                
                <div class="card-body px-4 px-md-5 pb-5">
                    <div class="d-flex justify-content-between align-items-end mb-4" style="margin-top: -3rem;">
                        <div class="position-relative">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" 
                                    class="rounded-circle border border-4 shadow-sm object-fit-cover" 
                                    style="width: 128px; height: 128px; border-color: #0f0f0f !important;">
                            @else
                                <div class="rounded-circle border border-4 d-flex align-items-center justify-content-center shadow-sm fw-bold" 
                                    style="width: 128px; height: 128px; border-color: #0f0f0f !important; background-color: #e0bb35; color: #0f0f0f; font-size: 2.25rem;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('users.edit') }}" class="btn mb-2 d-inline-flex align-items-center text-black text-uppercase fw-bold shadow-sm" 
                            style="background-color: #e0bb35; border-color: #e0bb35; font-size: 0.75rem; letter-spacing: 1px;">
                            <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profile
                        </a>
                    </div>

                    <div class="mb-4">
                        <h1 class="fw-bold mb-0" style="color: #e0bb35;">{{ $user->name }}</h1>
                        <p class="text-secondary fw-medium mb-1">{{ $user->userRole->name ?? 'User' }}</p>
                        <p class="text-light mb-0">{{ $user->email }}</p>
                    </div>

                    <hr class="my-4" style="border-color: #e0bb35; opacity: 1;">

                    <div class="pt-2">
                        <h3 class="h5 fw-medium text-danger">Delete Account</h3>
                        <p class="small text-secondary mb-3">Permanently delete your account and all associated data.</p>
                        
                        <form method="POST" action="{{ route('users.destroy') }}" class="d-inline-block" onsubmit="return confirm('Are you absolutely sure? This action cannot be undone.');">
                            @csrf
                            @method('delete')
                            
                            <div class="d-flex gap-2 align-items-center">
                                <input type="password" name="password" placeholder="Confirm Password" required 
                                    class="form-control form-control-sm bg-white text-dark border-secondary"
                                    style="max-width: 200px;">
                                
                                <button type="submit" class="btn btn-danger btn-sm text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                                    Delete Account
                                </button>
                            </div>
                            @error('password')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
@endsection