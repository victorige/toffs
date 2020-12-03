@extends('main')
@section('content')

<!-- Banner Conference -->
<section class="banner-conference">

<!-- Icons -->
<div class="icons parallax-scene-1">
    <!-- Icon One -->
    <div data-depth="0.20" class="icon-one parallax-layer" style="background-image:url({{ asset('images/icons/icon-1.png') }})"></div>
    <!-- Icon Two -->
    <div data-depth="0.50" class="icon-two parallax-layer" style="background-image:url({{ asset('images/icons/icon-2.png') }})"></div>
    <!-- Icon Three -->
    <div data-depth="0.10" class="icon-three parallax-layer" style="background-image:url({{ asset('images/icons/icon-3.png') }})"></div>
    <!-- Icon Four -->
    <div data-depth="0.30" class="icon-four parallax-layer" style="background-image:url({{ asset('images/icons/icon-4.png') }})"></div>
    <!-- Icon Five -->
    <div data-depth="0.10" class="icon-five parallax-layer" style="background-image:url({{ asset('images/icons/icon-5.png') }})"></div>
    <!-- Icon Six -->
    <div data-depth="0.20" class="icon-six parallax-layer" style="background-image:url({{ asset('images/icons/icon-6.png') }})"></div>
    <!-- Icon Seven -->
    <div data-depth="0.10" class="icon-seven parallax-layer" style="background-image:url({{ asset('images/icons/icon-7.png') }})"></div>
    <!-- Icon One -->
    <div data-depth="0.20" class="icon-eight parallax-layer" style="background-image:url({{ asset('images/icons/icon-1.png') }})"></div>
    <!-- Icon Two -->
    <div data-depth="0.50" class="icon-nine parallax-layer" style="background-image:url({{ asset('images/icons/icon-8.png') }})"></div>
    <!-- Icon Three -->
    <div data-depth="0.10" class="icon-ten parallax-layer" style="background-image:url({{ asset('images/icons/icon-3.png') }})"></div>
    <!-- Icon Four -->
    <div data-depth="0.30" class="icon-eleven parallax-layer" style="background-image:url({{ asset('images/icons/icon-4.png') }})"></div>
    <!-- Icon Five -->
    <div data-depth="0.10" class="icon-twelve parallax-layer" style="background-image:url({{ asset('images/icons/icon-5.png') }})"></div>
    <!-- Icon Six -->
    <div data-depth="0.20" class="icon-thirteen parallax-layer" style="background-image:url({{ asset('images/icons/icon-6.png') }})"></div>
    <!-- Icon Seven -->
    <div data-depth="0.10" class="icon-fourteen parallax-layer" style="background-image:url({{ asset('images/icons/icon-7.png') }})"></div>
</div>

<div class="layer-outer">
    <div class="gradient-layer"></div>
</div>

<div class="images-outer">
    <figure class="speaker-img"><img src="{{ asset('images/dancers.png') }}" style="width:800px; height:auto;" alt=""></figure>
</div>

<div class="anim-icons full-width">
    <span class="icon icon-circle-3 wow zoomIn"></span>
    <span class="icon icon-dots wow zoomIn"></span>
</div>

<div class="auto-container">
    <div class="content-box">
        <span class="title">March 6, 2020</span>
        <h2> TOFFS &#128131; &#128378;<br> Finale &#128293; &#128293; &#128293;</h2>
        <div class="time-counter"><div class="time-countdown clearfix" data-countdown="3/6/2020 20:00:00"></div></div>
        <div class="btn-box"><a href="{{ route('get.invite') }}" class="theme-btn btn-style-two"><span class="btn-title">Get Invite</span></a></div>
    </div>
</div>
</section>
<!--End Banner Conference -->









@endsection
