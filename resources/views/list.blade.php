@extends('main')

@section('content')


	<!-- Register Section -->
	<section class="register-section">
		<div class="auto-container">

			<!-- Form Box -->
			<div class="form-box">
				<div class="box-inner">


    @foreach ($lists as $list)
        <a href="picture/{{ $list->code }}" target="_blank"><div class="h5 post__author-name fn">{!! $list->nickname !!}</div></a>
        <hr>
    @endforeach

    @if ($page > 1)
        <span  style='float: left;'><a href='?page={{ $jm }}' class='btn btn-bg-secondary btn-md'>< PREV</a></span>
    @endif

    @if ($page != $totalPages)
        <span style='float: right;'><a id='page_a_link'  class='btn btn-bg-secondary btn-md' href='?page={{ $jp }}'>NEXT ></a></span>
    @endif

    </div>
			</div>

		</div>
	</section>
	<!-- End Register Section -->


@endsection
