@extends('includes.master')
@section('content')
<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h2 class="main-head">Bootstrap Compatible Responsive Pricing Tables</h2>
            </div>
            <!-- Purple Table -->
            <div class="col-md-4">
                <div class="pricing-table purple">
                    <!-- Table Head -->
                    <div class="pricing-label">Plan A</div>
                    <h2>BasicPack 2020</h2>
                    <h5>Made for starters</h5>
                    <!-- Features -->
                    <div class="pricing-features">
                        <div class="feature">Bandwith<span>50 GB</span></div>
                        <div class="feature">Add-On Domains<span>10</span></div>
                        <div class="feature">SSD Storage<span>250 GB</span></div>
                        <div class="feature">Mail Adresses<span>25</span></div>
                        <div class="feature">Support<span>Only Mail</span></div>
                    </div>
                    <!-- Price -->
                    <div class="price-tag">
                        <span class="symbol">$</span>
                        <span class="amount">7.99</span>
                        <span class="after">/month</span>
                    </div>
                    <!-- Button -->
                    <a class="price-button" href="#">Get Started</a>
                </div>
            </div>
            <!-- Turquoise Table -->
            <div class="col-md-4">
                <div class="pricing-table turquoise">
                    <!-- Table Head -->
                    <div class="pricing-label">Plan B</div>
                    <h2>ExtendedPack 2020</h2>
                    <h5>Made for experienced users</h5>
                    <!-- Features -->
                    <div class="pricing-features">
                        <div class="feature">Bandwith<span>150 GB</span></div>
                        <div class="feature">Add-On Domains<span>25</span></div>
                        <div class="feature">SSD Storage<span>500 GB</span></div>
                        <div class="feature">Mail Adresses<span>50</span></div>
                        <div class="feature">Support<span>Mail/Phone</span></div>
                    </div>
                    <!-- Price -->
                    <div class="price-tag">
                        <span class="symbol">$</span>
                        <span class="amount">9.99</span>
                        <span class="after">/month</span>
                    </div>
                    <!-- Button -->
                    <a class="price-button" href="#">Get Started</a>
                </div>
            </div>
            <!-- Red Table -->
            <div class="col-md-4">
                <div class="pricing-table red">
                    <!-- Table Head -->
                    <div class="pricing-label">Plan C</div>
                    <h2>ProsPack 2020</h2>
                    <h5>Made for professionals/agencies</h5>
                    <!-- Features -->
                    <div class="pricing-features">
                        <div class="feature">Bandwith<span>250 GB</span></div>
                        <div class="feature">Add-On Domains<span>50</span></div>
                        <div class="feature">SSD Storage<span>1 TB</span></div>
                        <div class="feature">Mail Adresses<span>75</span></div>
                        <div class="feature">Support<span>7/24</span></div>
                    </div>
                    <!-- Price -->
                    <div class="price-tag">
                        <span class="symbol">$</span>
                        <span class="amount">12.99</span>
                        <span class="after">/month</span>
                    </div>
                    <!-- Button -->
                    <a class="price-button" href="#">Get Started</a>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
