@foreach($productQueries as $key=>$product_query)
            <div class="accordion" id="search-question">
                <div class="card">
                    <div class="card-header" style="padding:0px" id="heading_{{$key}}">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{$key}}">
                                <i class="fa fa-plus"></i> {!! \Illuminate\Support\Str::words($product_query->question,30,'....')  !!}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse_{{$key}}" class="collapse" aria-labelledby="heading_{{$key}}" data-parent="#search-question">
                      <div class="card-body">
                        <strong> Asked by: <a href="{{ route('user.feedback', encrypt($product_query->customer->id)) }}">{{$product_query->user->name}} </a> on {{Carbon\Carbon::parse($product_query->created_at)->format('d-m-Y @ H:i:s')}}  </strong>
                            <p> {{$product_query->question}}  </p>
                                            <strong> Replied by:  <a href="{{ route('shop.visit', $product_query->user->shop->slug) }}">{{$product_query->user->name}}</a> </strong>
                                                <strong> on {{Carbon\Carbon::parse($product_query->updated_at)->format('d-m-Y @ H:i:s')}} </strong>
                            <p>{{$product_query->replay!=null?$product_query->replay:'No reply available yet'}}</p>
                        </div>
                    </div>
                </div>
                </div>
        @endforeach
