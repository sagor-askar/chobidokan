@extends('includes.master')
@section('content')
<style>
    .pricing-table {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Hover Effect */
    .pricing-table:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    /* Button Hover */
    .price-button {
        transition: all 0.3s ease;
    }

    .pricing-table:hover .price-button {
        background: #000;
        color: #fff;
    }

    /* Feature animation */
    .pricing-features .feature {
        transition: all 0.3s ease;
    }

    .pricing-table:hover .feature {
        transform: translateX(5px);
    }

    /* Title effect */
    .pricing-table h2 {
        transition: all 0.3s ease;
    }

    .pricing-table:hover h2 {
        letter-spacing: 1px;
    }

    /* Optional: Highlight border on hover */
    .pricing-table:hover {
        border: 2px solid rgba(0,0,0,0.1);
    }

</style>

<main class="main">
    <div class="container">
        <div class="row d-flex m-2">
            <div class="col-md-12 mb-5 ">
                <h2 class="main-head text-center">Subscription Package Pricing Plan </h2>
            </div>
            <!-- Purple Table -->
                @foreach($subscriptions as $key=>$subscription)
                    @php
                         $colors = ['purple','turquoise','red'];
                           $subscription_points = json_decode($subscription?->points);
                            if ($subscription->type == 1){
                                 $type = 'Image';
                            }else{
                                 $type = 'Custom Design';
                            }
                    @endphp

                    <div class="col-md-4 d-flex">
                        <div class="pricing-table w-100 {{ $colors[$key % count($colors)] }}">
                            <div class="pricing-label text-center">Plan - <strong>{{$type}}</strong></div>
                            <h2>{{ $subscription->name }}</h2>
                            <div class="pricing-features">
                                @foreach($subscription_points as $val)
                                    <div class="feature">{{$val}}</div>
                                @endforeach

                                @if($subscription->type == 1)
                                   <div class="feature">No of Image <span>{{ $subscription->total_image ?? '0' }}</span></div>
                                @endif
                                @if($subscription->type == 2)
                                    <div class="feature">Total Designer <span>{{ $subscription->designer ?? '0' }} </span></div>
                                    <div class="feature">Total Design <span>{{ $subscription->design ?? '0' }} </span></div>
                                @endif
                                <div class="feature">Support<span>Only Mail</span></div>
                            </div>

                            <div class="price-tag">
                                <span class="symbol">TK.</span>
                                <span class="amount">{{ $subscription->price }}</span>
                                <span class="after">/{{ $subscription->days }} days</span>
                            </div>

                            @if(auth()->check())
                                <form action="{{ route('subscription.purchase') }}" method="POST" class="w-100 m-0">
                                    @csrf
                                    <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                                    <button type="submit" class="price-button w-100" style="display: block;">
                                        Get Started
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('signin') }}" class="price-button">
                                    Get Started
                                </a>
                            @endif
                        </div>
                    </div>

                @endforeach

        </div>
    </div>

</main>
@endsection
