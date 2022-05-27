@extends('front.layout.index')
@section('meta')
    
<title>ABOUT US | GET 5X</title>
<meta name="description" content="Multipurpose HTML template.">
@endsection

@section('content')
<!--=======Banner-Section Starts Here=======-->
<section class="hero-section bg_img" data-background="front/assets/images/about/hero-bg.png">
    <div class="container">
        <div class="hero-content">
            <h1 class="title">About US</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    About Us
                </li>
            </ul>
        </div>
    </div>
</section>
<!--=======Banner-Section Ends Here=======-->

<!--=======About-Section Starts Here=======-->
<section class="about-section padding-top padding-bottom" id="about">
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6 d-none d-lg-block rtl">
            <img src="front/assets/images/about/about.png" alt="about">
        </div>
        <div class="col-lg-6">
            <div class="section-header left-style">
                <span class="cate">WELCOME TO GET 5X</span>
                <h2 class="title">About GET 5X</h2>
                <p>
                    Paystoyou is a registered online platform for those who want to earn money online. Simply sign up make a deposit to view ads and earn money. Paystoyou has been dreaming of devoting all its energies to the welfare of the poor in our country. Paystoyou has also felt the pain and sorrow that people suffer from poverty, particularly women and children who are unable to go to school and obtain proper medical care. This is the online 100% secure method to earn money from home.So lets started work with us and start handsome earning from home.
                </p>
            </div>
            <div class="about--content">
                <div class="about-item">
                    <div class="about-thumb">
                        <img src="front/assets/images/about/about01.png" alt="about">
                    </div>
                    <div class="about-content">
                        <h5 class="title">Secure & Reliable</h5>
                        <p>
                            Secure assets fund for users
                        </p>
                    </div>
                </div>
                <div class="about-item">
                    <div class="about-thumb">
                        <img src="front/assets/images/about/about02.png" alt="about">
                    </div>
                    <div class="about-content">
                        <h5 class="title">Fast Withdrawals</h5>
                        <p>
                            Quick money withdrawals for users
                        </p>
                    </div>
                </div>
                <div class="about-item">
                    <div class="about-thumb">
                        <img src="front/assets/images/about/about03.png" alt="about">
                    </div>
                    <div class="about-content">
                        <h5 class="title">Guaranteed</h5>
                        <p>
                            Your return on investment is guaranteed
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--=======About-Section Ends Here=======-->



@endsection