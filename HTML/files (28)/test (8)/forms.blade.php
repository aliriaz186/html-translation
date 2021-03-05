    <div class="modal" id="addABrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('ADD A BRAND')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('addABrand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control text-center" placeholder="BRAND NAME">
                                </div>
                            </div>
                        </div>
                        <div class="info"  style="margin-bottom: 15px">
                            <a href="#" class="">
                                <i class="la la-info-circle"></i>
                                <span class="category-name">Logo must be 120 x 80px (jpg,jpeg & png only)</span>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <input type="file" name="logo" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                            <label for="file-2" class="mw-100 mb-3">
                                <span></span>
                                <strong>
                                    <i class="fa fa-upload"></i>
                                    {{__('Choose image')}}
                                </strong>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                        <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- ============================================================================================================ --}}
{{-- Submit Offers  --}}
<div class="modal" id="submitOffers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5"  style="margin-left: auto">{{__('SUBMIT OFFERS')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('submitOffers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="info"  style="margin-bottom: 15px">
                        <a class="">
                                <input type="checkbox" id="freeItemsCheckBox" name="createFree">
                            <span class="category-name">
                                <label for="freeItemsCheckBox" style="color:red">CREATE FREE ITEM NOT IN CATALOG</label></span>
                        </a>
                    </div>
                    <div class="form-group">
                        <select  name="selectGifts" id="" class="form-control disapper" style="text-align-last:center; ">
                            <option value="SELECT FREE GIFTS" selected>SELECT FREE GIFTS</option>
                            @foreach (\App\Product::where('user_id', Auth::user()->id)->get() as $product)
                                 <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="disapper" style="display: none">
                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="pr_name" placeholder="PRODUCT NAME" >
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <input type="number" class="form-control text-center" name="pr_qty" placeholder="QUANTITY" >
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control text-center" name="min_purchase" placeholder="MINIMUM PURCHASE" >
                    </div>
                    <div class="row disapper" style="margin-top:5px;display:none">
                        <div class="col-md-12">
                            <input type="file" name="logo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                            <label for="file-3" class="mw-100 mb-3 bg-white">
                                <span></span>
                                <strong>
                                    <i class="fa fa-upload"></i>
                                    {{__('Choose image')}}
                                </strong>
                            </label>
                        </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control text-center" name="pr_des">PRODUCT DESCRIPTION</textarea>
                                </div>
                            </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="date"placeholder="VALID FROM" name="valid_from" class="form-control text-center" >
                        </div>
                        <div class="col-lg-6">
                            <input type="date"placeholder="VALID UNTIL"  name="valid_until" class="form-control text-center">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- =========================================================================================================== --}}
{{-- make Suggestion  --}}
<div class="modal" id="makeSuggestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('MAKE A SUGGESTION')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('makeSuggestion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" name="title" placeholder="TITE" id="product-code-con" required >
                    </div>
                    <div class="form-group">
                        <textarea class="form-control editor" rows="8" name="message" required placeholder="ENTER YOUR SUGGESTION"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================================================================= --}}
{{-- Make coupons  --}}
<div class="modal" id="createCoupons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('CREATE COUPONS')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('createCoupons.store') }}" method="POST">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="price" placeholder="&pound; OFF">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="percent" placeholder="% OFF">
                            </div>
                        </div>
                    </div>
                    {{-- FIRST  --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="date" class="form-control text-center" name="valid_from" placeholder="VALID FROM">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="date" class="form-control text-center" name="valid_until" placeholder="VALID UNTIL">
                            </div>
                        </div>
                    </div>
                    {{-- SECOND  --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="sitewide" placeholder="SITEWIDE">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="min_order" placeholder="MINIMUM ORDER">
                            </div>
                        </div>
                    </div>
                    {{-- FULL  --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="selected_product" placeholder="SELECTED PRODUCT">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ========================================================================================================== --}}


<div class="modal" id="registerBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('REGISTER YOUR BRAND')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registerABrand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                        <div class="info"  style="margin-bottom: 15px">
                            <a href="http://localhost/shop/conversations" class="">
                                <i class="la la-info-circle"></i>
                                <span class="category-name">The information provided must be accurate.</span>
                            </a>
                        </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="firstname" placeholder="FIRSTNAME">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="lastname" placeholder="LASTNAME">
                            </div>
                        </div>
                    </div>
                    {{-- FIRST  --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="email" class="form-control text-center" name="email" placeholder="EMAIL ADDRESS">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="tel" class="form-control text-center" name="phoneNo" placeholder="PHONE NUMBER">
                            </div>
                        </div>
                    </div>
                    {{-- SECOND  --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="trademarkName" placeholder="TRADEMARK NAME">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="tel" class="form-control text-center" name="trademarkNumber" placeholder="TRADEMARK NUMBER">
                            </div>
                        </div>
                    </div>
                    {{-- THIRD  --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="countryOfRegistration" placeholder="COUNTRY OF REGISTRATION">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control text-center" name="trademarkUrl" placeholder="TRADEMARK URL">
                            </div>
                        </div>
                    </div>
                    {{-- FULL  --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="tel" class="form-control text-center" name="personOfContact" placeholder="PRIMARY PERSON OF CONTACT">
                            </div>
                        </div>
                    </div>
                    {{-- FIRST BELLOW  --}}
                           {{-- FIRST  --}}
                           <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" name="fullAddress" placeholder="FULL ADDRESS">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" name="WebsiteAddress" placeholder="WEBSITE ADDDRESS">
                                </div>
                            </div>
                        </div>
                        {{-- SECOND  --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="email" class="form-control text-center" name="primaryEmail" placeholder="PRIMARY EMAIL">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="tel" class="form-control text-center" name="MobileNumber" placeholder="MOBILE NUMBER">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer" style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </section>

    <script>
            $(document).ready(function () {
    $('#freeItemsCheckBox').change(function () {
      $('.disapper').fadeToggle();
    });
});
    </script>
