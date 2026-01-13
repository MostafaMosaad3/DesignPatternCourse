<?php

namespace DesignPattern\TemplateMethod\BadCode\Services;

class DocxCVProcessor
{
    public function generateReport(string $filePath): array
    {
        echo "🔴 Processing DOCX CV...\n";

        // Step 1: Read file
        echo "📄 Reading DOCX file...\n";
        $fileContent = file_get_contents($filePath);
        if (!$fileContent) {
            throw new \Exception("Failed to read DOCX file");
        }

        // Step 2: Extract data from DOCX (different logic)
        echo "🔍 Extracting data from DOCX...\n";
        $data = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '+9876543210',
            'experience' => '3 years',
            'skills' => ['JavaScript', 'React', 'Node.js']
        ];

        // Step 3: Validate extracted data (DUPLICATED CODE!)
        echo "✅ Validating data...\n";
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email");
        }
        if (empty($data['name'])) {
            throw new \Exception("Name is required");
        }

        // Step 4: Analyze data (DUPLICATED CODE!)
        echo "📊 Analyzing CV data...\n";
        $score = 0;
        if (!empty($data['experience'])) $score += 30;
        if (!empty($data['skills']) && count($data['skills']) > 3) $score += 40;
        if (!empty($data['email'])) $score += 15;
        if (!empty($data['phone'])) $score += 15;

        // Step 5: Generate report (DUPLICATED CODE!)
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
            'format' => 'DOCX'
        ];

        echo "✅ DOCX Report generated successfully!\n\n";

        return $report;
    }
}
