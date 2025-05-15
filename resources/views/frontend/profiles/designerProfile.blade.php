@extends('includes.master')
@section('content')
<style>
    /* custom css */
    .cover-photo {
        margin-top: 5rem;
        height: 15rem;
        object-fit: cover;
        width: 100%;
    }

    .profile-pic {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 5%;
        border: 3px solid white;
        position: absolute;
        bottom: -90px;
        left: 40px;
    }

    .bio {
        margin-top: 6rem;
        padding: 0 15px;
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .editProfile {
        position: absolute;
        right: 20px;
        top: 20px;
        z-index: 10;
    }

    .statistics {
        margin-top: 4rem;
    }

    .statistics .col-md-3 {
        margin-bottom: 1rem;
    }

    /* Mobile responsiveness */
    @media screen and (max-width: 768px) {
        .cover-photo {
            margin-top: 3.5rem;
            height: 12rem;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            bottom: -60px;
            left: 20px;
        }

        .bio {
            margin-top: 4rem;
        }

        .bio h2 {
            font-size: 1.5rem;
        }

        .bio p {
            font-size: 0.9rem;
        }

        .editProfile {
            top: 10px;
            right: 10px;
        }

        .editProfile .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        .statistics h4 {
            font-size: 1.25rem;
        }

        .statistics p {
            font-size: 0.8rem;
        }
    }

    @media screen and (max-width: 576px) {
        .cover-photo {
            height: 10rem;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            bottom: -50px;
        }

        .bio {
            margin-top: 3.5rem;
        }

        .statistics .col-md-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media screen and (max-width: 400px) {
        .profile-pic {
            width: 80px;
            height: 80px;
            bottom: -40px;
            left: 15px;
        }

        .bio {
            margin-top: 3rem;
        }

        .bio h2 {
            font-size: 1.3rem;
        }
    }

</style>

<!-- Cover Photo and Profile Picture -->
<div class="position-relative">
    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="cover-photo" alt="Cover Photo">
    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" alt="Profile Picture" class="profile-pic">
    <div class="editProfile">
        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit Profile</a>
    </div>
</div>

<!-- Bio Section -->
<div class="container bio text-center">
    <h2 class="mb-2">Mr. Sagor Vai</h2>
    <p class="text-muted">Software Developer at Polock Group | Ultimate Designer | Photographer</p>
</div>

<!-- Statistics Section -->
<div class="container statistics my-4">
    <h4>Statistics</h4>
    <hr />
    <div class="row text-center">
        <div class="col-md-3 col-6">
            <h4>1200</h4>
            <p class="text-muted">Design Submitted</p>
        </div>
        <div class="col-md-3 col-6">
            <h4>1150</h4>
            <p class="text-muted">Design Selected</p>
        </div>
        <div class="col-md-3 col-6">
            <h4>4.5</h4>
            <p class="text-muted">Review</p>
        </div>
        <div class="col-md-3 col-6">
            <h4>$ 1050</h4>
            <p class="text-muted">Total Earning</p>
        </div>
    </div>
</div>

<!-- Cards Section -->
<div class="container mb-5">
    <h3>Submitted Works</h3>
    <hr />
    <div class="row g-3">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card h-100">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="Design 1">
                <div class="card-body">
                    <h5 class="card-title">Design 1</h5>
                    <p class="card-text text-muted">Some short description about the post or image here.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card h-100">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="Design 2">
                <div class="card-body">
                    <h5 class="card-title">Design 2</h5>
                    <p class="card-text text-muted">Another brief detail can go right here for the card.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card h-100">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="Design 3">
                <div class="card-body">
                    <h5 class="card-title">Design 3</h5>
                    <p class="card-text text-muted">More visual content or portfolio item description.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
