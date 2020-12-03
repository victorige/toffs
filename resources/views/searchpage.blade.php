@extends('main')

@section('content')

	<!-- Register Section -->
	<section class="register-section">
		<div class="auto-container">

			<!-- Form Box -->
			<div class="form-box">
				<div class="box-inner">
                    <h1>Search</h1>


                    <div class="styled-form login-form">
                        <form method="post" action="{{ route('search.action') }}">
                        @csrf
                            <div class="form-group">

                                <input type="text" name="search" value="" placeholder="Search" required>
                            </div>


                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" name="Submit" class="theme-btn btn-style-two"><span class="btn-title">Search</span></button>
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
