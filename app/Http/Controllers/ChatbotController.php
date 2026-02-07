<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_history' => 'nullable|array'
        ]);

        $azureApiKey = config('services.azure_openai.api_key');
        $azureEndpoint = config('services.azure_openai.endpoint');
        $deploymentName = config('services.azure_openai.deployment_name');
        $apiVersion = config('services.azure_openai.api_version');
        $maxTokens = (int) config('services.azure_openai.max_tokens', 500);
        $temperature = (float) config('services.azure_openai.temperature', 0.7);

        if (!$azureApiKey || !$azureEndpoint) {
            return response()->json([
                'error' => 'Azure OpenAI configuration is missing'
            ], 500);
        }

        // Build conversation history
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are a helpful assistant for Lootraiders, a raffle and gaming platform. Provide clear, concise responses to help users with:
- Participating in raffles
- Purchasing ticket packages
- Completing tasks to earn tickets
- Checking raffle entries and winners
- Navigating the platform
- Understanding terms and conditions

Keep responses friendly but brief. Use simple formatting without markdown. If you don\'t know something specific, suggest contacting support.'
            ]
        ];

        // Add conversation history if provided
        if ($request->has('conversation_history') && is_array($request->conversation_history)) {
            $messages = array_merge($messages, $request->conversation_history);
        }

        // Add current user message
        $messages[] = [
            'role' => 'user',
            'content' => $request->message
        ];

        try {
            $url = rtrim($azureEndpoint, '/') . "/openai/deployments/{$deploymentName}/chat/completions?api-version={$apiVersion}";

            $response = Http::withHeaders([
                'api-key' => $azureApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, [
                'messages' => $messages,
                'max_completion_tokens' => $maxTokens,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $assistantMessage = $data['choices'][0]['message']['content'] ?? 'Sorry, I could not generate a response.';

                // Remove markdown bold formatting (**text**)
                $assistantMessage = preg_replace('/\*\*(.*?)\*\*/', '$1', $assistantMessage);

                return response()->json([
                    'message' => $assistantMessage,
                    'success' => true
                ]);
            } else {
                Log::error('Azure OpenAI API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'error' => 'Failed to get response from AI service',
                    'details' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while processing your request',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
