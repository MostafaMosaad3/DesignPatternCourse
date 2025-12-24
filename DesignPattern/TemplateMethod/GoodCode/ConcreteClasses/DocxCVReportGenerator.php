<?php

namespace DesignPattern\TemplateMethod\GoodCode\ConcreteClasses;

use DesignPattern\TemplateMethod\GoodCode\Services\CVReportGenerator;

class DocxCVReportGenerator extends CvReportGenerator
{
    protected function readFile(string $filePath): string
    {
        echo "📄 Reading DOCX...\n";
        return file_get_contents($filePath);
    }

    protected function extractData(string $content): array
    {
        echo "🔍 Extracting from DOCX...\n";

        // DOCX-specific extraction logic
        return [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'experience' => '3 years',
            'skills' => ['JavaScript', 'React', 'Node.js']
        ];
    }
}
