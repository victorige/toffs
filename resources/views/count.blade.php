@extends('main')

@section('content')

  <!-- About Section -->
  <section class="about-section">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-dots wow fadeInleft"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>
        <div class="auto-container">
            <div class="row">
                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2 class="title">Total Haves: {{ $malesoldoutnoroom }}</h2><br>
                            <h2 class="title">Total Elite: {{ $malesoldoutroom }}</h2><br>
                            <h2 class="title">Total Female: {{ $femalesoldout }}</h2><br>
                            <hr><hr>
                            <h2 class="title">Total: {{ $total }}</h2><br>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--End About Section -->

@endsection
