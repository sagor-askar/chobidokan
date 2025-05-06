@extends('includes.master')
@section('content')
    <main class="main">
        <section class="contact-page-sec contactSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-info">
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h2>Address</h2>
                                    <span>{{ $settings->address ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info">
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h2>E-mail</h2>
                                    <span>{{ $settings->email ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info">
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h2>Phone</h2>
                                    <span>{{ $settings->phone ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-page-form" method="post">
                            <h2>Get in Touch</h2>
                            <form action="contact-mail.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-input-field">
                                            <input type="text" placeholder="Your Name" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-input-field">
                                            <input type="email" placeholder="E-mail" name="email" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-input-field">
                                            <input type="text" placeholder="Phone Number" name="phone" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-input-field">
                                            <input type="text" placeholder="Subject" name="subject" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 message-input">
                                        <div class="single-input-field">
                                            <textarea placeholder="Write Your Message" name="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="single-input-fieldsbtn">
                                        <input type="submit" value="Send Now" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection
