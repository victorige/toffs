@extends('main')

@section('content')

	<!-- Register Section -->
	<section class="register-section">
		<div class="auto-container">

			<!-- Form Box -->
			<div class="form-box">
				<div class="box-inner">
                    <h1>Activate Invite Code</h1>

                    <!-- Alert -->
                    @if ($errors->has('msg'))
                        <div class="alert logout-content">
                                        <h6 style="color:red;">{{ $errors->first('msg') }}
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                    </div>
                        @endif
                        <!-- Alert -->


                    <div class="styled-form login-form">
                        <form method="post" action="{{ route('check.invite') }}">
                        @csrf
                            <div class="form-group">

                                <input type="text" name="code" value="" placeholder="Reference Code *" required>
                            </div>


                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock"></span></span>
                                <input type="password" name="pin" value="" placeholder="Pin *" required>
                            </div>


                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" name="Submit" class="theme-btn btn-style-two"><span class="btn-title">Check</span></button>
                                </div>
                            </div>


                        </form>
                    </div>

				</div>
			</div>

		</div>
	</section>
	<!-- End Register Section -->

@endsection
