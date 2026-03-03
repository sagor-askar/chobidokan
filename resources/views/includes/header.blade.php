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

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Category 1</a>
    <a href="#">Category 2</a>
    <a href="#">Category 3</a>
    <a href="#">Category 4</a>
</div>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <!-- sidenav logo -->
        <h2 class="sidenav-logo" onclick="openNav()" style="cursor: pointer;"><i class="fa fa-camera"></i></h2>

        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">Chobi Dokan</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
{{--                <li class="nav-item dropdown position-relative">--}}
{{--                    <!-- Cart Icon -->--}}
{{--                    <a class="nav-link position-relative"--}}
{{--                        href="javascript:void(0);"--}}
{{--                        id="cartDropdown">--}}

{{--                        <i class="bi bi-cart3 fs-5"></i>--}}

{{--                        <span id="cart-count"--}}
{{--                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge"--}}
{{--                            style="margin-top: 15px;">--}}
{{--                            3--}}
{{--                        </span>--}}
{{--                    </a>--}}

{{--                    <!-- Dropdown Menu -->--}}
{{--                    <ul class="dropdown-menu dropdown-menu-end p-3 cart-dropdown"--}}
{{--                        aria-labelledby="cartDropdown">--}}

{{--                        <li class="cart-item d-flex align-items-center justify-content-between mb-3" data-price="20">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <img src="https://via.placeholder.com/50" class="me-2 rounded">--}}
{{--                                <div>--}}
{{--                                    <h6 class="mb-0">Product 1</h6>--}}
{{--                                    <small class="text-muted">$20</small>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <i class="bi bi-x remove-btn"></i>--}}
{{--                        </li>--}}

{{--                        <li><hr class="dropdown-divider"></li>--}}

{{--                        <li class="d-flex justify-content-between mb-2">--}}
{{--                            <strong>Total:</strong>--}}
{{--                            <strong>$<span id="cart-total">20</span></strong>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="#" class="btn btn-sm btn-primary w-100 text-white">View Cart</a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}

{{--                </li>--}}

                <li><a href="{{ route('info') }}">Info</a></li>
                <li><a href="{{ route('customize') }}">Customize Jobs</a></li>
                @if (Auth::check())
                    @if(Auth::user()->role_id == 2)
                        <li><a href="{{ route('designer.upload') }}">Upload</a></li>
                    @endif
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


        @if(Auth::check())
            <div class="wishlist-wrapper" style="position: relative; margin-right:15px;">
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
