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

    public function analyzeResults($results)
    {
        $prompt = "Tôi có 1 website chuyên về kinh doanh phụ kiện thể thao FitSmart. Bạn là 1 trợ lý ảo tư chuyên
         về tư vấn cá nhân hóa kế hoạch tập luyện. Hãy trả lời các câu hỏi của khách hàng để đưa ra 1 kế hoạch tập
          luyện phù hợp nhất. Bạn hãy yêu cầu khác hàng đưa ra các thông tin: giới tính, tuổi, chiều cao, cân nặng, 
        loại hình tập luyện để dựa vào đó đưa ra tư vấn chính xác nhất. Chỉ hỏi những câu hỏi mà tôi đã đưa ra, không được đư đưa ra câu hỏi khác. \n";

        $userQuestion = $results[0]['text'];

        $prompt .= $userQuestion;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ],
            ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('API request failed: ' . $response->body());
        }
    }
}
