<?php

namespace App\TemplateMethod\GoodCode\ConcreteClasses;

use App\TemplateMethod\GoodCode\Services\CVReportGenerator;

class ImageCVReportGenerator extends CvReportGenerator
{
    protected function readFile(string $filePath): string
    {
        echo "📄 Reading Image...\n";
        return file_get_contents($filePath);
    }

    protected function extractData(string $content): array
    {
        echo "🔍 Extracting from Image (OCR)...\n";

        // Image-specific extraction logic (OCR)
        return [
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'experience' => '7 years',
            'skills' => ['Python', 'Django', 'PostgreSQL', 'AWS', 'Docker']
        ];
    }
}
