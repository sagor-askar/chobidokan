@extends('layouts.user_panel')

@section('panel_content')
    <br>
    <h5>Manage Profile</h5>
    <hr />

    <form action="" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                        required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone"
                        class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ old('address', $user->address) }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <hr>

        <label for="">Bank Info Update</label>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="bank_name">Bank Name</label>
                    <input type="text" name="bank_name" id="bank_name"
                        class="form-control @error('bank_name') is-invalid @enderror"
                        value="{{ old('bank_name', $user->bank_name) }}">
                    @error('bank_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="branch_name">Branch Name</label>
                    <input type="text" name="branch_name" id="branch_name"
                        class="form-control @error('branch_name') is-invalid @enderror"
                        value="{{ old('branch_name', $user->branch_name) }}">
                    @error('branch_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="account_holder_name">Account Holder Name</label>
                    <input type="text" name="account_holder_name" id="account_holder_name"
                        class="form-control @error('account_holder_name') is-invalid @enderror"
                        value="{{ old('account_holder_name', $user->account_holder_name) }}">
                    @error('account_holder_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="account_number">Account Number</label>
                    <input type="number" name="account_number" id="account_number"
                        class="form-control @error('account_number') is-invalid @enderror"
                        value="{{ old('account_number', $user->account_number) }}">
                    @error('account_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="routing_no">Routing Number</label>
                    <input type="number" name="routing_no" id="routing_no"
                        class="form-control @error('routing_no') is-invalid @enderror"
                        value="{{ old('routing_no', $user->routing_no) }}">
                    @error('routing_no')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="account_type">Account Type</label>
                    <input type="text" name="account_type" id="account_type"
                        class="form-control @error('account_type') is-invalid @enderror"
                        value="{{ old('account_type', $user->account_type) }}">
                    @error('account_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="mobile_banking_no">Mobile Banking Number</label>
                    <input type="number" name="mobile_banking_no" id="mobile_banking_no"
                        class="form-control @error('mobile_banking_no') is-invalid @enderror"
                        value="{{ old('mobile_banking_no', $user->mobile_banking_no) }}">
                    @error('mobile_banking_no')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-save"></i> Update Profile
        </button>
    </form>
@endsection
