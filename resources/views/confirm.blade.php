@extends('main')

@section('content')

  <!-- Speakers Section -->
  <section class="speakers-section-two">
        <div class="anim-icons">
            <span class="icon icon-circle-4 wow zoomIn"></span>
            <span class="icon icon-circle-3 wow zoomIn"></span>
        </div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="title">Confirm your details</span>
            </div>

            <div class="row">

                <!-- Speaker Block -->
                <div class="speaker-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                                <figure class="image"><img src="/proimg/{{$id}}" alt=""></figure>
                        </div>
                    <div style="padding-left: 30px; padding-right: 30px;">
                        <b>Full Name:</b> {{ $fullname }}
                        <br/>
                        <b>Nick Name:</b> {{ $nickname }}
                        <br/>
                        <b>E-mail:</b> {{ $email }}
                        <br/>
                        <b>Phone:</b> {{ $phone }}
                        <br/>
                        <b>State:</b> {{ $state }}
                        <br/>
                        <b>Gender:</b> {{ $gender }}
                        <br/>
                        <b>Package:</b> {{ $package }}
                        <br><br/>
                        <center>
                        <p>


                                <a href="a/{{ $code }}" class="btn btn-success">Confirm</a>

                        </p>

                        <p>

                                <a href="{{ route('get.invite') }}" class="btn btn-danger">Go Back</a>

                        </p>
                        </center>

                        </div>



                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Speakers Section -->

@endsection
