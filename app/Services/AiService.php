<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiService
{
    public function generateCompanionJson(string $prompt): string
    {
        $response = Http::timeout(60)->post('http://ollama:11434/api/generate', [
            'model' => 'llama3',
            'prompt' => "Generate a Bitfocus Companion JSON button config for this request:\n\n{$prompt}",
            'stream' => false,
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to communicate with AI service.');
        }

        return trim($response->json('response') ?? 'No response.');
    }
}
