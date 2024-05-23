<?php

namespace App\Repositories\EdenAI;

use App\Interfaces\Moderation\ModerationRepositoryInterface;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class EdenAIRepository implements ModerationRepositoryInterface
{
    public function textModeration(string $text)
    {
        $url = config('app.eden_ai_api_url') . '/text/moderation';

        $data = [
            'response_as_dict' => true,
            'attributes_as_list' => false,
            'show_original_response' => false,
            'providers' => ['openai'],
            'text' => $text,
        ];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('app.eden_ai_api_key'),
            'Content-Type' => 'application/json',
        ];

        $response = resolve(Client::class)->request('POST', $url, [
            'json' => $data,
            'headers' => $headers,
        ]);

        return $response;
    }

    public function detectExplicitContentInVideoFileAsync($videoFile, string $webhookUri)
    {
        $client = new Client();

        $formData = [
            [
                'name' => 'providers',
                'contents' => 'google',
            ],
            [
                'name' => 'webhook_receiver',
                'contents' => $webhookUri
            ],
            [
                'name' => 'file',
                'contents' => $videoFile,
            ]
        ];

        // Create a MultipartStream to send the form data
        $multipartStream = new MultipartStream($formData);

        $request = new Request(
            'POST',
            'https://api.edenai.run/v2/video/explicit_content_detection_async',
            [
                'Authorization' => 'Bearer ' . config('app.eden_ai_api_key'),
                'Content-Type' => 'multipart/form-data; boundary=' . $multipartStream->getBoundary(),
            ],
            $multipartStream
        );

        return $client->send($request);
    }

}