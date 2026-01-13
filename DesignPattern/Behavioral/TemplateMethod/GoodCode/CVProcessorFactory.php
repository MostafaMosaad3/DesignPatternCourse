<?php

namespace DesignPattern\TemplateMethod\GoodCode;

use DesignPattern\TemplateMethod\GoodCode\ConcreteClasses\DocxCVReportGenerator;
use DesignPattern\TemplateMethod\GoodCode\ConcreteClasses\ImageCVReportGenerator;
use DesignPattern\TemplateMethod\GoodCode\ConcreteClasses\PdfCVReportGenerator;
use DesignPattern\TemplateMethod\GoodCode\Services\CVReportGenerator;

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
