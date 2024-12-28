<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\GeminiAPIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $aiAnalysisService;

    public function __construct(GeminiAPIService $aiAnalysisService)
    {
        $this->aiAnalysisService = $aiAnalysisService;
    }

    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        try {
            $analysis = $this->aiAnalysisService->analyzeResults([
                ['text' => $userMessage]
            ]);

            if (isset($analysis['candidates'][0]['content']['parts'][0]['text'])) {
                $aiResponse = $analysis['candidates'][0]['content']['parts'][0]['text'];
            } else {
                $aiResponse = 'Có lỗi trong quá trình phân tích. Vui lòng thử lại!';
            }

            return response()->json([
                'status' => 'success',
                'response' => $aiResponse
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }
}
