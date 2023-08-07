<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Listing;
use App\Models\User;
use Session; 
use Hash;
use Auth;
use Mail;
use Stripe\StripeClient;
use DB;

class checkoutController extends Controller
{
    public function __construct(StripeClient $client)
    {
        $this->Client = $client;
    }

     public function goCheckout(Request $request)
    {
      $listing=$request->listing_id;

      $base_price=$request->price;
      $price = round( $base_price+($base_price*0.07),2 );
      //$ids=Crypt::decryptString($ids);
      
        return view('checkout.stripe',compact('price','listing'));
    }


    public function stripePost(Request $request)
    {
    $amount = $request->value;
 
        //STRIPE
         $curr='USD'; //$request->currency; 
         $price=round($request->price);

        Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');
        Stripe\Charge::create ([ 

                //"billing_address_collection": null,
                "amount" => $price*100, //100 * 100,
                "currency" => $curr,
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose only!"
        ]);

    User::Create([
        'investment_needed' => $old_amount-$amount,
        'share' => $old_share-$new_share
    ]); 


       Session::put('Stripe_pay','Invest request sent successfully!');
       return redirect("/");

    }


//Connect Functions

// Onboarding / Connect to stripe 
 public function connect($id) {
    $seller = User::where('id',15)->first();
    if(!$seller->completed_onboarding){
        $token = uniqid();
        DB::table('users')->where('id',15)->update(['token'=>$token]);
    }

   if(!$seller->connect_id){
    $account = $this->Client->accounts->create([
                'country' => 'us',
                'type' => 'express',
                'settings' => [
                  'payouts' => [
                    'schedule' => [
                      'interval' => 'manual',
                    ],
                  ],
                ],
              ]);
              
$account_id=$account['id']; 
DB::table('users')->where('id',15)->update(['connect_id'=>$account_id]);

$account_links = $this->Client->accountLinks->create([
              'account' => $account_id,
              'refresh_url' => route('connect.stripe',['id'=>15]),
              'return_url' => route('return.stripe',['token'=>$token]),
              'type' => 'account_onboarding',
            ]);
    return redirect($account_links->url);
    }

    $login_link = $this->Client->accounts->createLoginLink($seller->connect_id);
    return redirect($login_link->url);
//echo '<pre>'; print_r($account_links); echo '<pre>';
}


//After return 
public function saveStripe($token) {
    $seller = User::where('token',$token)->first();
    if($seller){
        DB::table('users')->where('id',15)
        ->update(['completed_onboarding'=>1]);
    }
    return redirect('home');
 }


// ACCEPTING PAYMENT
public function make_payment() {
\Stripe\Stripe::setApiKey('sk_test_51JFWrpJkjwNxIm6zcIxSq9meJlasHB3MpxJYepYx1RuQnVYpk0zmoXSXz22qS62PK5pryX4ptYGCHaudKePMfGyH00sO7Jwion');


$session = \Stripe\Checkout\Session::create([
  'line_items' => [[
  'currency'=>'usd',
  'amount'=>10000,
  'name'=>'Test person',
    //'price' => 'price_1KGhMt225jfF0VNwAZc9rmrH',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => route('split'),
  'cancel_url' => route('home'),
  //'payment_intent_data' => ['application_fee_amount' => 8000,
  //'transfer_data' => ['destination' => $seller->connect_id ],],
]);

//echo '<pre>'; print_r($session); echo '<pre>';exit;

$charge_id = $session['payment_intent'];
DB::table('users')->where('id',15)
        ->update(['charge_id'=>$charge_id]);
$url= $session['url'];
echo "<script>window.location.href = '$url' </script>";

} 
// ACCEPTING PAYMENT


// Create a Transfer to a connected 
public function split() {
//retrive
    $user = User::where('id',15)->first();
     $charge = $this->Client->paymentIntents->retrieve($user->charge_id, [] );
     //echo '<pre>'; echo $charge->latest_charge; echo '<pre>';exit;

$transfer = $this->Client->transfers->create([
  'amount' => 8000,
  'currency' => 'usd',
  'source_transaction' => $charge->latest_charge,
  'destination' => $user->connect_id,
  
]);
return redirect('home');
//echo '<pre>'; print_r($transfer); echo '<pre>';
}
// Create a Transfer to a connected 


//RETRIEVE CHARGE 
public function retrive(){
$charge = $this->Client->accounts->retrieve(
  'acct_1Nc5wRQqPhYbzKKC',
  []
);
echo '<pre>'; print_r($charge); echo '<pre>';


}
//RETRIEVE CHARGE 


// REFUND
public function refund() { 
//retrive
    $user = User::where('id',15)->first();
    //$charge = $this->Client->paymentIntents->retrieve($user->charge_id, [] );
  $this->Client->refunds->create(['payment_intent' => $user->charge_id ]);
  return redirect('home');
}
// REFUND



//Account Balance
public function acc_balance(){
$balance_acc=$this->Client->balance->retrieve();
//echo '<pre>'; print_r($balance_acc); echo '<pre>';exit;
$info = "Jitume Account= = ". (($balance_acc->pending[1]->amount)/100).' USD';
$user = User::where('id',15)->first();
return view('home',compact('user', 'info'));
}
//Account Balance


// Connected account holder's balance
public function con_acc_balance(){
$user = User::where('id',15)->first();

$balance= $this->Client->balance->retrieve(null,['stripe_account'=>$user->connect_id])->pending[0]->amount;
//echo '<pre>'; print_r($balance); echo '<pre>';exit;
$info = "John's Account= = ". (float)($balance/100).' USD';
return view('home',compact('user', 'info'));
}
// Connected account holder's balance


    
}
