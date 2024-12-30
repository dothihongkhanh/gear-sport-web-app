<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiAPIService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('API_AI_URL');
        $this->apiKey = env('GOOGLE_API_KEY');
    }

    public function analyzeResults($conversationHistory)
    {
        $prompt = "Tôi có một website chuyên về kinh doanh phụ kiện thể thao FitSmart.
        Bạn là trợ lý ảo tư vấn cá nhân hóa kế hoạch tập luyện. 
        Hãy trả lời các câu hỏi của khách hàng để đưa ra 1 kế hoạch tập luyện phù hợp nhất.
        Bạn hãy yêu cầu khác hàng đưa ra các thông tin: giới tính, tuổi, chiều cao, cân nặng, mục tiêu tập luyện
        để dựa vào đó đưa ra loại hình tập luyện, tư vấn chính xác nhất. Chỉ được phép hỏi những câu hỏi trên, không được đưa ra câu hỏi khác.
        Dựa trên lịch sử hội thoại dưới đây, hãy đưa ra câu trả lời phù hợp nhất:\n";

        foreach ($conversationHistory as $entry) {
            $role = $entry['role'] === 'user' ? 'Người dùng' : 'Trợ lý';
            $prompt .= "{$role}: {$entry['content']}\n";
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . '?key=' . $this->apiKey, [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ],
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return $data['candidates'][0]['content']['parts'][0]['text'];
            } else {
                throw new \Exception('Phản hồi từ API không hợp lệ.');
            }
        } else {
            throw new \Exception('API request failed: ' . $response->body());
        }
    }
}
