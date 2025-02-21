<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Leadership Event HTML5 Bootstrap v5 Template</title>

        <!-- CSS FILES -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-leadership-event.css" rel="stylesheet">
        
<!--

TemplateMo 575 Leadership Event

https://templatemo.com/tm-575-leadership-event

-->
    </head>
    
    <body>

        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="index.html" class="navbar-brand mx-auto mx-lg-0">
                    <i class="bi-bullseye brand-logo"></i>
                    <span class="brand-text">Leadership <br> Event</span>
                </a>

                <!-- <a class="nav-link custom-btn btn d-lg-none" href="#">Buy Tickets</a> -->

               
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('Attendence') }}">Attendence</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('message') }}">Message</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('meeting') }}">Meeting</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('timetracking') }}">Time Tracking</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-btn btn d-none d-lg-block" href="#">Login </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-btn btn d-none d-lg-block" href="#">Log Out</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-btn btn d-none d-lg-block" href="#">Login </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-btn btn d-none d-lg-block" href="#">Log Out</a>
                        </li>

                       
                    </ul>
                <div>
                        
            </div>
        </nav>

        <main>

            <section class="hero" id="Dashboard">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12 m-auto">
                            <div class="hero-text">

                                <h1 class="text-white mb-4"><u class="text-info">Leadership</u> Conference 2022</h1>

                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="date-text">July 12 to 18, 2022</span>

                                    <span class="location-text">Times Square, NY</span>
                                </div>

                                <a href="#section_2" class="custom-link bi-arrow-down arrow-icon"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="videos/pexels-pavel-danilyuk-8716790.mp4" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>


            <section class="highlight">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="images/highlight/alexandre-pellaes-6vAjp0pscX0-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2019 Highlights</h3>

                                    <a href="https://www.youtube.com/templatemo" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="images/highlight/miguel-henriques--8atMWER8bI-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2020 Highlights</h3>

                                    <a href="https://www.youtube.com/templatemo" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="images/highlight/jakob-dalbjorn-cuKJre3nyYc-unsplash.jpg" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h3 class="highlight-title">2021 Highlights</h3>

                                    <a href="https://www.youtube.com/templatemo" class="bi-youtube highlight-icon"></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
