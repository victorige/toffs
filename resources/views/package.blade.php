@extends('main')

@section('content')


  <!-- Pricing Section -->
  <section class="pricing-section-two">
        <div class="anim-icons">
            <span class="icon icon-line-1 wow zoomIn"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
            <span class="icon icon-dots wow zoomIn"></span>
        </div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="title">Packages</span>
                <h2>Select a Package</h2>
            </div>

            <!-- Alert -->
            @if ($errors->has('msg'))
                        <div class="alert logout-content">
                                        <h6 style="color:red;">{{ $errors->first('msg') }}
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                    </div>
                        @endif
                        <!-- Alert -->

            <div class="outer-box">
                <div class="row">

                @if ($gender === 'Male')

                    <!-- Pricing Block -->
                    <div class="pricing-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="title"><span class="icon flaticon-movie-tickets"></span> Haves</div>
                            <div class="price-box">
                                <h4 class="price">&#8358;10,000.00</h4>
                            </div>
                            <ul class="features">
                                <li class="true">Food</li>
                                <li class="true">Drinks</li>
                                <li class="true">Snacks</li>
                                <li class="false">Bottle of Hennessy</li>
                                <li class="false">A Superior Room</li>
                            </ul>
                            <div class="btn-box">

                            @if($malesoldoutnoroom < 70)
                            <form method="post" action="{{ route('confirm') }}">
                                @csrf
                                <input type="text" name="code" value="{{$code}}" hidden="">
                                <input type="text" name="package" value="Haves" hidden="">
                                <button class="theme-btn btn-style-one" type="submit" name="Submit"><span class="btn-title">Select</span></button>
                            </form>
                            @else

                            <h2>Sold Out</h2>

                            @endif

                            </div>
                        </div>
                    </div>



                    <!-- Pricing Block -->
                    <div class="pricing-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="inner-box">
                            <div class="title"><span class="icon flaticon-movie-tickets"></span> Elite</div>
                            <div class="price-box">
                                <h4 class="price">&#8358;50,000.00</h4>
                            </div>
                            <ul class="features">
                                <li class="true">Food</li>
                                <li class="true">Drinks</li>
                                <li class="true">Snacks</li>
                                <li class="true">Bottle of Hennessy</li>
                                <li class="true">A Superior Room</li>
                            </ul>
                            <div class="btn-box">

                            @if($malesoldoutroom < 5)
                            <form method="post" action="{{ route('confirm') }}">
                                @csrf
                                <input type="text" name="code" value="{{$code}}" hidden="">
                                <input type="text" name="package" value="Elite" hidden="">
                                <button class="theme-btn btn-style-one" type="submit" name="Submit"><span class="btn-title">Select</span></button>
                            </form>
                            @else

                            <h2>Sold Out</h2>

                            @endif


                            </div>
                        </div>
                    </div>

                    @else

                    <!-- Pricing Block -->
                    <div class="pricing-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="title"><span class="icon flaticon-movie-tickets"></span> Belle</div>
                            <div class="price-box">
                                <h4 class="price">Free</h4>
                            </div>
                            <ul class="features">
                                <li class="true">Food</li>
                                <li class="true">Drinks</li>
                                <li class="true">Snacks</li>
                            </ul>
                            <div class="btn-box">
                            @if($femalesoldout < 201)
                            <form method="post" action="{{ route('confirm') }}">
                                @csrf
                                <input type="text" name="code" value="{{$code}}" hidden="">
                                <input type="text" name="package" value="Free" hidden="">
                                <button class="theme-btn btn-style-one" type="submit" name="Submit"><span class="btn-title">Select</span></button>
                            </form>
                            @else

                            <h2>Sold Out</h2>

                            @endif


                            </div>
                        </div>
                    </div>

                    @endif


                </div>
            </div>
        </div>
    </section>
    <!--End Pricing Section -->




@endsection
