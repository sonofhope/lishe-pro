<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Pesapal\pesapalCheckStatus;
use App\Pesapal\OAuthSignatureMethod_HMAC_SHA1;
use App\Pesapal\OAuthConsumer;
use App\Pesapal\OAuthRequest;

class ShoppingController extends Controller
{
    //returning shoppers who didn't fully register, all have no password, provider and provider_id

    public function index()
    {
        return view ('shop.shop');
    }

    public function cart()
    {
        return view ('shop.cart');
    }

    public function iframe(Request $request)
    {

        //pesapal params
        $token = $params = NULL;
        $consumer_key 		= env('PESA_KEY');
        $consumer_secret 	= env('PESA_SECRET');

        $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
        $iframelink = 'https://www.pesapal.com/api/PostPesapalDirectOrderV4';

        //get form details
        $amount = number_format($request->amount, 2);
        $currency = $request->currency;
        $desc = $request->description;
        $type = $request->type;
        $reference = $request->reference;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phonenumber = $request->phone;

        $callback_url = 'https://chakula-pro.herokuapp.com/status'; //redirect url, the page that will handle the response from pesapal.

        //storing into the database
        Transaction::make($first_name, $last_name, $email, $amount, $currency, $desc, $reference, $phonenumber);

        $post_xml	= "<?xml version=\"1.0\" encoding=\"utf-8\"?>
				   <PesapalDirectOrderInfo 
						xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
					  	xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" 
					  	Currency=\"".$currency."\" 
					  	Amount=\"".$amount."\" 
					  	Description=\"".$desc."\" 
					  	Type=\"".$type."\" 
					  	Reference=\"".$reference."\" 
					  	FirstName=\"".$first_name."\" 
					  	LastName=\"".$last_name."\" 
					  	Email=\"".$email."\" 
					  	PhoneNumber=\"".$phonenumber."\" 
					  	xmlns=\"http://www.pesapal.com\" />";
        $post_xml = htmlentities($post_xml);

        $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

        //post transaction to pesapal
        $iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
        $iframe_src->set_parameter("oauth_callback", $callback_url);
        $iframe_src->set_parameter("pesapal_request_data", $post_xml);
        $iframe_src->sign_request($signature_method, $consumer, $token);

        return view ('shop.iframe', compact('iframe_src'));
    }

    public function status()
    {
        $pesapalMerchantReference	= null;
        $pesapalTrackingId 		    = null;
        $checkStatus 				= new pesapalCheckStatus();

        if(isset($_GET['pesapal_merchant_reference']))
            $pesapalMerchantReference = $_GET['pesapal_merchant_reference'];

        if(isset($_GET['pesapal_transaction_tracking_id']))
            $pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];

        $status = $checkStatus->checkStatusUsingTrackingIdandMerchantRef($pesapalMerchantReference,$pesapalTrackingId);

        return view ('shop.status', compact('pesapalMerchantReference', 'pesapalTrackingId', 'status'));
    }
}
