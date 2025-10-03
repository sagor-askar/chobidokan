@extends('layouts.designer_panel')

@section('panel_content')
    <div class="container mt-4">
        <h4 class="mb-3">Manage Profile</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('designer.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- User Info --}}
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $user->address) }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 my-2">
                        <div class="col-md-12">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" id="bio" rows="5"
                                      class="form-control @error('bio') is-invalid @enderror"
                                      placeholder="Write something about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="image" class="form-label">Profile Image</label>

                            <input type="file" name="image" id="image"
                                   class="form-control @error('image') is-invalid @enderror">

                            @if($user->image)
                                <div class="mb-2">
                                    <img src="{{ asset($user->image) }}"
                                         alt="User Image"
                                         class="img-thumbnail"
                                         style="max-width: 150px; max-height: 90px;">
                                </div>
                            @else
                                <p class="text-muted">No image uploaded yet.</p>
                            @endif

                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <hr class="my-4">
                    {{-- Bank Info --}}
                    <h5 class="mb-3">Bank Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name"
                                   class="form-control @error('bank_name') is-invalid @enderror"
                                   value="{{ old('bank_name', $user->bank_name) }}">
                            @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="branch_name" class="form-label">Branch Name</label>
                            <input type="text" name="branch_name" id="branch_name"
                                   class="form-control @error('branch_name') is-invalid @enderror"
                                   value="{{ old('branch_name', $user->branch_name) }}">
                            @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                            <input type="text" name="account_holder_name" id="account_holder_name"
                                   class="form-control @error('account_holder_name') is-invalid @enderror"
                                   value="{{ old('account_holder_name', $user->account_holder_name) }}">
                            @error('account_holder_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="number" name="account_number" id="account_number"
                                   class="form-control @error('account_number') is-invalid @enderror"
                                   value="{{ old('account_number', $user->account_number) }}">
                            @error('account_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="routing_no" class="form-label">Routing Number</label>
                            <input type="number" name="routing_no" id="routing_no"
                                   class="form-control @error('routing_no') is-invalid @enderror"
                                   value="{{ old('routing_no', $user->routing_no) }}">
                            @error('routing_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="account_type" class="form-label">Account Type</label>
                            <input type="text" name="account_type" id="account_type"
                                   class="form-control @error('account_type') is-invalid @enderror"
                                   value="{{ old('account_type', $user->account_type) }}">
                            @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="mobile_banking_no" class="form-label">Mobile Banking Number</label>
                            <input type="number" name="mobile_banking_no" id="mobile_banking_no"
                                   class="form-control @error('mobile_banking_no') is-invalid @enderror"
                                   value="{{ old('mobile_banking_no', $user->mobile_banking_no) }}">
                            @error('mobile_banking_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#bio'))
                .catch(error => {
                    console.error(error);
                });
        </script>

@endsection
