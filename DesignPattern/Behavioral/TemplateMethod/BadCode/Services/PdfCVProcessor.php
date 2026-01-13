<?php

namespace DesignPattern\TemplateMethod\BadCode\Services;

/**
 * PROBLEMS WITH THIS CODE:
 * ❌ Code duplication everywhere
 * ❌ Hard to maintain (change in many places)
 * ❌ No consistent structure
 * ❌ Adding new format requires copying entire logic
 * ❌ Common logic scattered across classes
 * ❌ High risk of bugs (forget to update one class)
 * ❌ Difficult to test
 * ❌ Violates DRY (Don't Repeat Yourself)
 */

class PdfCVProcessor
{
    // ============================================
    // PDF CV PROCESSOR
    // ============================================

    public function generateReport(string $filePath): array
    {
        echo "🔴 Processing PDF CV...\n";

        // Step 1: Read file
        echo "📄 Reading PDF file...\n";
        $fileContent = file_get_contents($filePath);
        if (!$fileContent) {
            throw new \Exception("Failed to read PDF file");
        }

        // Step 2: Extract data from PDF
        echo "🔍 Extracting data from PDF...\n";
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'experience' => '5 years',
            'skills' => ['PHP', 'Laravel', 'MySQL']
        ];

        // Step 3: Validate extracted data
        echo "✅ Validating data...\n";
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email");
        }
        if (empty($data['name'])) {
            throw new \Exception("Name is required");
        }

        // Step 4: Analyze data
        echo "📊 Analyzing CV data...\n";
        $score = 0;
        if (!empty($data['experience'])) $score += 30;
        if (!empty($data['skills']) && count($data['skills']) > 3) $score += 40;
        if (!empty($data['email'])) $score += 15;
        if (!empty($data['phone'])) $score += 15;

        // Step 5: Generate report
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
            'format' => 'PDF'
        ];

        echo "✅ PDF Report generated successfully!\n\n";

        return $report;
    }
}
