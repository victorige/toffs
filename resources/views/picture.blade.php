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

                <span class="title">Nickname: {{$nickname}}</span>

            </div>
        <center>
            <div class="row">

                <!-- Speaker Block -->
                <div class="speaker-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <div class="">


                    <div style="padding-left: 30px; padding-right: 30px;">

                    <img width="300px" height="auto" src="/proimg/{{$id}}"/>




                        </div>
                    </div>
                </div>

            </div>
            </center>
        </div>
    </section>
    <!-- End Speakers Section -->



@endsection
