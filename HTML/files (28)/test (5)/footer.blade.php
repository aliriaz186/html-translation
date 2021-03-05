
<!-- FOOTER -->
<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                @php
                    $generalsetting = \App\GeneralSetting::first();
                @endphp
                <div class="col-lg-5 col-xl-4 text-center text-md-left">
                    <div class="col">
                        <a href="{{ route('home') }}" class="d-block">
                            @if($generalsetting->logo != null)
                                <img loading="lazy"  src="{{ asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}" height="44">
                            @else
                                <img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                            @endif
                        </a>
                        <p class="mt-3">{{ $generalsetting->description }}</p>
                        <div class="d-inline-block d-md-block">
                            <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="{{__('Your Email Address')}}" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-base-1 btn-icon-left">
                                    {{__('Subscribe')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-xl-1 col-md-4 d-none d-lg-block">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Contact Info')}}
                        </h4>
                        <ul class="footer-links contact-widget">
                            <li>
                               <span class="d-none d-lg-block  opacity-5">{{__('Address')}}:</span>
                               <span class="d-none d-lg-block">{{ $generalsetting->address }}</span>
                            </li>
                            <li>
                               <span class="d-none d-lg-block opacity-5">{{__('Phone')}}:</span>
                               <span class="d-none d-lg-block">{{ $generalsetting->phone }}</span>
                            </li>
                            <li>
                               <span class="d-none d-lg-block opacity-5">{{__('Email')}}:</span>
                               <span class="d-none d-lg-block">
                                   <a href="mailto:{{ $generalsetting->email }}">{{ $generalsetting->email  }}</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 offset-xl-1 d-lg-none mb-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none mb-0">
                        <a href="#">Contact Info</a>
                        <button type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none">
                          <i class="la la-plus"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link" href="#">Address :{{ $generalsetting->address }}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#"> Phone :{{ $generalsetting->phone }}<</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="mailto:{{ $generalsetting->email }}"> Email :{{ $generalsetting->email  }}</a>
                            </li>
                          </ul>
                        </div>
                      </nav>
                </div>


                <div class="col-lg-2 col-md-4  d-none d-lg-block">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Useful Link')}}
                        </h4>
                        <ul class="footer-links">
                            @foreach (\App\Link::all() as $key => $link)
                                <li>
                                    <a href="{{ $link->url }}" title="">
                                        {{ $link->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 offset-xl-1 d-lg-none mb-0 mt-2">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none mb-0">
                        <a href="#">Userfull Links</a>
                        <button type="button" data-toggle="collapse" data-target="#usefullLinks" aria-controls="usefullLinks" aria-expanded="false" aria-label="Toggle navigation" style="border: none">
                          <i class="la la-plus"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="usefullLinks">
                          <ul class="navbar-nav">
                            @foreach (\App\Link::all() as $key => $link)
                                <li class="nav-item">
                                    <a href="{{ $link->url }}" title="" class="nav-link">
                                        {{ $link->name }}
                                    </a>
                                </li>
                              @endforeach
                          </ul>
                        </div>
                      </nav>
                </div>

                @if(App\Link::count()>0)
                <div class="col-sm-12 offset-xl-1 d-lg-none mb-0">
                    <div class="col text-center text-md-left">
                        <div class="form-group">
                            <select name="" id="" class="form-control" onchange="openner(this)">
                                <option value="selected" selected>Useful Links</option>
                                @foreach (\App\Link::all() as $key => $link)
                               <option value="{{$link->url}}">
                                    {{ $link->name }}
                               </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-md-4 col-lg-2  d-none d-lg-block ">
                    <div class="col text-center text-md-left">
                       <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                          {{__('My Account')}}
                       </h4>

                       <ul class="footer-links">
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}" title="Logout">
                                        {{__('Logout')}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('user.login') }}" title="Login">
                                        {{__('Login')}}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('purchases.index') }}" title="Order History">
                                    {{__('Order History')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wishlists.index') }}" title="My Wishlist">
                                    {{__('My Wishlist')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders.track') }}" title="Track Order">
                                    {{__('Track Order')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                        <div class="col text-center text-md-left">
                            <div class="mt-4">
                                <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                                    {{__('Be a Seller')}}
                                </h4>
                                <a href="{{ route('shops.create') }}" class="btn btn-base-1 btn-icon-left">
                                    {{__('Apply Now')}}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="col-sm-12 offset-xl-1 d-lg-none mb-0 mt-2">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none mb-0">
                        <a href="#">My Account</a>
                        <button type="button" data-toggle="collapse" data-target="#myAccount" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none">
                          <i class="la la-plus"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="myAccount">
                          <ul class="navbar-nav">
                            @if (Auth::check())
                            <li class="nav-item">
                                <a href="{{ route('logout') }}"class="nav-link" title="Logout">
                                    {{__('Logout')}}
                                </a>
                            </li>
                        @else
                            <li  class="nav-item">
                                <a href="{{ route('user.login') }}"class="nav-link" title="Login">
                                    {{__('Login')}}
                                </a>
                            </li>
                        @endif
                        <li  class="nav-item">
                            <a href="{{ route('purchases.index') }}"class="nav-link" title="Order History">
                                {{__('Order History')}}
                            </a>
                        </li>
                        <li  class="nav-item">
                            <a href="{{ route('wishlists.index') }}"class="nav-link" title="My Wishlist">
                                {{__('My Wishlist')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.track') }}" class="nav-link" title="Track Order">
                                {{__('Track Order')}}
                            </a>
                        </li>
                          </ul>
                        </div>
                      </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 sct-color-3">
        <div class="container">
            <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
                <div class="col-md-4">
                    <div class="copyright text-center text-md-left">
                        <ul class="copy-links no-margin">
                            <li>
                                © {{ date('Y') }} {{ $generalsetting->site_name }}
                            </li>
                            <li>
                                <a href="{{ route('terms') }}">{{__('Terms')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('privacypolicy') }}">{{__('Privacy policy')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="text-center my-3 my-md-0 social-nav model-2">
                        @if ($generalsetting->facebook != null)
                            <li>
                                <a href="{{ $generalsetting->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->instagram != null)
                            <li>
                                <a href="{{ $generalsetting->instagram }}" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->twitter != null)
                            <li>
                                <a href="{{ $generalsetting->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->youtube != null)
                            <li>
                                <a href="{{ $generalsetting->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->google_plus != null)
                            <li>
                                <a href="{{ $generalsetting->google_plus }}" class="google-plus" target="_blank" data-toggle="tooltip" data-original-title="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="text-center text-md-right">
                        <ul class="inline-links">
                            @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="paypal" src="{{ asset('frontend/images/icons/cards/paypal.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="stripe" src="{{ asset('frontend/images/icons/cards/stripe.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="sslcommerz" src="{{ asset('frontend/images/icons/cards/sslcommerz.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="instamojo" src="{{ asset('frontend/images/icons/cards/instamojo.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="razorpay" src="{{ asset('frontend/images/icons/cards/rozarpay.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="paystack" src="{{ asset('frontend/images/icons/cards/paystack.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="cash on delivery" src="{{ asset('frontend/images/icons/cards/cod.png')}}" height="20">
                                </li>
                            @endif
                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                  <li>
                                    <img loading="lazy" alt="{{ $method->heading }}" src="{{ asset($method->photo)}}" height="20">
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


        <script>
            function openner(event){
                value = event.value;
                location.href=value;
            }

        </script>
