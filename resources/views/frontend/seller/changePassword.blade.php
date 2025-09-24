@extends('layouts.designer_panel')

@section('panel_content')
    <br>
    <h5>Change Password</h5>
    <hr />

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password"
                class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter Current Password"
                required>
            @error('current_password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter New Password"
                        required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Confirm Password" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-lock"></i> Update Password
        </button>
    </form>
@endsection
