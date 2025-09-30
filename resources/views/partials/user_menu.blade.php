<div class="col-md-3">
    @php
        use Illuminate\Support\Facades\Auth;
        $user= Auth::user();
    @endphp
    <div class="card text-center shadow-sm mb-4">
        <div class="card-body">
            <img src="{{ asset($user->image ?? 'frontend_assets/img/team/team-1.jpg') }}"
                class="rounded-circle profile-img mb-3" alt="User Image" />
            <h5 class="card-title font-weight-bold">{{ $user->name }}</h5>
            <p class="card-text mb-1"><i class="fa fa-envelope mr-2"></i>{{ $user->email }}</p>
            <p class="card-text"><i class="fa fa-phone mr-2"></i>{{ $user->phone }}</p>
        </div>
    </div>

    <div class="list-group shadow-sm">
        <a href="{{ route('designer.dashboard') }}"
            class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-tachometer mr-2"></i> Dashboard
        </a>
        <a href="{{ route('designer.about', $user->id) }}"
            class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-user mr-2"></i> About
        </a>
        <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-folder-open mr-2"></i> Orders
        </a>

        <a href="{{ route('user.order-history') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-folder-open mr-2"></i> Order History
        </a>

        <a href="{{ route('user.manage.profile') }}"
            class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-cog mr-2"></i> Manage Profile
        </a>
        <a href="{{ route('user.change.password') }}"
            class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fa fa-key mr-2"></i> Change Password
        </a>
        
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center text-danger" style="display: block; width: 100%; padding: 10px; background: none; border: none; text-align: left; cursor: pointer; color: black;">
                <i class="fa fa-sign-out"></i> {{ trans('global.logout') }}
            </button>
        </form>
    </div>
</div>

<style>
    .profile-img {
        width: 130px;
        height: 130px;
        object-fit: cover;
    }

    .list-group-item:hover {
        background-color: #007bff;
        color: #fff;
        transition: 0.3s;
    }

    .list-group-item i {
        min-width: 20px;
        text-align: center;
    }
</style>
