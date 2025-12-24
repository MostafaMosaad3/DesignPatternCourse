<?php

namespace DesignPattern\TemplateMethod\GoodCode\ConcreteClasses;

use DesignPattern\TemplateMethod\GoodCode\Services\CVReportGenerator;

class PdfCVReportGenerator extends CvReportGenerator
{
    protected function readFile(string $filePath): string
    {
        echo "📄 Reading PDF...\n";
        return file_get_contents($filePath);
    }

    protected function extractData(string $content): array
    {
        echo "🔍 Extracting from PDF...\n";

        // PDF-specific extraction logic
        return [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'experience' => '5 years',
            'skills' => ['PHP', 'Laravel', 'MySQL', 'Redis']
        ];
    }
}
