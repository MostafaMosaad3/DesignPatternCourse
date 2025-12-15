<?php

namespace App\TemplateMethod\GoodCode\Services;

abstract class CVReportGenerator
{
    /**
     * TEMPLATE METHOD - The main algorithm
     * This method is FINAL (cannot be changed by children)
     * It defines the STEPS that all CV processors must follow
     */

    final public function generateReport(string $filePath):array
    {
        // Step 1: Read file (different for each format)
        $content = $this->readFile($filePath);

        // Step 2: Extract data (different for each format)
        $data = $this->extractData($content);

        // Step 3: Validate (SAME for all formats)
        $this->validate($data);

        // Step 4: Calculate score (SAME for all formats)
        $score = $this->calculateScore($data);

        // Step 5: Build report (SAME for all formats)
        $report = $this->buildReport($data, $score);

        echo "✅ Done!\n\n";

        return $report;
    }

    // ========================================
    // ABSTRACT METHODS - Children MUST implement these
    // ========================================

    abstract protected function readFile(string $filePath): string;
    abstract protected function extractData(string $content): array;


    // ========================================
    // COMMON METHODS - Implemented ONCE, used by ALL
    // ========================================

    protected function validate(array $data): void
    {
        if (empty($data['email'])) {
            throw new \Exception("Email is required");
        }

        if (empty($data['name'])) {
            throw new \Exception("Name is required");
        }
    }

    protected function calculateScore(array $data): int
    {
        $score = 0;

        if (!empty($data['experience'])) {
            $score += 40;
        }

        if (!empty($data['skills']) && count($data['skills']) > 3) {
            $score += 60;
        }

        return $score;
    }

    protected function buildReport(array $data, int $score): array
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'skills' => $data['skills'],
            'score' => $score,
            'status' => $score >= 70 ? 'APPROVED' : 'REVIEW',
        ];
    }
}
