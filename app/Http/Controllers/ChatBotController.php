<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatBotController extends Controller
{
    public function getResponse(Request $request)
    {
        $client = new Client();

        $apiKey = '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';
        $userMessage = $request->input('message');

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $apiKey",
                ],
                'json' => [
                    'model' => 'gpt-4o-mini',
                    'store' => true,
                    'messages' => [
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json([
                'reply' => $data['choices'][0]['message']['content'] ?? 'Sin respuesta',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al conectar con la API: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function ir (){
        return view('chatbot.principal');
    }
}

