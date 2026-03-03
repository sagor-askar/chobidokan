@extends('includes.master')
@section('content')

    <div class="container py-5" style="margin-top: 50px;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">🛒 My Cart</h3>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                Continue Shopping
            </a>
        </div>

        @if($carts->count())

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">

                            <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th width="150">Price</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($carts as $item)
                                <tr>

                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">

                                            <a target="_blank"
                                               href="{{ route('product-details',$item->product->id) }}">

                                                <img src="{{ route('product.file.view',$item->product->id) }}"
                                                     width="80"
                                                     class="rounded-3 shadow-sm">
                                            </a>

                                            <div>
                                                <a target="_blank"
                                                   href="{{ route('product-details',$item->product->id) }}"
                                                   class="text-dark fw-semibold text-decoration-none">
                                                    {{ $item->product->title }}
                                                </a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                    <span class="fw-bold text-success">
                                        Tk {{ number_format($item->product->price,2) }}
                                    </span>
                                    </td>

                                    <td class="text-center">
                                        <button onclick="removeCart({{ $item->id }})"
                                                class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                            Remove
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            {{-- Cart Summary --}}
            <div class="row mt-4">
                <div class="col-md-6 ms-auto">

                    <div class="card shadow border-0 rounded-4">
                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-3">Order Summary</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Tk {{ number_format($total,2) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax</span>
                                <span class="text-muted">Included</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                                <span>Total</span>
                                <span class="text-success">
                                Tk {{ number_format($total,2) }}
                            </span>
                            </div>

                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button class="btn btn-success w-100 rounded-pill py-2 shadow-sm">
                                    Proceed To Payment
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        @else

            {{-- Empty State --}}
            <div class="card shadow-sm border-0 rounded-4 text-center p-5">
                <div class="mb-3" style="font-size:50px;">🛒</div>
                <h5 class="fw-bold">Your Cart is Empty</h5>
                <p class="text-muted">Looks like you haven't added anything yet.</p>

                <a href="{{ url('/') }}"
                   class="btn btn-primary rounded-pill px-4 mt-2">
                    Start Shopping
                </a>
            </div>

        @endif

    </div>

@endsection
