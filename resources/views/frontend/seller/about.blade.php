@extends('layouts.designer_panel')

@section('panel_content')
    <div class="container mt-4">
        <h4 class="mb-3">About Me</h4>

        {{-- Bio Section --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header  text-white">
                <h6 class="mb-0"><i class="fa fa-user-circle"></i> Bio</h6>
            </div>
            <div class="card-body">
                <p class="mb-0">{!! $user->bio ?? 'No bio added yet.' !!}</p>
            </div>
        </div>

        {{-- Personal Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white">
                <h6 class="mb-0"><i class="fa fa-id-card"></i> Personal Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if($user->image)
                            <img src="{{ asset($user->image) }}"
                                 alt="User Image"
                                 class="img-thumbnail rounded-circle shadow-sm"
                                 style="width:120px; height:120px; object-fit:cover;">
                        @else
                            <img src="https://via.placeholder.com/120"
                                 alt="No Image"
                                 class="img-thumbnail rounded-circle shadow-sm">
                        @endif
                        <h6 class="mt-2">{{ $user->name }}</h6>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-bordered mb-0">
                            <tbody>
                            <tr>
                                <th style="width: 200px;">Full Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->address ?? 'N/A' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bank Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white">
                <h6 class="mb-0"><i class="fa fa-university"></i> Bank Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong>Bank Name:</strong> <br>
                        <span>{{ $user->bank_name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Branch Name:</strong> <br>
                        <span>{{ $user->branch_name ?? 'N/A' }}</span>
                    </div>

                    <div class="col-md-6">
                        <strong>Account Holder Name:</strong> <br>
                        <span>{{ $user->account_holder_name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Account Number:</strong> <br>
                        <span>{{ $user->account_number ?? 'N/A' }}</span>
                    </div>

                    <div class="col-md-6">
                        <strong>Routing Number:</strong> <br>
                        <span>{{ $user->routing_no ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Account Type:</strong> <br>
                        <span>{{ $user->account_type ?? 'N/A' }}</span>
                    </div>

                    <div class="col-md-6">
                        <strong>Mobile Banking No:</strong> <br>
                        <span>{{ $user->mobile_banking_no ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
