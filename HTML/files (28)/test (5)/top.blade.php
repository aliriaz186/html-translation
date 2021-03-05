@php $TBN = App\TopBanner::where('status',1)->first(); @endphp
<div style="height: {{$TBN->height}}vh; background-color:{{$TBN->color}};padding-top:1% ">
    <p class="text-center">{!!$TBN->message!!}</p>
</div>
