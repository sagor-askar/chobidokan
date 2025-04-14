@extends('includes.master')
@section('content')
<style>
    /* custom css | no need to replace this */
    .cover-photo {
        margin-top: 5rem;
        height: 15rem;
        object-fit: fill;
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
        margin-top: 100px;
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .editProfile {
        float: right;
        margin-right: 40px;
        margin-top: 10px;
    }


    @media screen and (max-width: 500px) {
        .cover-photo {
            margin-top: 4.2rem;
            height: 15rem;
            object-fit: fill;
            width: 100%;
        }

        .profile-pic {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 5%;
            border: 3px solid white;
            position: absolute;
            bottom: -75px;
            left: 40px;
        }

        .editProfile {
            float: right;
            margin-right: 40px;
            margin-top: 10px;
        }

    }

</style>

<!-- Cover Photo and Profile Picture -->
<div class="position-relative">
    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="cover-photo" alt="Cover Photo">
    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" alt="Profile Picture" class="profile-pic">
</div>

<div class="editProfile">
    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit Profile</a>
</div>

<!-- Bio Section -->
<div class="container bio text-center">
    <h2>Mr. Sagor Vai</h2>
    <p>Software Developer at Polock Group | Ultimate Designer | Photographer</p>
</div>

<!-- Statistics Section -->
<div class="container my-4">
    <h4>Statistics</h4>
    <hr />
    <div class="row text-center">
        <div class="col-md-3">
            <h4>1200</h4>
            <p>Design Submitted</p>
        </div>
        <div class="col-md-3">
            <h4>1150</h4>
            <p>Design Selected</p>
        </div>
        <div class="col-md-3">
            <h4>95%</h4>
            <p>Success Rate</p>
        </div>
        <div class="col-md-3">
            <h4>$ 1050</h4>
            <p>Total Earning</p>
        </div>
    </div>
</div>

<!-- Cards Section -->
<div class="container mb-5">
    <h3>Submitted Works</h3>
    <hr />
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Design 1</h5>
                    <p class="card-text">Some short description about the post or image here.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Design 2</h5>
                    <p class="card-text">Another brief detail can go right here for the card.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Design 3</h5>
                    <p class="card-text">More visual content or portfolio item description.</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
