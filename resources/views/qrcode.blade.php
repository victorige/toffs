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
            @if($status==1)
            <b style="color:green; font-size: 36px">CONFIRMED</b>
            @else
            @if($deactivate==1)
            <b style="color:red; font-size: 36px">DEACTIVATED</b>
            @else
            <b style="color:red; font-size: 36px">REJECTED</b>
            @endif
            @endif

            </div>
        <center>
            <div class="row">

                <!-- Speaker Block -->
                <div class="speaker-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <div class="">


                    <div style="padding-left: 30px; padding-right: 30px;">

                    <img width="300px" height="auto" src="/proimg/{{$id}}"/>
                    <br><br>
                    <div class="sec-title text-center" >
                    <p><span class="title">Nickname: {{$nickname}}</span></p>
                    <p><span class="title">Gender: {{$gender}}</span></p>
                    <p><span class="title">Package: {{$package}}</span></p>
                    <p><span class="title">Fullname: {{$fullname}}</span></p>
                    <p><span class="title">Email: {{$email}}</span></p>
                    <p><span class="title">Phone: {{$phone}}</span></p>
                    <p><span class="title">State: {{$state}}</span></p>


                    </div>

                        </div>
                    </div>
                </div>

            </div>
            </center>
        </div>
    </section>
    <!-- End Speakers Section -->



@endsection
