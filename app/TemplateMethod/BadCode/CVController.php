<?php

namespace App\TemplateMethod\BadCode;

use App\TemplateMethod\BadCode\Services\DocxCVProcessor;
use App\TemplateMethod\BadCode\Services\ImageCVProcessor;
use App\TemplateMethod\BadCode\Services\PdfCVProcessor;

class CVController
{
    public function processCV($request)
    {
        $file = $request->file('cv');
        $extension = $file->getClientOriginalExtension();
        $filePath = $file->store('cvs');

        // Ugly switch statement
        switch ($extension) {
            case 'pdf':
                $processor = new PdfCVProcessor();
                break;
            case 'docx':
            case 'doc':
                $processor = new DocxCVProcessor();
                break;
            case 'jpg':
            case 'jpeg':
            case 'png':
                $processor = new ImageCVProcessor();
                break;
            default:
                throw new \Exception("Unsupported file format");
        }

        $report = $processor->generateReport($filePath);

        return response()->json($report);
    }
}

/**
 * ============================================
 * PROBLEMS SUMMARY:
 * ============================================
 *
 * 1. CODE DUPLICATION:
 *    - Validation logic copied 3 times
 *    - Analysis logic copied 3 times
 *    - Report generation copied 3 times
 *    - If scoring algorithm changes, must update 3 places!
 *
 * 2. MAINTENANCE NIGHTMARE:
 *    - Want to change scoring? Update 3 classes
 *    - Want to add new field? Update 3 classes
 *    - Bug in validation? Fix in 3 places
 *    - High chance of inconsistency
 *
 * 3. SCALABILITY ISSUES:
 *    - Adding new format (e.g., TXT) requires:
 *      * Creating entire new class
 *      * Copying all common logic
 *      * Updating controller switch
 *      * More duplication!
 *
 * 4. TESTING DIFFICULTY:
 *    - Must test same logic 3 times
 *    - Changes require re-testing all classes
 *    - No guarantee of consistency
 *
 * 5. VIOLATION OF PRINCIPLES:
 *    - DRY (Don't Repeat Yourself)
 *    - Open/Closed Principle
 *    - Single Responsibility
 *
 * 6. INCONSISTENCY RISK:
 *    - Developer might forget to update one class
 *    - Different classes might have slightly different logic
 *    - No single source of truth
 *
 * ============================================
 * SOLUTION: USE TEMPLATE METHOD PATTERN!
 * ============================================
 *
 * See the GOOD CODE example for proper implementation
 */
