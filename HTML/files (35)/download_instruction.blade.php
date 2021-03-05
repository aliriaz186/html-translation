<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">

<style>
.ml-bl{margin-left: -15px;border-left: 10px solid white;}
.fs1r{font-size:1rem;}
.w-48{width:48%;}
.m-l-a{margin-left: auto}
.modal-address{
border: 1px dashed;
    padding-left: 14px;
    width: 44%;
    margin-left: 28%;
}
.m-l-37{margin-left: 37%}
.w-ms-60{max-width: 60%;}
#scissors {
    height: 43px;
    width: 90%;
    margin: auto auto;
    background-image: url(http://i.stack.imgur.com/cXciH.png);
    background-repeat: no-repeat;
    background-position: right;
    position: relative;
}

#scissors div {
  border-bottom: 3px dashed black;
    padding-top: 19px;
    margin-top:25px;
}
</style>

</head>
<body>
	<div style="margin-left:auto;margin-right:auto;">
	@php $returnAddress = json_decode($RA->address); @endphp
<div class="" style="display:block" id="downloadReturnAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="" id="modal-size" role="document">
        <div class="modal-content position-relative">
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="modal-address">
                        <h4>Return Address</h4>
                           <div id="name">{{$returnAddress->name}}</div>
                           <div id="address">{{$returnAddress->address}}</div>
                           <div id="address2">{{$returnAddress->address2}}</div>
                           <div id="city">{{$returnAddress->city}}</div>
                           <div id="postal_code">{{$returnAddress->postal_code}}</div>
                           <div id="country">{{$returnAddress->country}}</div>
                           <div id="phone">{{$returnAddress->phone}}</div>
                    </div>
                    <div id="scissors">
                      <div></div>
                    </div>
		            <div class="row">
                        <div class="col-lg-12 text-center" style="text-align: center;">
                            <div class="form-group" >
                               <p> ORDER RETURN ID: <strong class="font-weight-bold" > {{$code}}</strong> </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 mr-3 ml-3 p-4 w-mo-50">
                            <div class="form-group">
                                <h3 class="modal-title strong-600 heading-5">Seller Instructions</h3>           
                               <p id="seller_instruction" > {{$RA->seller_instruction}}  </p>
                            </div>
                        </div>
                    </div>
                    @if(App\AdminInstructionStore::first())
                    <div class="row">
                        <div class="col-lg-12 mr-3 ml-3 pb-4 w-mo-50">
                            <div class="form-group">
                              <h3 class="modal-title strong-600 heading-5">Additional Instructions</h3>       
                             <p >  {!! App\AdminInstructionStore::first()->Instruction !!} </p>
                              </div>
                        </div>
                    </div>
		   @endif
                </div>
        </div>
    </div>
</div>             
</div>
</body>
</html>