<?php

namespace DesignPattern\Memento\BadCode\Services;


/**
 * PROBLEMS WITH THIS CODE:
 * ❌ Breaks encapsulation (exposes internal state)
 * ❌ Tight coupling between editor and history
 * ❌ Hard to maintain (history knows editor internals)
 * ❌ No clear separation of concerns
 * ❌ Difficult to add new state properties
 * ❌ History manager depends on editor structure
 * ❌ Hard to test independently
 * ❌ Violates Single Responsibility Principle
 */

class TextEditor
{

    // ❌ PUBLIC properties - anyone can access/modify
    public $text ;
    public $foneSize ;

    public $fontColor ;
    public $isBold ;

    public $isItalic ;


    public function __construct()
    {
        $this->text = '' ;
        $this->foneSize = 12 ;
        $this->fontColor = 'black' ;
        $this->isBold = true;
        $this->isItalic = false;
    }


    public function type(string $content) :void
    {
        $this->text = $content;
    }

    public function setFontSize(int $size) : void
    {
        $this->fontSize = $size ;
    }

    public function setBold(Bool $bool) : void
    {
        $this->isBold = $bool ;
    }


    public function showContnet() :void
    {
        echo "📄 === CURRENT CONTENT ===\n";
        echo "Text: {$this->text}\n";
        echo "Font: {$this->fontSize}px\n";
        echo "Color: {$this->fontColor}\n";
        echo "Bold: " . ($this->isBold ? 'Yes' : 'No') . "\n";
        echo "Italic: " . ($this->isItalic ? 'Yes' : 'No') . "\n";
        echo "=======================\n\n";
    }



}
