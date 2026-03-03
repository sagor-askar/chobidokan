@extends('includes.master')
@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tranId = "{{ $tran_id }}";

            Swal.fire({
                title: "Payment Successful!",
                text: "Downloading your purchased products...",
                icon: "success",
                showConfirmButton: false,
                timer: 3000,
                willClose: () => {
                    // Auto trigger zip download
                    window.location.href = "/cart/download-zip/" + tranId;

                    // Redirect to welcome page after delay
                    setTimeout(() => {
                        window.location.href = "{{ route('welcome') }}";
                    }, 2000);
                }
            });
        });
    </script>

@endsection
