<!DOCTYPE html>
<html lang="en">

<head>
    <title>EVENTIFY</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom/bootstrap.min.css') }}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom/font-awesome.min.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom/swiper.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom/style.css') }}">
    <script src="{{ asset('js/custom/custom.js') }}"></script>
</head>

<body>
    <header class="site-header">
        <div class="header-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-10 col-lg-2 order-lg-1">
                        <div class="site-branding">
                            <div class="site-title">
                                <a href="#"><img src="{{ asset('images/eventify.png') }}" alt="logo"></a>
                            </div><!-- .site-title -->
                        </div><!-- .site-branding -->
                    </div><!-- .col -->

                    <div class="col-2 col-lg-7 order-3 order-lg-2">
                        <nav class="site-navigation">
                            <div class="hamburger-menu d-lg-none">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div><!-- .hamburger-menu -->

                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Events</a></li>
                            </ul>
                        </nav><!-- .site-navigation -->
                    </div><!-- .col -->


                </div><!-- .row -->
            </div><!-- .container-fluid -->
        </div><!-- .header-bar -->

        <div class="swiper-container hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-date="2018/05/01"
                    style="background: url('images/header-bg.jpg') no-repeat">
                    <div class="hero-content">
                        <div class="container">
                            <div class="row">
                                <div class="col flex flex-column justify-content-center">
                                    <div class="entry-header">
                                        <div class="countdown flex align-items-center">
                                        </div><!-- .countdown -->

                                        <h2 class="entry-title">Discover the Best of Campus Life: <br>Join, Share, Celebrate!</h2>
                                    </div><!--- .entry-header -->
                                </div><!-- .col -->
                            </div><!-- .container -->
                        </div><!-- .hero-content -->
                    </div><!-- .swiper-slide -->
                </div><!-- .swiper-wrapper -->
            </div>
        </div><!-- .swiper-container -->
    </header>

    <div class="homepage-info-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-5">
                    <figure>
                        <img src="{{ asset('images/eventify.png') }}" alt="logo">
                    </figure>
                </div>

                <div class="col-12 col-md-8 col-lg-7">
                    <header class="entry-header">
                        <h2 class="entry-title">What is Eventify and why choose our services?</h2>
                    </header>

                    <div class="entry-content">
                        <p>Vestibulum eget lacus at mauris sagittis varius. Etiam ut venenatis dui. Nullam tellus risus,
                            pellentesque at facilisis et, scelerisque sit amet metus. Duis vel semper turpis, ac tempus
                            libero. Maecenas id ultrices risus. Aenean nec ornare ipsum, lacinia volutpat urna. Maecenas
                            ut aliquam purus, quis sodales dolor.</p>
                    </div>

                    <footer class="entry-footer">
                        <a href="#" class="btn gradient-bg">Read More</a>
                        <a href="#" class="btn dark">Register Now</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <div class="homepage-next-events">
        <div class="container">
            <div class="row">
                <div class="next-events-section-header">
                    <h2 class="entry-title">Our next events</h2>
                    <p>Vestibulum eget lacus at mauris sagittis varius. Etiam ut venenatis dui. Nullam tellus risus,
                        pellentesque at facilisis et, scelerisque sit amet metus. Duis vel semper turpis, ac tempus
                        libero. Maecenas id ultrices risus. Aenean nec ornare ipsum, lacinia.</p>
                </div>
            </div>

            <div class="row">
                @foreach ($events as $event)
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="next-event-wrap">
                            <figure>
                                <a href="{{ url('detail-event/' . $event->id) }}"><img src="{{ asset('storage/'.$event->photo) }}" alt="Event"></a>
                            </figure>

                            <header class="entry-header">
                                <h3 class="entry-title">{{ $event->name }}</h3>
                                <div class="posted-date">
                                    {{ date('l', strtotime($event->start_date)) }}
                                    <span>{{ date('M d, Y', strtotime($event->start_date)) }}</span>
                                </div>
                            </header>

                            <div class="entry-content">
                                <p>{{ $event->description }}</p>
                            </div>

                            {{-- <footer class="entry-footer">
                                <a href="#">Buy Tikets</a>
                            </footer> --}}
                        </div>
                    </div>
                @endforeach
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="next-event-wrap">
                        <figure>
                            <a href="#"><img src="images/next1.jpg" alt="1"></a>
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">U2 Concert in Detroitt</h3>

                            <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                        </header>

                        <div class="entry-content">
                            <p>Vestibulum eget lacus at mauris sagittis varius. Etiam ut venenatis dui. Nullam tellus
                                risus.</p>
                        </div>

                        <footer class="entry-footer">
                            <a href="#">Buy Tikets</a>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="site-footer mt-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <figure class="footer-logo">
                        <a href="#"><img src="{{ asset('images/eventify.png') }}" alt="logo" width="150"></a>
                    </figure>

                    <nav class="footer-navigation">
                        <ul class="flex flex-wrap justify-content-center align-items-center">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Events</a></li>
                        </ul>
                    </nav>

                    {{-- <div class="footer-social">
                        <ul class="flex flex-wrap justify-content-center align-items-center">
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer>

    <div class="back-to-top flex justify-content-center align-items-center">
        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z" />
            </svg></span>
    </div>

    <script type='text/javascript' src='{{ asset('js/custom/jquery.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/masonry.pkgd.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/jquery.collapsible.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/swiper.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/jquery.countdown.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/circle-progress.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/jquery.countTo.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/custom/custom.js') }}'></script>

</body>

</html>
