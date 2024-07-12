<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentsService
{
    private $paymongoBaseUrl = 'https://api.paymongo.com/v1/links';

    private function headerAuthToken() {
        $publicKey = env('PAYMONGO_PUBLIC_KEY');
        $secretKey = env('PAYMONGO_SECRET_KEY');

        $token = base64_encode($secretKey.':'.$publicKey);

        return $token;
    }

    public function createPayment()
    {
        $response = Http::withHeaders(
            [
                'accept'        => 'application/json',
                'content-type'  => 'application/json',
                'authorization' => 'Basic '.$this->headerAuthToken()
            ]
        )->post(
            $this->paymongoBaseUrl,
            [
                'data' => [
                    'attributes' => [
                        'amount'        => 20000,
                        'description'   => 'Test payment',
                        'remarks'       => 'remarks'
                    ]
                ]
            ]
        );

        return json_decode($response->body());
    }

    public function getPaymentsByUser()
    {
        //
    }

    public function getPayment()
    {
        //
    }

    public function getPaymentByReferenceNo()
    {
        //
    }
}
