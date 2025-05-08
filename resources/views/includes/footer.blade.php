<footer id="footer" class="footer">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="d-flex align-items-center">
                    <span class="sitename">Chobi Dokan</span>
                </a>
                <div class="footer-contact pt-3">
                    <p><strong>Email:</strong> <span>{{ $settings->email ?? '' }}</span></p>
                    <p class="mt-3"><strong>Phone:</strong> <span>{{ $settings->phone ?? '' }}</span></p>
                </div>
                <div class="social-links d-flex">
                    <a href="{{ $setting->twitter ?? '' }}"><i class="bi bi-twitter-x"></i></a>
                    <a href="{{ $setting->facebook ?? '' }}"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $setting->instagram ?? '' }}"><i class="bi bi-instagram"></i></a>
                    <a href="{{ $setting->linkedin ?? '' }}"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Company Info</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('welcome') }}">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about-us') }}">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('testimonials') }}">Testimonials</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('image-research') }}">Image Research</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Learn More</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('pricing-info') }}">Pricing</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('licencing') }}">Licensing</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('terms-of-use') }}">Terms of Use</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Need Help?</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact-us') }}">Contact Us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('search-tips') }}">Search Tips</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('faq') }}">FAQ</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('technical') }}">Technical</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="container copyright text-center text-white mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Chobi Dokan</strong> <span>All Rights
                Reserved</span></p>
    </div>

</footer>
