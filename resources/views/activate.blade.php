@extends('main')

@section('content')

	<!-- Register Section -->
	<section class="register-section">
		<div class="auto-container">

			<!-- Form Box -->
			<div class="form-box">
				<div class="box-inner">
                    <h1>Confirm Details</h1>

                    <div class="styled-form login-form">
                    <div style="align-text:left;">
                        <p><img src="/proimg/{{$id}}"/></p>

                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Full Name: {{$fullname}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Nick Name: {{$nickname}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Email: {{$email}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Phone: {{$phone}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">State: {{$state}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Gender: {{$gender}}</span></p>
                        <p><span style="align-text:left; font-size: 24px; color: black" class="title">Package: {{$package}}</span></p>
                    </div>
                    <hr>

                        <form method="post" action="{{ route('check.activation') }}">
                            @csrf


                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock"></span></span>
                                <input type="email" name="email" value="{{$email}}" hidden>
                                <input type="password" name="pin" value="" placeholder="Pin *" required>
                            </div>



                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" name="Submit" class="theme-btn btn-style-two"><span class="btn-title">Activate</span></button>
                                </div>
                            </div>

                            <div class="clearfix">

                            </div>

                        </form>
                    </div>

				</div>
			</div>

		</div>
	</section>
	<!-- End Register Section -->

@endsection
