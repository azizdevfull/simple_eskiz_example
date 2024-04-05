<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSmsController extends Controller
{
    public function sendSms(Request $request)
    {
        // Log::info($request);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])->post('notify.eskiz.uz/api/message/sms/send', [
            'mobile_phone' => $request->phone,
            'message' => $request->msg,
            'from' => '4546',
        ]);

        return $response->json();
    }

    public function getToken()
    {
        $token = Cache::get('eskiz_api_token');
        if (!$token) {
            $response = Http::post('notify.eskiz.uz/api/auth/login', [
                'email' => config('eskiz.eskiz_email'),
                'password' => config('eskiz.eskiz_password'),
            ]);
            $token = $response['data']['token'];

            Cache::put('eskiz_api_token', $token, now()->addDays(30));
        }

        return $token;
    }
}
