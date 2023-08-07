@extends('layout') 
@section('page') 



<div class="row h-100" style="background: #e5efef; min-height: 600px;">  
         <div class="col-md-12 w-75 mx-auto"> 
            <h3 class="text-center mt-3">Stripe Connect:</h3> <hr>



@if($user->completed_onboarding)
<div class="text-center my-4">
              <h5>User name: <b> {{$user->name}}</h5>
                <p class="px-2 d-inline-block m-auto text-center btn-success rounded">Connected</p>
            </div>

<div class="row w-75 m-auto text-center">
<div class="col-sm-3">
 
      <a href="{{route('acc_balance')}}" class="border py-1 border-dark rounded btn-light my-2" name="submit">Balance</a>
    </div>

  <div class="col-sm-3">
  <a href="{{route('con_acc_balance')}}" class="border py-1 border-dark rounded btn-light my-2" name="submit">Connected Acc. Balance</a></div>

  <div class="col-sm-3">
  <a href="{{route('make_payment')}}" class="border py-1 border-dark rounded btn-light my-2" name="submit">Make Payment to John</a></div>

  <div class="col-sm-3">
  <a href="{{route('refund')}}" class="border py-1 border-dark rounded btn-light my-2" name="submit">Refund</a></div>

    <p class="bg-light text-center w-75 mx-auto py-2 my-5">@if(isset($info)) {{$info}} @endif</p>
  </div>

  @else
  <div class="text-center my-3">
              <h5>User name: <b> {{$user->name}}</h5>
                <p class="px-2 d-inline-block m-auto text-center btn-success rounded">Not Connected</p>
            </div>

  <div class="row w-75 m-auto">
   <a href="{{route('connect.stripe',['id'=>15])}}" class="btn-light border border-dark w-25 m-auto rounded text-center py-1" >Connect to stripe</a>


    </div>
    @endif
         </div>  

        
</div>



          @endsection
        
       

