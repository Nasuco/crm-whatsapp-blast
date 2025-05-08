<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function uploadMedia($filePath)
    {
        $accessToken = config('app.wa_access_token');
        $phoneId = config('app.wa_phone_id');

        Log::info('Access token ' . $accessToken);
        Log::info('Phone ID ' . $phoneId);

        $url = "https://graph.facebook.com/v22.0/" . $phoneId . "/media";

        $response = Http::attach(
            'file', fopen(storage_path('app/public/' . $filePath), 'r'), basename($filePath)
        )->asMultipart()->withToken($accessToken)->post($url, [
            ['name' => 'messaging_product', 'contents' => 'whatsapp'],
        ]);

        return $response->json('id');
    }

    public function sendDocument($phone, $mediaId, $caption)
    {
        $accessToken = config('app.wa_access_token');
        $phoneId = config('app.wa_phone_id');

        Log::info('Access token ' . $accessToken);
        Log::info('Phone ID ' . $phoneId);

        return Http::withToken($accessToken)->post(
            'https://graph.facebook.com/v22.0/' . $phoneId . '/messages',
            [
                'messaging_product' => 'whatsapp',
                'to' => $phone,
                'type' => 'document',
                'document' => [
                    'id' => $mediaId,
                    'caption' => $caption,
                ]
            ]
        );
    }
}