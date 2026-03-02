@extends('includes.master')
@section('content')

    <div class="container mt-5">
        <h3>My Cart</h3>

        @if($carts->count())

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
                </thead>

                <tbody>
                @foreach($carts as $item)
                    <tr>
                        <td width="120">
                            <img src="{{ route('product.file.view',$item->product->id) }}"
                                 width="100">
                        </td>
                        <td>{{ $item->product->title }}</td>
                        <td>Tk {{ $item->product->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="card p-3">
                <h5>Total: Tk {{ $total }}</h5>

                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button class="btn btn-success mt-2">
                        Proceed To Payment
                    </button>
                </form>
            </div>

        @else
            <div class="alert alert-warning">
                Cart empty
            </div>
        @endif

    </div>

@endsection
