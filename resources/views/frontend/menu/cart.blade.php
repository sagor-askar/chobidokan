@extends('includes.master')
@section('content')

    <div class="container py-5" style="margin-top: 50px;">

        <div class="row">
            <div class="col-lg-8">

                <h3 class="fw-bold mb-4">🛒 My Cart</h3>

                @foreach($carts as $item)
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                        <div class="card-body d-flex align-items-center">

                            <img src="{{ route('product.file.view',$item->product->id) }}"
                                 width="80"
                                 class="rounded-3 shadow-sm">

                            <div class="ms-3 flex-grow-1">
                                <h6 class="fw-bold mb-1">
                                    {{ $item->product->title }}
                                </h6>
                                <small class="text-muted">
                                    ID: {{ $item->product->asset_id ?? $item->product->id }}
                                </small>
                            </div>

                            <div class="text-end">
                                <div class="fw-bold text-success mb-2">
                                    Tk {{ number_format($item->product->price,2) }}
                                </div>

                                <button onclick="removeCart({{ $item->id }})"
                                        class="btn btn-outline-danger btn-sm">
                                    Remove
                                </button>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- RIGHT SIDE SUMMARY --}}
            <div class="col-lg-4">

                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Tk {{ number_format($total,2) }}</span>
                        </div>

                        {{-- Discount --}}
                        <div class="d-flex justify-content-between mb-3"
                             id="discountRow"
                             style="display:none!important;">
                        <span class="text-success">
                            <i class="fa fa-tag"></i> Discount
                        </span>
                            <span class="text-success">
                            - Tk <span id="discountValue">0</span>
                        </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mb-4">
                            <span>Total</span>
                            <span class="text-danger">
                            Tk <span id="finalTotal">{{ $total }}</span>
                        </span>
                        </div>

                        {{-- COUPON --}}
                        <div class="input-group mb-3">
                            <input type="text"
                                   id="couponCode"
                                   class="form-control"
                                   placeholder="Enter coupon">

                            <button class="btn btn-dark"
                                    onclick="applyCoupon()">
                                Apply
                            </button>
                        </div>

                        <div id="couponMessage" style="font-size:13px;"></div>

                        {{-- CHECKOUT --}}
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf

                            <input type="hidden" name="total_amount" id="formPrice" value="{{ $total }}">
                            <input type="hidden" name="coupon" id="formCoupon">

                            <button class="btn w-100 py-2 mt-3"
                                    style="background:#f12c4c;color:white;">
                                Proceed To Payment →
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- JS --}}
    <script>

        let basePrice = {{ $total }};

        function applyCoupon() {

            let code = document.getElementById('couponCode').value;

            if (!code) {
                alert('Enter coupon code');
                return;
            }

            let messageBox = document.getElementById('couponMessage');
            messageBox.innerHTML = 'Applying...';

            fetch('{{ route('apply.coupon') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    coupon_code: code,
                    amount: basePrice
                })
            })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {

                        document.getElementById('discountRow')
                            .style.setProperty("display","flex","important");

                        document.getElementById('discountValue').innerText = data.discount;
                        document.getElementById('finalTotal').innerText = data.new_total;

                        document.getElementById('formPrice').value = data.new_total;
                        document.getElementById('formCoupon').value = code;

                        messageBox.innerHTML =
                            '<span class="text-success">'+data.message+'</span>';

                    } else {

                        messageBox.innerHTML =
                            '<span class="text-danger">'+data.message+'</span>';
                    }

                })
                .catch(() => {
                    messageBox.innerHTML =
                        '<span class="text-danger">Error!</span>';
                });
        }

    </script>

@endsection
