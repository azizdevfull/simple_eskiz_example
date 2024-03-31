<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendSmsController extends Controller
{

    public function sendSms()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])->post('notify.eskiz.uz/api/message/sms/send', [
            'mobile_phone' => '998991903704',
            'message' => 'Azizdev',
            'from' => '4546',
            'callback_url' => '',
        ]);

        return $response->json();
    }

    public function getToken()
    {
        $response = Http::post('notify.eskiz.uz/api/auth/login', [
            'email' => config('eskiz.eskiz_email'),
            'password' => config('eskiz.eskiz_password'),
        ]);

        return $response['data']['token'];
    }
}
