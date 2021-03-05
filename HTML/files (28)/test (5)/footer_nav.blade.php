

<div class="footer-menu row p-3 d-lg-none no-print">
    @auth
        <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center">
            <a href="{{ route('dashboard') }}"> <i class="la la-dashboard"></i> </a>
        </div>
        @else
        <div class="col-lg-1 col-md-1 col-sm-1 col-xl-1 col-1">
            &nbsp;
        </div>
    @endauth
    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center">
        <a href="{{ route('home') }}"> <i class="la la-home"></i> </a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center category_icon">
        <a onclick="openNav()" > <i class="la la-list-alt"></i> </a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center">
        <div class="nav-search-box">
            <a href="#" class="nav-box-link"> <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i> </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center">
        <a href="{{ route('cart') }}"> <i class="la la-shopping-cart"></i> </a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xl-2 col-2 text-center">
        <a href=""> <i class="la la-bell"></i> </a>
    </div>

</div>

<div id="mySidenav" class="sidenav d-lg-none" >
    <div class="side-menu-header ">
        <div class="side-menu-close" onclick="closeNav()">
            <i class="la la-close"></i>
        </div>

        @auth
            <div class="widget-profile-box px-3 py-4 d-flex align-items-center">

                @if (Auth::user()->avatar_original != null)
                    <div class="image " style="background-image:url('{{ asset(Auth::user()->avatar_original) }}')"></div>
                @else
                    <div class="image " style="background-image:url('{{ asset('frontend/images/user.png') }}')"></div>
                @endif

                <div class="name">{{ Auth::user()->name }}</div>
            </div>
            <div class="side-login px-3 pb-3">
                <a href="{{ route('logout') }}">{{__('Sign Out')}}</a>
            </div>
        @else
            <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                    <div class="image " style="background-image:url('{{ asset('frontend/images/icons/user-placeholder.jpg') }}')"></div>
            </div>
            <div class="side-login px-3 pb-3">
                <a href="{{ route('user.login') }}">{{__('Sign In')}}</a>
                <a href="{{ route('user.registration') }}">{{__('Registration')}}</a>
            </div>
        @endauth
    </div>

    <h5 class="pr-3">Categories</h5>
    <ul id="myUL mt-4 " class="tree category_nav">
        @foreach(App\Category::all() as $category)
            <li>
                <span class="caret">
                    <a href="{{ route('products.category', $category->slug) }}" >{{ $category->name }}</a>
                </span>
                @if(count($category->subcategories))
                <ul class="nested">
                    @foreach($category->subcategories->take(10) as $subcategories)
                        <li>
                            <span class="caret"><a href="{{ route('products.subcategory', $subcategories->slug) }}">{{ $subcategories->name }}</a></span>
                            @if(count($subcategories->subsubcategories))
                            <ul class="nested">
                                @foreach($subcategories->subsubcategories->take(10) as $ssb)
                                    <li>
                                        <a href="{{ route('products.subsubcategory', $ssb->slug) }}">{{ $ssb->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                                @endif
                        </li>
                    @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
  </div>


  <script>
      /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.body.style.backgroundColor = "white";
}
  </script>
