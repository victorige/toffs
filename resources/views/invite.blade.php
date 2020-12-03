@extends('main')

@section('content')



<script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script>
       function onSubmit(token) {
         document.getElementById("invite-form").submit();
       }
     </script>

  <!-- Buy Ticket  -->
  <section class="buy-ticket">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>
        <div class="auto-container">
            <div class="row">
                <!-- Content Column -->
                <div class="content-column col-lg-12 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <center><h2>Get Invite</h2></center>

                        <!-- Alert -->
                        @if ($errors->has('msg'))
                        <div class="alert logout-content">
                                        <h6 style="color:red;">{{ $errors->first('msg') }}
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></h6>
                                    </div>
                        @endif
                        <!-- Alert -->

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="inner-column">
                        <div class="ticket-form">
                            <form id="invite-form" method="post" enctype="multipart/form-data" action="{{ route('package') }}">
                            @csrf

                                <div class="form-group">
                                    <label style="color:black; font-weight:bold">Full Name:</label>
                                    <input type="text" name="fullname" placeholder="Your Name" required="">
                                </div>

                                <div class="form-group">
                                    <label style="color:black; font-weight:bold">Nick Name (what would you like us to call you?):</label>
                                    <input type="text" name="nickname" placeholder="Your Nick Name" required="">
                                </div>

                                <div class="form-group">
                                <label style="color:black; font-weight:bold">E-mail:</label>
                                    <input type="email" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="form-group">
                                <label style="color:black; font-weight:bold">Phone Number:</label>
                                    <input type="tel" name="phone" pattern="^\d{11}$" maxlength="11" minlength="11"  placeholder="Your Phone" required="">
                                </div>

                                <div class="form-group">
                                <label style="color:black; font-weight:bold">Gender:</label>
                                    <select name="gender" required="">
                                        <option disabled selected value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                <label style="color:black; font-weight:bold">State (Your current location):</label>
                                    <select name="state" required="">
                                        <option disabled selected value="">--Select State--</option>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross Rive">Cross River</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="FCT">Federal Capital Territory</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Imo">Imo</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Katsina">Katsina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nasarawa">Nasarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Zamfara">Zamfara</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                <label style="color:black; font-weight:bold">Picture (Max: 5MB):</label>
                                <input type="file" name="picture" accept="image/png,image/jpg,image/jpeg" required="">
                                <br>
                                    <b style="color:red;">Upload a clear picture of yourself showing your face.</b><br>

                                </div>





                                <div class="form-group">

                                    <label for="term"> <input type="checkbox" name="terms" id="term" required=""> I agree the that above informations are correct and your Nick name and Picture can be used by TOFFS team for promotion Adverts.</label>
                                </div>

                                <div class="form-group">
                                    <button data-sitekey="6LeW79YUAAAAALW_lUu-2kzg7BUY4AlH4LPgSKbc" data-callback='onSubmit' class="theme-btn btn-style-three g-recaptcha" name="Submit"><span class="btn-title">Get Invite</span></button>
                                </div>
                            </form>
                        </div>


                    </div>



                      </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End Buy Ticket  -->


@endsection
