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
                                    <h2>address</h2>
                                    <span>1215 Lorem Ipsum, Ch 176080 </span>
                                    <span>Chandigarh , INDIA</span>
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
                                    <span>info@LoremIpsum.com</span>
                                    <span>yourmail@gmail.com</span>
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
                                    <h2>office time</h2>
                                    <span>Mon - Thu 9:00 am - 4.00 pm</span>
                                    <span>Thu - Mon 10.00 pm - 5.00 pm</span>
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
