<style>
    /*--CSS--*/
 .block {
    text-align: center;
    vertical-align: middle;
}
.circle {
    border-radius: 200px;
    color: white;
    height: 200px;
    font-weight: bold;
    width: 200px;
    display: table;
    margin: 20px auto;
}
.circle p {
    vertical-align: middle;
    display: table-cell;
}

.circle div{
    width: 100px;
    height: 100px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 21%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<section class="mb-4">
    <div class="container-fluid">
        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{__('Top Seller and Offer this week')}}</span>
                </h3>
            </div>
            <div class="row">
                @foreach (App\BannerCircle::where('status',1)->get() as $bannerCircle)
                <div class="col-md-2 block">
                  <a href="{{$bannerCircle->link}}" >
                    <div class="circle bg-primary">
                        <div style="background-image: url({{asset($bannerCircle->photo)}})"> </div>
                    </div>
                    <p class="font-weight-bold">{{$bannerCircle->title}}</p>
                
                </a>
                </div>
                @endforeach



            </div>
        </div>
    </div>
</section>
