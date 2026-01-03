@extends('layout.mainlayout')

@section('name', 'My Profile')

@section('content')
<main class="profile-main-wrapper py-5">

    @if ($action === 'edit')
        <div class="container container-narrow">
            <div class="mb-4 ms-3 ms-sm-0">
                <a href="{{ route('users.index') }}" class="text-white text-decoration-none d-flex align-items-center mb-2">
                    <i class="bi bi-arrow-left me-2"></i> Back to Profile
                </a>
                <h1 class="text-responsive-h1 fw-bold text-gold">Edit Profile</h1>
            </div>

            <div class="card card-profile shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-control">
                        </div>

                        <hr class="my-4">

                        <h3 class="h5 fw-medium text-gold mb-3">
                            Change Password <span class="small text-secondary fw-normal">(Leave blank to keep current)</span>
                        </h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="mt-4 pt-4 d-flex justify-content-end gap-2 border-top border-gold">
                        <a href="{{ route('users.index') }}" class="btn btn-light text-uppercase fw-bold btn-sm px-4 d-flex align-items-center justify-content-center">
                            Cancel
                        </a>
                        
                        <button type="submit" class="btn btn-gold text-uppercase fw-bold btn-sm px-4">
                            Save Changes
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @else
        <div class="container container-narrow">
            
            @if (session('success'))
                <div class="alert alert-success border-start border-5 shadow-sm mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card card-profile shadow-lg">
                <div class="profile-banner"></div>
                
                <div class="card-body px-4 px-md-5 pb-5">
                    <div class="profile-header-group mb-4">
                        <div class="profile-avatar-container">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-circle avatar-img">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center avatar-placeholder fw-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('users.edit') }}" class="btn btn-gold btn-edit d-inline-flex align-items-center text-uppercase fw-bold shadow-sm btn-sm px-3">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profile
                        </a>
                    </div>

                    <div class="mb-4 text-center text-sm-start d-flex flex-column d-sm-block gap-2">
                        <h1 class="fw-bold mb-0 text-gold">{{ $user->name }}</h1>
                        <p class="text-secondary fw-medium mb-1">{{ $user->userRole->name ?? 'User' }}</p>
                        <p class="text-light mb-0">{{ $user->email }}</p>
                    </div>

                    <hr class="my-4 border-gold opacity-50">

                    <div class="pt-2">
                        <h3 class="h5 fw-medium text-danger">Delete Account</h3>
                        <p class="small text-secondary mb-3">Permanently delete your account and all associated data.</p>
                        
                        <form method="POST" action="{{ route('users.destroy') }}" onsubmit="return confirm('Are you absolutely sure?');">
                            @csrf
                            @method('delete')
                            
                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                <input type="password" name="password" placeholder="Confirm Password" required 
                                    class="form-control form-control-sm bg-white text-dark w-auto" style="min-width: 200px;">
                                
                                <button type="submit" class="btn btn-danger btn-sm text-uppercase fw-bold">
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
</main>
@endsection