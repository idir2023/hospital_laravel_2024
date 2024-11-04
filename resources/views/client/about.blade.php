<!DOCTYPE html>
<html lang="en">
@include('client.layout.head')

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-sm">
                        <div class="site-info">
                            <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
                            <span class="divider">|</span>
                            <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right text-sm">
                        <div class="social-mini-button">
                            <a href="#"><span class="mai-logo-facebook-f"></span></a>
                            <a href="#"><span class="mai-logo-twitter"></span></a>
                            <a href="#"><span class="mai-logo-dribbble"></span></a>
                            <a href="#"><span class="mai-logo-instagram"></span></a>
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .topbar -->

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

                <form action="#">
                    <div class="input-group input-navbar">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username"
                            aria-describedby="icon-addon1">
                    </div>
                </form>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @include('client.layout.navbar')

    </header>

    <div class="page-banner overlay-dark bg-image" style="background-image: url(../assets/img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">About Us</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-secondary text-white">
                            <span class="mai-chatbubbles-outline"></span>
                        </div>
                        <p><span>Chat</span> with a doctors</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-primary text-white">
                            <span class="mai-shield-checkmark"></span>
                        </div>
                        <p><span>One</span>-Health Protection</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-accent text-white">
                            <span class="mai-basket"></span>
                        </div>
                        <p><span>One</span>-Health Pharmacy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp">
                    <h1 class="text-center mb-3">Welcome to Your Health Center</h1>
                    <div class="text-lg">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt neque sit, explicabo vero
                            nulla animi nemo quae cumque, eaque pariatur eum ut maxime! Tenetur aperiam maxime iure
                            explicabo aut consequuntur. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nesciunt neque sit, explicabo vero nulla animi nemo quae cumque, eaque pariatur eum ut
                            maxime! Tenetur aperiam maxime iure explicabo aut consequuntur.</p>
                        <p>Expedita iusto sunt beatae esse id nihil voluptates magni, excepturi distinctio impedit illo,
                            incidunt iure facilis atque, inventore reprehenderit quidem aliquid recusandae. Lorem ipsum
                            dolor sit amet consectetur adipisicing elit. Laudantium quod ad sequi atque accusamus
                            deleniti placeat dignissimos illum nulla voluptatibus vel optio, molestiae dolore velit iste
                            maxime, nobis odio molestias!</p>
                    </div>
                </div>
                <div class="col-lg-10 mt-5">
                    <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
                    <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
                        @foreach ($doctors as $doctor)
                            <div class="item">
                                <div class="card-doctor">
                                    <div class="header">

                                            <img src="{{ Storage::url($doctor->avatar)}}"  alt="{{ $doctor->user->name }}">

                                        <div class="meta">
                                            <a href="mailto:{{$doctor->user->email}}"><span class="mai-mail"></span></a>
                                            <a href="https://wa.me/+212{{$doctor->phone}}"><span class="mai-logo-whatsapp"></span></a>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <p class="text-xl mb-0">{{ $doctor->user->name }}</p>
                                        <span class="text-sm text-grey">{{ $doctor->specialty }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('client.layout.footer')
    @include('client.layout.script')

</body>

</html>
