<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    public function index()
    {
        return view('generate');
    }

    public function generate(Request $request, AiService $ai)
    {
        $request->validate(['prompt' => 'required|string']);

        $prompt = $request->input('prompt');
        $jsonOutput = $ai->generateCompanionJson($prompt);
        $explanation = 'This is a generated Companion config based on your request.';

        // Log it to the DB
        Prompt::create([
            'user_id' => Auth::id(),
            'prompt_text' => $prompt,
            'json_output' => $jsonOutput,
            'explanation' => $explanation,
        ]);

        return view('generate', compact('prompt', 'jsonOutput', 'explanation'));
    }
}
