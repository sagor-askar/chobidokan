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

{{--   Remove from cart--}}
    <script>
        function removeCart(id){

            fetch('/cart/remove/'+id,{
                method:'DELETE',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            })
                .then(res=>res.json())
                .then(data=>{

                    location.reload();

                    let cartCount = document.getElementById('cart-count');
                    if(cartCount){
                        cartCount.innerText = data.count;
                    }
                });
        }
    </script>

    <!-- Global Fullscreen Custom Popup Modal -->
    <style>
        .global-image-popup {
            display: none;
            position: fixed;
            z-index: 99999;
            inset: 0;
            background: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
        }
        .global-popup-content-wrapper {
            display: flex;
            flex-direction: column;
            width: 90vw;
            height: 90vh;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            background: #111;
            position: relative;
        }
        .global-popup-media-container {
            position: relative;
            background: #111;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }
        .global-popup-media {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
        .global-popup-footer {
            background: #2a2c31;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .global-popup-footer .brand {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .global-popup-footer .media-id {
            text-align: right;
            font-size: 11px;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.4;
        }
        .global-popup-footer .media-id span {
            color: #9ba0a9;
            font-weight: normal;
        }
        .global-popup-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 32px;
            font-weight: lighter;
            color: #fff;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 100000;
        }
        .global-popup-close:hover {
            color: #ff3b3f;
        }
        /* Repeating Watermark Pattern over image */
        .global-watermark-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 10;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="350" height="250"><g transform="translate(175, 125) rotate(-25) translate(-175, -125)"><text x="175" y="125" font-size="28" font-family="Arial, sans-serif" font-weight="300" fill="rgba(255,255,255,0.3)" text-anchor="middle" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">CHOBIDOKAN</text></g></svg>');
            background-repeat: repeat;
        }
    </style>

    <div id="globalImagePopup" class="global-image-popup mb-0 p-0">
        <span class="global-popup-close" onclick="closeGlobalPopup()"><i class="fa fa-times"></i></span>

        <div class="global-popup-content-wrapper">
            <div class="global-popup-media-container">
                <img id="globalPopupImg" src="" alt="Preview" class="global-popup-media" style="display: none;">
                <video id="globalPopupVid" src="" class="global-popup-media" style="display: none;" controls controlsList="nodownload" oncontextmenu="return false;" autoplay playsinline loop></video>
                <div class="global-watermark-overlay"></div>
            </div>

            <div class="global-popup-footer">
                <div class="brand">chobidokan</div>
                <div class="media-id" id="globalPopupMediaId">
                    IMAGE ID: <span id="globalPopupAssetId"></span><br>
                    <span>www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openGlobalPopup(element) {
            const file = $(element).data('file');
            const assetId = $(element).data('asset-id') || '';
            const type = $(element).data('type'); // 1 = image, 2 = video

            const $img = $('#globalPopupImg');
            const $vid = $('#globalPopupVid');
            const $mediaIdContainer = $('#globalPopupMediaId');

            $img.hide();
            $vid.hide();
            $vid[0].pause();
            $vid[0].src = '';

            if (type == 2) {
                $vid[0].src = file;
                $vid.show();
                $vid[0].play().catch(e => console.log('Video play failed or blocked', e));
                $mediaIdContainer.html('VIDEO ID: ' + assetId + '<br><span>www.chobidokan.com</span>');
            } else {
                $img[0].src = file;
                $img.show();
                $mediaIdContainer.html('IMAGE ID: ' + assetId + '<br><span>www.chobidokan.com</span>');
            }

            $('#globalImagePopup').css('display', 'flex');
            $('body').css('overflow', 'hidden'); // prevent background scrolling
        }

        function closeGlobalPopup() {
            $('#globalImagePopup').css('display', 'none');
            $('body').css('overflow', 'auto');
            const $vid = $('#globalPopupVid');
            $vid[0].pause();
            $vid[0].src = '';
        }

        // Close when clicking outside content wrapper
        $(document).ready(function() {
            $('#globalImagePopup').on('click', function(e) {
                if (e.target === this) {
                    closeGlobalPopup();
                }
            });

            // Bind click event on eyeball-view-btn globally
            $(document).on('click', '.eyeball-view-btn', function(e) {
                e.preventDefault();
                openGlobalPopup(this);
            });
        });
    </script>

</body>

</html>
