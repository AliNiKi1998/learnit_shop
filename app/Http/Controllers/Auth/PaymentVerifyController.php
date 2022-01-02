<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\UserCourse;
use System\Auth\Auth;

class PaymentVerifyController
{
    public function verify()
    {
        $MerchantID = 'b47f309d-6a81-4be7-993c-88c96754a607';

        $Authority = $_GET['Authority'];
        $amount = $_GET['amount'];
        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => $amount);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
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
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                
                $cartInputs = [];
                $cartInputs['user_id'] = Auth::user()->id;
                $cartInputs['price'] = $amount;
                $cartInputs['authority'] = $Authority;
                $cartInputs['ref_id'] = $result['RefID'];
                Cart::create($cartInputs);
                var_dump($cartInputs);
                $courses = UserCourse::where('user_id', $cartInputs['user_id'])->whereNull('payment_code')->get();
                $inputs = [];
                foreach ($courses as $course) {
                    $inputs['id'] = $course->id;
                    $inputs['payment_code'] = $Authority;
                    UserCourse::update($inputs);
                }
                echo "پرداخت با موفقیت انجام شد";
                echo '<a href="'.route('home.user.show').'">انتقال به سایت پذیرنده</a>';
            } else {
                echo 'Transation failed. Status:' . $result['Status'];
            }
        }
    }
}
