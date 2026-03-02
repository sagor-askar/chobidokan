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
</header>
