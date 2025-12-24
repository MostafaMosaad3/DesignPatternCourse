<?php

namespace DesignPattern\Memento\GoodCode\Services;

// ============================================
// STEP 2: TEXT EDITOR (ORIGINATOR)
// ============================================

class TextEditor
{
    private $text ;
    private $fontSize ;

    private $fontColor;

    private $isBold ;

    private $isItalic ;

    public function __construct()
    {
        $this->text = '';
        $this->fontSize = 12;
        $this->fontColor = '#000000';
        $this->isBold = false;
        $this->isItalic = false;
    }

    // ========================================
    // PUBLIC METHODS (controlled access)
    // ========================================

    public function type(string $content):void
    {
        $this->text .= $content;
    }

    public function setFontSize(int $size):void
    {
        $this->fontSize = $size;
    }


    public function setBold(bool $isBold):void
    {
        $this->isBold = $isBold;
    }


    public function showContent() :void
    {
        echo "📄 === CURRENT CONTENT ===\n";
        echo "Text: {$this->text}\n";
        echo "Font: {$this->fontSize}px\n";
        echo "Color: {$this->fontColor}\n";
        echo "Bold: " . ($this->isBold ? 'Yes' : 'No') . "\n";
        echo "Italic: " . ($this->isItalic ? 'Yes' : 'No') . "\n";
        echo "=======================\n\n";
    }

    // ========================================
    // MEMENTO METHODS
    // ========================================

    public function save():EditorMemento
    {
        $state = [
            'text' => $this->text,
            'fontSize' => $this->fontSize,
            'fontColor' => $this->fontColor,
            'isBold' => $this->isBold,
            'isItalic' => $this->isItalic
        ] ;

        return new EditorMemento($state);
    }

    /**
     * ✅ RESTORE: Restore state from memento
     * Editor controls how to restore
     */
    public function restore(EditorMemento $memento):void
    {
        $state = $memento->getState();

        $this->text = $state['text'];
        $this->fontSize = $state['fontSize'];
        $this->fontColor = $state['fontColor'];
        $this->isBold = $state['isBold'];
        $this->isItalic = $state['isItalic'];
    }




}
