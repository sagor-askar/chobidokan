<!-- Sidenav content || to display category -->
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
                <li><a href="{{ route('uploads') }}">Upload</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted flex-md-shrink-0" href="{{ route('signin') }}">SIGN IN</a>

    </div>
</header>
