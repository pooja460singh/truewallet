   @extends('front.layouts.app')
 @section('content')
    <section class="fxt-template-animation fxt-template-layout2 blue-back">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-6 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <a href="login.html" class="fxt-logo"><img src="{{url('public/login/img/Logo.png')}}" alt="Logo"></a>
                            <div class="fxt-style-line">    
                                <h2>Forgot Password</h2> 
                            </div>
                        </div>
                        <div class="fxt-form">                               
                            <form method="POST" action="" id="forgot_password" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">                                                
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">                                                
                                        <input type="text" class="form-control" name="email" placeholder="Email Address/Contact No." >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <button type="submit" class="fxt-btn-fill">Reset My Password</button>
                                    </div>
                                </div>
                            </form>                   
                        </div> 
                        <!--<div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-5">
                                <p>Don't have an account?<a href="register.html" class="switcher-text">Register</a></p>
                            </div>                             
                        </div> -->                            
                    </div>
                </div>
                <div class="col-lg-6 col-12 fxt-none-991 fxt-bg-img" data-bg-image="{{url('public/login/img/bg5.jpg')}}"></div>
            </div>
        </div>
    </section>
    @endsection
     @push('scripts')
 
<script src="{{url('public/dist/front.js') }}"></script>

@endpush