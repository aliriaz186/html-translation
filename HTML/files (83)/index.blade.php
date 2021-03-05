@extends('layouts.app')
@section('content')
<br>
<div class="panel">
   <form action="{{ action('adsController@store') }}" method="POST" >
      @csrf
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Ad Space') }}</h3>
      </div>
      <div class="panel-body">
        @if(permission_check_all('ads') || permission_check_put('ads') || permission_check_post('ads')  || permission_check_delete('ads') )
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>name</th>
                  <th>{{__('Script')}}</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>970 x 90 </td>
                  <td>
                     <div class="form-group">
                        <textarea placeholder="970 x 90" class="form-control editor w-100" name="firstAd" >@if(isset(App\ads::first()->firstAd)){{App\ads::first()->firstAd}} @endif</textarea>
                    </div>
                  </td>
               </tr>
               <input type="hidden" name="id" value="{{$id}}">
               <tr>
                  <td>1</td>
                  <td>200 x 200 </td>
                  <td>
                     <div class="form-group">
                        <textarea placeholder="200 x 200" class="form-control editor w-100" name="secondAd">@if(isset(App\ads::first()->secondAd)){{App\ads::first()->secondAd}} @endif</textarea>
                    </div>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>200 x 600 </td>
                  <td>
                     <div class="form-group">
                        <textarea placeholder="200 x 600" class="form-control editor w-100" name="thirdAd">@if(isset(App\ads::first()->thirdAd)){{App\ads::first()->thirdAd}}@endif</textarea>
                    </div>
                  </td>
               </tr>
            </tbody>
         </table>
         @endif
         <div class="clearfix">
            <div class="pull-right">
               <input class="btn btn-primary " type="submit" value="send">
            </div>
         </div>
      </div>
    </form>
</div>
@endsection

