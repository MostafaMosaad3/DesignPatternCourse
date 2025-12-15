<?php

namespace App\TemplateMethod\BadCode\Services;

class ImageCVProcessor
{
    public function generateReport(string $filePath): array
    {
        echo "🔴 Processing Image CV...\n";

        // Step 1: Read file
        echo "📄 Reading Image file...\n";
        $fileContent = file_get_contents($filePath);
        if (!$fileContent) {
            throw new \Exception("Failed to read Image file");
        }

        // Step 2: Extract data from Image using OCR (different logic)
        echo "🔍 Extracting data from Image using OCR...\n";
        $data = [
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'phone' => '+5555555555',
            'experience' => '7 years',
            'skills' => ['Python', 'Django', 'PostgreSQL', 'AWS']
        ];

        // Step 3: Validate extracted data (DUPLICATED CODE AGAIN!)
        echo "✅ Validating data...\n";
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email");
        }
        if (empty($data['name'])) {
            throw new \Exception("Name is required");
        }

        // Step 4: Analyze data (DUPLICATED CODE AGAIN!)
        echo "📊 Analyzing CV data...\n";
        $score = 0;
        if (!empty($data['experience'])) $score += 30;
        if (!empty($data['skills']) && count($data['skills']) > 3) $score += 40;
        if (!empty($data['email'])) $score += 15;
        if (!empty($data['phone'])) $score += 15;

        // Step 5: Generate report (DUPLICATED CODE AGAIN!)
        echo "📝 Generating report...\n";
        $report = [
            'candidate' => $data['name'],
            'contact' => [
                'email' => $data['email'],
                'phone' => $data['phone']
            ],
            'qualifications' => [
                'experience' => $data['experience'],
                'skills' => $data['skills']
            ],
            'score' => $score,
            'recommendation' => $score >= 70 ? 'RECOMMENDED' : 'REVIEW NEEDED',
            'processed_at' => date('Y-m-d H:i:s'),
            'format' => 'IMAGE'
        ];

        echo "✅ Image Report generated successfully!\n\n";

        return $report;
    }
}
