@extends('includes.master')
@section('content')
<div class="container py-5">
    <div class="row pt-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-4 font-weight-bold" style="color: #2d3436; border-bottom: 2px solid #f1f2f6; padding-bottom: 10px;">Checkout Summary</h2>
            
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ route('product.file.view', $product->id) }}" alt="{{ $product->title }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #f1f2f6;">
                        <div class="ms-4 pl-4" style="padding-left: 20px;">
                            <h5 class="font-weight-bold mb-1">{{ $product->title ?? 'Product Item' }}</h5>
                            <p class="text-muted mb-0">ID: {{ $product->asset_id ?? $product->id }}</p>
                            @if($subscription)
                                <span class="badge bg-primary mt-2">{{ $subscription->name }} Plan</span>
                            @else
                                <span class="badge bg-secondary mt-2">Single Image License</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-4">Order Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="font-weight-bold">Tk {{ $price }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3" id="discountRow" style="display: none!important;">
                        <span class="text-success"><i class="fa fa-tag"></i> Discount</span>
                        <span class="font-weight-bold text-success">- Tk <span id="discountValue">0</span></span>
                    </div>
                    
                    <hr class="my-3">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="font-weight-bold h5 mb-0">Total</span>
                        <span class="font-weight-bold h5 mb-0" style="color: #f12c4c;">Tk <span id="finalTotal">{{ $price }}</span></span>
                    </div>

                    <div class="input-group mb-4">
                        <input type="text" class="form-control" id="couponCode" placeholder="Enter coupon code" style="border-radius: 6px 0 0 6px;">
                        <button class="btn btn-outline-secondary font-weight-bold" type="button" onclick="applyCoupon()" style="border-radius: 0 6px 6px 0; background: #2d3436; color: white;">Apply Coupon</button>
                    </div>
                    <div id="couponMessage" class="mt-2 text-sm" style="font-size: 13px;"></div>

                    <form action="{{ route('product.purchase') }}" method="POST" id="checkoutForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="subscription_id" value="{{ $subscription_id }}">
                        <!-- The price value gets dynamically updated when a coupon is applied -->
                        <input type="hidden" name="price" id="formPrice" value="{{ $price }}">
                        <input type="hidden" name="coupon_applied" id="formCoupon" value="">

                        <button type="submit" class="btn w-100 font-weight-bold p-3" style="background: #f12c4c; color: white; border-radius: 8px; font-size: 16px;">
                            Proceed to Payment <i class="fa fa-arrow-right ms-2" style="margin-left: 5px;"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let basePrice = {{ $price }};
    
    function applyCoupon() {
        let code = document.getElementById('couponCode').value;
        if (!code) {
            alert('Please enter a coupon code.');
            return;
        }

        let messageBox = document.getElementById('couponMessage');
        messageBox.innerHTML = '<span class="text-muted">Applying...</span>';

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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('discountRow').style.setProperty("display", "flex", "important");
                document.getElementById('discountValue').innerText = data.discount;
                document.getElementById('finalTotal').innerText = data.new_total;
                
                // Update form hidden fields
                document.getElementById('formPrice').value = data.new_total;
                document.getElementById('formCoupon').value = code;

                messageBox.innerHTML = '<span class="text-success"><i class="fa fa-check-circle"></i> ' + data.message + '</span>';
            } else {
                messageBox.innerHTML = '<span class="text-danger"><i class="fa fa-times-circle"></i> ' + data.message + '</span>';
            }
        })
        .catch(error => {
            messageBox.innerHTML = '<span class="text-danger">An error occurred. Try again.</span>';
        });
    }
</script>
@endsection
