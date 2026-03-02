@extends('includes.master')
@section('content')

    <div class="container mt-5">

        <h3 class="fw-bold mb-4">My Wishlist</h3>

{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                {{ session('success') }}--}}
{{--            </div>--}}
{{--        @endif--}}

        @if($wishlists->count())

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Product</th>
                            <th width="120">Price</th>
                            <th width="100">Remove</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($wishlists as $item)
                            <tr>

                                <td>
                                    <input type="checkbox"
                                           form="cartForm"
                                           name="products[]"
                                           value="{{ $item->product->id }}">
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <a target="_blank" href="{{ route('product-details',$item->product->id) }}"> <img src="{{ route('product.file.view',$item->product->id) }}"
                                             width="70"
                                             height="70"
                                             class="rounded">

                                        <strong>{{ $item->product->title }}</strong>
                                        </a>
                                    </div>
                                </td>

                                <td class="fw-bold text-success">
                                    Tk {{ number_format($item->product->price,2) }}
                                </td>

                                <td>
                                    {{-- DELETE FORM (COMPLETELY SEPARATE) --}}
                                    <form action="{{ route('wishlist.remove',$item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ADD TO CART FORM (OUTSIDE TABLE) --}}

            <form id="cartForm"
                  action="{{ route('cart.store') }}"
                  method="POST"
                  class="mt-3 text-end">
                @csrf

                <button type="submit" class="btn btn-primary px-4">
                    Add Selected To Cart
                </button>
            </form>

        @else
            <div class="alert alert-warning text-center">
                Wishlist empty
            </div>
        @endif

    </div>

    <script>
        document.getElementById('selectAll')?.addEventListener('click', function () {
            document.querySelectorAll('input[name="products[]"]').forEach(el => {
                el.checked = this.checked;
            });
        });
    </script>

@endsection
