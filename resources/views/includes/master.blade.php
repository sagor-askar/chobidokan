<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Chobi Dokan</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('frontend_assets/img/favicon.png') }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend_assets/vendor/bootstrap/css/bootstrap.min.css ') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend_assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    {{-- header content --}}
    @include('includes.header')

    {{-- body content --}}
    @yield('content')

    <!-- footer content -->
    @include('includes.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>

    <!-- script for sidenav -->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
            Swal.fire({
                icon: 'success',
                animation: true,
                text: "{{ session('success') }}",
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                animation: true,
                text: "{{ session('warning') }}",
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            @if (session('error'))
            Swal.fire({
                icon: 'error',
                animation: true,
                text: "{{ session('error') }}",
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                animation: true,
                text: "{{ session('warning') }}",
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            @endif
        });
    </script>

    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>



    <!-- script for Share -->
    <script>
        document.querySelectorAll('.share-btn').forEach(function(btn){
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                let dropdown = this.nextElementSibling;

                document.querySelectorAll('.share-dropdown').forEach(d => {
                    if(d !== dropdown) d.style.display = 'none';
                });

                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
        });

        document.addEventListener('click', function(){
            document.querySelectorAll('.share-dropdown').forEach(d => {
                d.style.display = 'none';
            });
        });

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert("Link copied successfully!");
            });
        }
    </script>

    <!-- script for Add to wishlist -->
    <script>
        function toggleWishlist(id){

            fetch('/wishlist/'+id,{
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            })
                .then(res=>res.json())
                .then(data=>{

                    let icon = document.querySelector('#wishlist-btn-'+id+' i');

                    if(data.status === 'added'){
                        icon.classList.remove('fa-heart-o');
                        icon.classList.add('fa-heart','text-danger');
                    }else{
                        icon.classList.remove('fa-heart','text-danger');
                        icon.classList.add('fa-heart-o');
                    }

                    // update header count
                    let countEl = document.getElementById('wishlist-count');
                    if(countEl){
                        countEl.innerText = data.count;
                    }

                    showToast(data.message, data.status);
                });
        }

        function showToast(message, status){

            let toast = document.createElement("div");
            toast.innerText = message;

            toast.style.position = "fixed";
            toast.style.top = "20px";
            toast.style.right = "20px";
            toast.style.color = "white";
            toast.style.padding = "10px 15px";
            toast.style.borderRadius = "5px";
            toast.style.zIndex = "9999";
            toast.style.fontSize = "14px";

            if(status === 'added'){
                toast.style.background = "#28a745"; // green
            }else{
                toast.style.background = "#dc3545"; // red
            }

            document.body.appendChild(toast);

            setTimeout(()=>{
                toast.remove();
            },2000);
        }
    </script>


</body>

</html>
