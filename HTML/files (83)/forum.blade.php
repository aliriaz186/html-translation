@extends('layouts.app')
@section('content')
<br>
@php $AdvertismentForum = App\AdvertismentForum::first(); @endphp
<div class="panel">
   <form action="{{ action('adsController@storeForum') }}" method="POST" >
      @csrf
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Ad Space Forum') }}</h3>
      </div>
      <div class="panel-body">
        @if(permission_check_all('advertisment_dashboards') || permission_check_put('advertisment_forum') || permission_check_post('advertisment_forum')  || permission_check_delete('advertisment_forum') )
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
                      <div class="forum-group">
                        <textarea placeholder="200 x 200" class="form-control editor w-100" name="firstAdvertisment">@if(isset($AdvertismentForum->firstAdvertisment)) {{$AdvertismentForum->firstAdvertisment}} @endif </textarea>
                        </div>
                  </td>
               </tr>
               <input type="hidden" name="id" value="{{$id}}">
               <tr>
                  <td>1</td>
                  <td>200 x 200 </td>
                  <td>
                     <div class="form-group" style="width:100%">
                        <textarea placeholder="200 x 200" class="form-control editor" name="secondAdvertisment">@if(isset($AdvertismentForum->secondAdvertisment)) {{$AdvertismentForum->secondAdvertisment}} @endif</textarea>
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

