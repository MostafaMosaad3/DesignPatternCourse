<?php

namespace App\TemplateMethod\GoodCode;

class CVController
{
    public function upload($request)
    {
        // Get uploaded file
        $file = $request->file('cv');
        $path = $file->store('cvs');
        $extension = $file->getClientOriginalExtension();

        // Create processor using factory
        $processor = CVProcessorFactory::make($extension);

        // Generate report (same method for all formats!)
        $report = $processor->generateReport($path);

        return response()->json($report);
    }
}


/**
 * ============================================
 * HOW IT WORKS:
 * ============================================
 *
 * 1. CVReportGenerator (Abstract Class)
 *    - Defines the ALGORITHM (generateReport)
 *    - Has COMMON logic (validate, calculateScore, buildReport)
 *    - Has ABSTRACT methods (readFile, extractData)
 *
 * 2. Concrete Classes (PdfCV, DocxCV, ImageCV)
 *    - Extend CVReportGenerator
 *    - Implement ONLY the different parts (readFile, extractData)
 *    - INHERIT all common logic automatically
 *
 * 3. When you call generateReport():
 *    ┌─────────────────────────────┐
 *    │ CVReportGenerator           │
 *    │ generateReport() {          │
 *    │   1. readFile()      ◄──────┼─── Calls child's implementation
 *    │   2. extractData()   ◄──────┼─── Calls child's implementation
 *    │   3. validate()             │    Uses parent's code
 *    │   4. calculateScore()       │    Uses parent's code
 *    │   5. buildReport()          │    Uses parent's code
 *    │ }                           │
 *    └─────────────────────────────┘
 *
 * ============================================
 * WHY THIS IS BETTER:
 * ============================================
 *
 * ✅ ADDING NEW FORMAT (e.g., TXT):
 *
 * class TxtCVReportGenerator extends CVReportGenerator
 * {
 *     protected function readFile($path): string {
 *         return file_get_contents($path);
 *     }
 *
 *     protected function extractData($content): array {
 *         // TXT extraction logic
 *     }
 * }
 *
 * That's it! Only 10 lines of code!
 * validate(), calculateScore(), buildReport() are FREE!
 *
 * ✅ CHANGING SCORE ALGORITHM:
 *
 * Update calculateScore() in CVReportGenerator
 * ALL formats get the update automatically!
 *
 * ✅ ADDING NEW VALIDATION:
 *
 * Update validate() in CVReportGenerator
 * ALL formats get it automatically!
 *
 * ============================================
 * KEY POINTS:
 * ============================================
 *
 * 1. Parent defines STRUCTURE (the steps)
 * 2. Children define DETAILS (specific implementation)
 * 3. Common code written ONCE
 * 4. Easy to extend (just add new child class)
 * 5. Guaranteed consistency (all use same validate/score logic)
 */
