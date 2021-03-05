<div class="sidebar sidebar--style-3 no-border stickyfill p-0">
    <div class="widget mb-0">
        <div class="widget-profile-box text-center p-3">
                <img src="{{ asset('frontend/images/user.png') }}" class="image rounded-circle">
                @php @endphp
            <div class="name">{{Auth::user()->username }}</div>
        </div>
        <div class="sidebar-widget-title py-3">
            <span>{{__('API KEY')}}</span>
        </div>
        <div> 
          <p class="text-center" style="text-align: center;font-size: 12px; color: #a29d9d;">
            <input type="text" class="form-control" style="font-size: 12px;background: white;border: none;" readonly="true" value="{{Auth::user()->api_key}}" id="ApiPublicKey">
                     <button class="btn btn-block btn-primary mt-1" onclick="copyPublicKey()">Copy Api Key</button>
          </p>
        </div>
        <div class="sidebar-widget-title py-3">
            <span>{{__('Menu')}}</span>
        </div>
        <div class="widget-profile-menu py-3">
            <ul class="categories categories--style-3">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ areActiveRoutesHome(['dashboard'])}}">
                        <i class="la la-dashboard"></i>
                        <span class="category-name">
                            {{__('Dashboard')}}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('api.register-api') }}" class="{{ areActiveRoutesHome(['api.registerApi'])}}">
                        <i class="la la-registered"></i>
                        <span class="category-name">
                            {{__('Register API')}}
                        </span>
                    </a>
                </li>
                 <li>
                    <a href="{{ route('api.registered-api') }}" class="{{ areActiveRoutesHome(['api.registerApi'])}}">
                        <i class="la la-registered"></i>
                        <span class="category-name">
                            {{__('Registered API')}}
                        </span>
                    </a>
                </li>
                  <li>
                    <a href="{{ route('api.change-api') }}" class="{{ areActiveRoutesHome(['api.change-api'])}}">
                        <i class="la la-refresh"></i>
                        <span class="category-name">
                            {{__('Change API')}}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('api.list') }}" class="{{ areActiveRoutesHome(['api.list'])}}">
                        <i class="la la-list"></i>
                        <span class="category-name">
                            {{__('Api List')}}
                        </span>
                    </a>
                </li>

               <li>
                    <a href="{{ route('api.connected-users') }}" class="{{ areActiveRoutesHome(['api.connected-users'])}}">
                        <i class="la la-user"></i>
                        <span class="category-name">
                            {{__('Connected Users')}}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('api.update-api-profile') }}" class="{{ areActiveRoutesHome(['api.update-api-profile'])}}">
                        <i class="la la-user"></i>
                        <span class="category-name">
                            {{__('Manage Profile')}}
                        </span>
                    </a>
                </li>
                @php
                    $support_ticket = DB::table('tickets')
                                ->where('client_viewed', 0)
                                ->where('user_id', Auth::user()->id)
                                ->count();
                @endphp
                <li>
                    <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index'])}}">
                        <i class="la la-support"></i>
                        <span class="category-name">
                            {{__('Support Ticket')}} @if($support_ticket > 0)<span class="ml-2" style="color:green"><strong>({{ $support_ticket }} {{ __('New') }})</strong></span></span>@endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


@if(App\AdvertismentDashboard::first())
<div class="sidebar sidebar--style-3 no-border stickyfill p-0 mt-3">
    <div class="widget mb-0">
        {!! App\AdvertismentDashboard::first()->firstAdvertisment !!}
    </div>
</div>
@endif



@section('script')
<script>
  function copyPublicKey() {
  /* Get the text field */
  var copyText = document.getElementById("ApiPublicKey");

  
  copyText.select(); 
  
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  
  /* Alert the copied text */
  
    showFrontendAlert('success','Copied Key');
} 


</script>
@endsection