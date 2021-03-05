@extends('layouts.app')
@section('content')
<br>
@php $AdvertismentDashboard = App\AdvertismentDashboard::first(); @endphp
<div class="panel">
   <form action="{{ action('adsController@storeDashboard') }}" method="POST" >
      @csrf
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Ad Space Dashboard') }}</h3>
      </div>
      <div class="panel-body">
        @if(permission_check_all('advertisment_dashboards') || permission_check_put('advertisment_dashboards') || permission_check_post('advertisment_dashboards')  || permission_check_delete('advertisment_dashboards') )
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
                  <td>200 x 200 </td>
                  <td>
                     <div class="form-group">
                        <textarea placeholder="200 x 200" class="form-control editor w-100" name="firstAdvertisment" >@if(isset($AdvertismentDashboard->firstAdvertisment)) {{$AdvertismentDashboard->firstAdvertisment}} @endif</textarea>
                    </td>
               </tr>
               <input type="hidden" name="id" value="{{$id}}">
               <tr>
                  <td>1</td>
                  <td>970 x 90 </td>
                  <td>
                    <div class="form-group">
                        <textarea placeholder="970 x 90" cols="110" rows="10"  class="form-control editor w-100" name="secondAdvertisment" >@if(isset($AdvertismentDashboard->secondAdvertisment)) {{$AdvertismentDashboard->secondAdvertisment}}  @endif </textarea>
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