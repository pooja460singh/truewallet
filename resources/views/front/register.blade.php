@extends('front.layouts.app')
 @section('content')



   <section class="fxt-template-animation fxt-template-layout2 blue-back">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-6 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <a href="login.html" class="fxt-logo"><img src="{{url('public/login/img/logo.png')}}" alt="Logo"></a>
                        </div>
                        <div class="fxt-form">
                            <form method="POST"  action="" id="customer_form" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter Name" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input type="text" class="form-control" name="contact" placeholder="Contact No." required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <input type="text" class="form-control" name="referalcode" placeholder="Referal Code" value="{{\Request::get('referalcode')}}" readonly="readonly">
                                         <input type="hidden" class="form-control" name="referal_code" placeholder="Referal Code" value="{{\Request::get('referalcode')}}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-5">
                                        <div class="fxt-checkbox-area">
                                            <div class="checkbox">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1">I agree to the terms of service</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-6">
                                        <button type="submit" class="fxt-btn-fill">Register</button>
                                    </div>
                                </div>
                            </form>                            
                        </div>
                        <div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-7">
                                <!--<p>Have you an account?<a href="login.html" class="switcher-text">Log in</a></p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 fxt-none-991 fxt-bg-img" data-bg-image="{{url('public/login/img/bg5.jpg')}}"></div>
            </div>
        </div>
    </section>
    @endsection
    @push('scripts')
   <script src="{{url('public/dist/customer.js') }}"></script>
  @endpush