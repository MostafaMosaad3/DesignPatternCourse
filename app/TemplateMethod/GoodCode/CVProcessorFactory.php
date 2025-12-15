<?php

namespace App\TemplateMethod\GoodCode;

use App\TemplateMethod\GoodCode\ConcreteClasses\DocxCVReportGenerator;
use App\TemplateMethod\GoodCode\ConcreteClasses\ImageCVReportGenerator;
use App\TemplateMethod\GoodCode\ConcreteClasses\PdfCVReportGenerator;
use App\TemplateMethod\GoodCode\Services\CVReportGenerator;

class CVProcessorFactory
{
    public static function make(string $extension): CVReportGenerator
    {
        return match($extension) {
            'pdf' => new PdfCVReportGenerator(),
            'docx', 'doc' => new DocxCVReportGenerator(),
            'jpg', 'jpeg', 'png' => new ImageCVReportGenerator(),
            default => throw new \Exception("Format not supported")
        };
    }
}
