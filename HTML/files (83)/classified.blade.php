@extends('layouts.app')
@section('content')
<br>
@php $AdvertisementClassified = App\AdvertisementClassified::first(); @endphp
<div class="panel">
   <form action="{{ action('adsController@storeClassified') }}" method="POST" >
      @csrf
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Ad Space Classified') }}</h3>
      </div>
      <div class="panel-body">
        @if(permission_check_all('advertisement_classifieds') || permission_check_put('advertisement_classifieds') || permission_check_post('advertisement_classifieds')  || permission_check_delete('advertisement_classifieds') )
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
                        <textarea placeholder="970 x 90" class="form-control editor w-100" name="firstAdvertisment" >@if(isset($AdvertisementClassified->firstAdvertisment)) {{$AdvertisementClassified->firstAdvertisment}} @endif</textarea>
                    </td>
               </tr>
               <input type="hidden" name="id" value="{{$id}}">
               <tr>
                  <td>1</td>
                  <td>970 x 90 </td>
                  <td>
                    <div class="form-group">
                        <textarea placeholder="970 x 90" cols="110" rows="10"  class="form-control editor w-100" name="secondAdvertisment" >@if(isset($AdvertisementClassified->secondAdvertisment)) {{$AdvertisementClassified->secondAdvertisment}}  @endif </textarea>
                  </td>
               </tr>
            </tbody>
            @endif
         </table>
         <div class="clearfix">
            <div class="pull-right">
               <input class="btn btn-primary " type="submit" value="send">
            </div>
         </div>
      </div>
    </form>

</div>
@endsection



@section('script')

@endsection
