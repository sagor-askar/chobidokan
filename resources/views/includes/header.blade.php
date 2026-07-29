{{-- custom css for cart --}}
<style>
    /*.cart-badge {*/
    /*    font-size: 12px;*/
    /*}*/
    /*.cart-dropdown {*/
    /*    width: 320px;*/
    /*}*/
    /*.cart-item img {*/
    /*    width: 50px;*/
    /*    height: 50px;*/
    /*    object-fit: cover;*/
    /*}*/
    /*.remove-btn {*/
    /*    cursor: pointer;*/
    /*    font-size: 18px;*/
    /*}*/
    /*.remove-btn:hover {*/
    /*    color: red;*/
    /*}*/
    /*@media (max-width: 991px) {*/
    /*    .dropdown-menu {*/
    /*        position: absolute;*/
    /*        right: 0;*/
    /*        left: auto;*/
    /*    }*/
    /*}*/
    /*!* Desktop hover for cart dropdown *!*/
    /*    @media (min-width: 992px) {*/
    /*        .nav-item.dropdown:hover .dropdown-menu {*/
    /*            display: block;*/
    /*        }*/
    /*    }*/

    /*    !* Mobile: position dropdown correctly *!*/
    /*    @media (max-width: 991px) {*/
    /*        .dropdown-menu.show {*/
    /*            display: block !important;*/
    /*        }*/
    /*    }*/


    .cart-icon{
        font-size:22px;
        color:#333;
        position:relative;
        text-decoration:none;
    }
    .cart-icon:hover{
        color:#198754;
    }
    .cart-badge{
        position:absolute;
        top:-6px;
        right:-10px;
        background:#dc3545;
        color:#fff;
        font-size:11px;
        padding:3px 6px;
        border-radius:50px;
    }
</style>

<!-- Sidenav content || to display category -->

<style>
    .wishlist-wrapper {
        display: flex;
        align-items: center;
    }

    .wishlist-icon {
        position: relative;
        font-size: 22px;
        color: #333;
        text-decoration: none;
        transition: 0.3s;
    }

    .wishlist-icon:hover {
        /*color: #dc3545;*/
        transform: scale(1.1);
    }

    .wishlist-badge {
        position: absolute;
        top: -6px;
        right: -10px;
        background: #dc3545;
        color: white;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 6px;
        border-radius: 50px;
        min-width: 18px;
        text-align: center;
    }
</style>

<style>
    .notification-icon {
        position: relative;
        font-size: 22px;
        color: #333;
        text-decoration: none;
        transition: 0.3s;
    }
    .notification-icon:hover {
        transform: scale(1.1);
    }
    .notification-badge {
        position: absolute;
        top: -6px;
        right: -10px;
        background: #dc3545;
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 6px;
        border-radius: 50px;
        min-width: 18px;
        text-align: center;
    }
    #notificationDropdown {
        display: none;
        position: absolute;
        top: 40px;
        right: 0;
        left: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 320px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        border-radius: 6px;
    }
    #notificationDropdown .notification-item {
        display: block;
        padding: 10px 14px;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #eee;
        font-size: 13px;
        white-space: normal;
    }
    #notificationDropdown .notification-item:last-child {
        border-bottom: none;
    }
    #notificationDropdown .notification-item.unread {
        background-color: #f5f8ff;
    }
    #notificationDropdown .notification-item:hover {
        background-color: #eef1f5;
    }
    #notificationDropdown .notification-time {
        display: block;
        font-size: 11px;
        color: #888;
        margin-top: 4px;
    }
    #notificationDropdown .notification-empty {
        padding: 14px;
        text-align: center;
        color: #888;
        font-size: 13px;
    }

    @media (max-width: 1200px) {
        .wishlist-icon,
        .cart-icon,
        .notification-icon {
            font-size: 16px;
        }

        .wishlist-badge,
        .cart-badge,
        .notification-badge {
            font-size: 9px;
            padding: 2px 5px;
            top: -4px;
            right: -8px;
        }

        .wishlist-wrapper {
            margin-right: 8px !important;
            margin-left: 8px !important;
        }

        .cart-wrapper {
            margin-right: 8px !important;
        }

        .header .logo.logo-compact img {
            max-height: 22px !important;
        }

        .header .logo.logo-compact .sitename {
            font-size: 18px !important;
        }
    }
</style>

    @php
     $categories = \App\Models\Category::where('type',1)->where('status',1)->get();
     $siteSettings = \App\Models\Setting::first();
    @endphp

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @foreach($categories as $key=> $category)
    <a href="{{ route('category-wise-product',$category?->id) }}">{{ $category?->name }}</a>
    @endforeach
</div>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <!-- sidenav logo -->
        <h2 class="sidenav-logo" onclick="openNav()" style="cursor: pointer;">
            @if(!empty($siteSettings->logo_icon))
                <img src="{{ asset($siteSettings->logo_icon) }}" alt="logo icon" style="height: 30px; width: auto;">
            @else
                <i class="fa fa-camera"></i>
            @endif
        </h2>

        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center me-auto @if(Auth::check()) logo-compact @endif">
            @if(!empty($siteSettings->logo))
                <img src="{{ asset($siteSettings->logo) }}" alt="{{ $siteSettings->site_title ?? 'Chobi Dokan' }}" style="max-height: 36px; width: auto;">
            @else
                <h1 class="sitename">Chobi Dokan</h1>
            @endif
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('info') }}">Info</a></li>
                <li><a href="{{ route('customize') }}">Jobs</a></li>
                @if (Auth::check())
                    @if(Auth::user()->role_id == 2)
                        <li><a href="{{ route('designer.upload') }}">Upload</a></li>
                    @endif
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


        @if(Auth::check())
            <div class="wishlist-wrapper" style="position: relative; margin-right:12px; margin-left: 12px;">
                <a href="{{ route('wishlist.page') }}" class="wishlist-icon">
                    <i class="fa fa-heart"></i>
                    @php
                       $wishlistCount = \App\Models\Wishlist::where('user_id',auth()->id())->count();
                    @endphp
                    @if($wishlistCount > 0)
                        <span id="wishlist-count" class="wishlist-badge"> {{ $wishlistCount }} </span>
                    @endif
                </a>

            </div>

            <div class="cart-wrapper position-relative me-3">
                <a href="{{ route('cart.index') }}" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>

                    @if($globalCartCount > 0)
                        <span id="cart-count" class="cart-badge">
                {{ $globalCartCount }}
            </span>
                    @endif
                </a>
            </div>

            <div style="position: relative; margin-right: 12px;">
                @php
                    $recentNotifications = \App\Models\Notification::where('user_id', auth()->id())
                        ->latest()
                        ->take(10)
                        ->get();
                    $unreadNotificationCount = $recentNotifications->where('is_read', false)->count();
                @endphp
                <a href="#" onclick="toggleNotificationDropdown(event)" class="notification-icon">
                    <i class="fa fa-bell"></i>
                    @if($unreadNotificationCount > 0)
                        <span class="notification-badge">{{ $unreadNotificationCount }}</span>
                    @endif
                </a>

                <div id="notificationDropdown">
                    @forelse($recentNotifications as $notification)
                        <a href="{{ route('notifications.read', $notification->id) }}" class="notification-item {{ $notification->is_read ? '' : 'unread' }}">
                            {{ $notification->message }}
                            <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                    @empty
                        <div class="notification-empty">No notifications yet</div>
                    @endforelse
                </div>
            </div>

        @endif



        <!-- User Profile or Login / Registration -->
        @if (Auth::check())
        <!-- User Profile -->
        <div style="position: relative;">
            <a href="#" onclick="toggleDropdown()" style="display: flex; align-items: center; text-decoration: none; color: black; margin-left: 0.8rem;">
                <img src="{{ asset(Auth::user()->image ? Auth::user()->image : 'assets/img/user/default-user.png') }}" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                <span>{{ Auth::user()->name }}</span>
            </a>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" style="display: none; position: absolute; top: 40px; left: 0; background-color: white; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">

             @if( Auth::user()->role_id == 2)
                <a href="{{ route('designer.dashboard') }}" style="display: block; padding: 10px; text-decoration: none; color: black; width: 8rem;">
                    <i class="fa fa-list"></i> {{ trans('global.dashboard') }}
                </a>
              @endif
            @if( Auth::user()->role_id == 3)
                <a href="{{ route('user.dashboard') }}" style="display: block; padding: 10px; text-decoration: none; color: black; width: 8rem;">
                    <i class="fa fa-list"></i> {{ trans('global.dashboard') }}
                </a>
               @endif
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: block; width: 100%; padding: 10px; background: none; border: none; text-align: left; cursor: pointer; color: black;">
                        <i class="fa fa-sign-out"></i> {{ trans('global.logout') }}
                    </button>
                </form>
            </div>
        </div>
        @else
        <!-- Login Button -->
        <div>
            <a class="btn-getstarted flex-md-shrink-0" href="{{ route('signin') }}">SIGN IN</a>
        </div>

        @endif
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            if (dropdown && !event.target.closest('#dropdownMenu') && !event.target.closest('a')) {
                dropdown.style.display = 'none';
            }
        });

    </script>

    {{-- notification dropdown script --}}
    <script>
        function toggleNotificationDropdown(event) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('notificationDropdown');
            if (dropdown && !event.target.closest('#notificationDropdown') && !event.target.closest('.notification-icon')) {
                dropdown.style.display = 'none';
            }
        });
    </script>

    {{-- cart script --}}
    <script>
        function updateCart() {
            let total = 0;
            let items = document.querySelectorAll('.cart-item');

            items.forEach(item => {
                total += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('cart-total').innerText = total;
            document.getElementById('cart-count').innerText = items.length;
        }

        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {

                    e.preventDefault();
                    e.stopPropagation();   // 🔥 This is the key line

                    this.closest('.cart-item').remove();
                    updateCart();
                });
            });

        });

        updateCart();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const cartToggle = document.getElementById("cartDropdown");
            const cartMenu = cartToggle.nextElementSibling;

            function isMobile() {
                return window.innerWidth < 992; // Bootstrap lg breakpoint
            }

            cartToggle.addEventListener("click", function (e) {

                if (isMobile()) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Toggle dropdown manually
                    if (cartMenu.classList.contains("show")) {
                        cartMenu.classList.remove("show");
                    } else {
                        cartMenu.classList.add("show");
                    }
                }
            });

            // Close when clicking outside (mobile only)
            document.addEventListener("click", function (e) {
                if (isMobile()) {
                    if (!cartToggle.contains(e.target) &&
                        !cartMenu.contains(e.target)) {
                        cartMenu.classList.remove("show");
                    }
                }
            });

        });
    </script>
</header>
