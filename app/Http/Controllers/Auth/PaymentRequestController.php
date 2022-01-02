<?php

namespace App\Http\Controllers\Auth;

use App\UserCourse;
use System\Auth\Auth;

class PaymentRequestController
{
    public function request($amount)
    {
        $data = array(
            'MerchantID' => 'b47f309d-6a81-4be7-993c-88c96754a607',
            'Amount' => $amount,
            'CallbackURL' => 'http://localhost:8000/payment/verify?amount='.$amount,
            'Description' => 'خرید تست'
        );

        $userCourses = UserCourse::where('user_id' , Auth::user()->id)->whereNull('payment_code')->get();
        $mainAmount = [];
        foreach($userCourses as $userCourse){
            array_push($mainAmount , $userCourse->price);
        }
        $mainAmount = array_sum($mainAmount);
       
        if($mainAmount != $amount){
            error('amount_invalid' , 'مبلغ پرداخت غیر مجاز می باشد');
            return back();
        }

        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                $array = ['Authority' => $result["Authority"]];
                $data['CallbackURL'] .= '&Authority='.$result["Authority"];
                
                header('Location:'. 'https://www.zarinpal.com/pg/StartPay/'. $result["Authority"]);                
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }
    }
}
