<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\GeminiAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $conversationHistory = session('conversation_history', []);
        $conversationHistory[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $aiResponse = $this->aiAnalysisService->analyzeResults($conversationHistory);
            $conversationHistory[] = ['role' => 'assistant', 'content' => $aiResponse];
            session(['conversation_history' => $conversationHistory]);

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

    public function clearConversationHistory()
    {
        session()->forget('conversation_history');
        return response()->json([
            'status' => 'success',
            'message' => 'Lịch sử hội thoại đã được xóa!'
        ]);
    }

    public function getChatHistory()
    {
        $messages = session()->get('conversation_history', []);
        // Log::info('Chat history session:', $messages);

        return response()->json([
            'status' => 'success',
            'messages' => $messages
        ]);
    }
}
