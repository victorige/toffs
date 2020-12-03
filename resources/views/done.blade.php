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
            @if($status==0)
                <span class="title">Activate Your Invite</span>
                @else
                <span class="title">Hi, {{$nickname}}</span>
                @endif
            </div>
        <center>
            <div class="row">

                <!-- Speaker Block -->
                <div class="speaker-block-two col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <div class="">


                    <div style="padding-left: 30px; padding-right: 30px;">
                    @if($status==0)
                        <b>Your reference code is <br><br>
                        <span style="font-size:28px; color:black">{{ $code }}</span></b>
                        <br><br>
                        Contact any of the individuals below on Whatsapp with your reference code to activate your invite.
                    <p><hr/>
                    @if ($gender === 'Male')
                        <p><b style="color: black">Caleb (+2347068139694)<br><a href="https://api.whatsapp.com/send?phone=2347068139694&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }}* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with Caleb</b></a></b></p><hr/>
                        <p><b style="color: black">Gitto (+2348161917337)<br><a href="https://api.whatsapp.com/send?phone=2348161917337&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }}* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with Gitto</b></a></b></p><hr/>
                        <p><b style="color: black">Gee Jokes (+2348183575757)<br><a href="https://api.whatsapp.com/send?phone=2348183575757&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }} (https://toffs.ng/a/{{ $code }})* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with Gee Jokes</b></a></b></p>
                        @else
                        <p><b style="color: black">Mjayjay (+2348186026083)<br><a href="https://api.whatsapp.com/send?phone=2348186026083&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }}* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with Mjayjay</b></a></b></p><hr/>
                        <p><b style="color: black">The Place (+2348123483149)<br><a href="https://api.whatsapp.com/send?phone=2348123483149&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }}* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with The Place</b></a></b></p>

                    @endif
                    <hr/></p>

                    @else
                    <b>Here is your invite<br><br>
                    <img width="300px" height="300px" src="/img/{{$id}}.png"/>

                    @endif


                        </div>
                    </div>
                </div>

            </div>
            </center>
        </div>
    </section>
    <!-- End Speakers Section -->

<!-- <hr/> <p><b style="color: black">Misfits (+2349037708693)<br><a href="https://api.whatsapp.com/send?phone=2349037708693&text=Hi, I want to activate my TOFFS invite. My reference code is *{{ $code }}* (https://toffs.ng/a/{{ $code }})" class="btn btn-success btn-sm full-width"><b>Click to Chat with Misfits</b></a></b></p> -->

@endsection



