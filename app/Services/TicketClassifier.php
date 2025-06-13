<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class TicketClassifier
{
    protected array $categories = [
        'Billing',
        'Bug',
        'Feature Request',
        'General'
    ];

    public function classify(string $subject, string $body): array
    {
        if (!config('openai.classify_enabled')) {
            return $this->randomClassification();
        }

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are a ticket classification system. Analyze the following ticket and classify it into one of these categories: " . 
                                 implode(', ', $this->categories) . 
                                 ". Respond ONLY with the category name."
                ],
                [
                    'role' => 'user',
                    'content' => "Subject: $subject\n\nBody: $body"
                ]
            ],
            'temperature' => 0.0
        ]);

        $category = trim($response->choices[0]->message->content);
        $confidence = 1.0; // Simplified for this example

        if (!in_array($category, $this->categories)) {
            return $this->randomClassification();
        }

        return [
            'category' => $category,
            'confidence' => $confidence
        ];
    }

    protected function randomClassification(): array
    {
        return [
            'category' => $this->categories[array_rand($this->categories)],
            'confidence' => rand(0, 100) / 100
        ];
    }
}