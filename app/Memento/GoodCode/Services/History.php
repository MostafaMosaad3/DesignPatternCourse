<?php

namespace App\Memento\GoodCode\Services;


// ============================================
// STEP 3: HISTORY (CARETAKER)
// ============================================

/**
 * Manages mementos
 * - Stores history of mementos
 * - Provides undo/redo
 * - Does NOT know what's inside mementos
 */

class History
{
    private $mementos = [] ;
    private $currentIndex = -1 ;

    /**
     * ✅ SAVE: Store memento
     * Doesn't know or care what's inside
     */

    public function push(EditorMemento $memento) :void
    {
        // Clear redo history when new state is saved
        if ($this->currentIndex < count($this->mementos) - 1) {
            array_splice($this->mementos, $this->currentIndex + 1);
        }

        $this->mementos[] = $memento;
        $this->currentIndex++;

        echo "💾 State saved! (History: " . count($this->mementos) . " states)\n\n";
    }

    /**
     * ✅ CHECK: Can we undo?
     */
    public function canUndo()
    {
        return $this->currentIndex > 0;
    }

    /**
     * ✅ UNDO: Get previous memento
     */
    public function undo(): ?EditorMemento
    {
        if (!$this->canUndo()) {
            echo "❌ Cannot undo! No more history.\n\n";
            return null;
        }

        $this->currentIndex--;
        return $this->mementos[$this->currentIndex];
    }


    /**
     * ✅ CHECK: Can we redo?
     */
    public function canRedo()
    {
        return $this->currentIndex < count($this->mementos) -1 ;
    }

    public function redo(): ?EditorMemento
    {
        if(!$this->canRedo()) {
            echo "❌ Cannot redo! No future states.\n\n";
            return null;
        }
        $this->currentIndex++;
        return $this->mementos[$this->currentIndex];
    }

    /**
     * Show history
     */
    public function showHistory(): void
    {
        echo "📚 === HISTORY ===\n";
        foreach ($this->mementos as $index => $memento) {
            $current = ($index === $this->currentIndex) ? ' ← CURRENT' : '';
            echo "  [$index] {$memento->getTimestamp()}$current\n";
        }
        echo "==================\n\n";
    }
}

/**
 * ============================================
 * ADVANTAGES OF THIS APPROACH:
 * ============================================
 *
 * 1. PROPER ENCAPSULATION:
 *    ✅ Editor properties are PRIVATE
 *    ✅ Only editor can access/modify its state
 *    ✅ Memento is opaque to History
 *    ✅ Secure and controlled
 *
 * 2. LOOSE COUPLING:
 *    ✅ History doesn't know about editor structure
 *    ✅ History just stores/returns mementos
 *    ✅ Editor controls save/restore logic
 *    ✅ Can reuse History for ANY object
 *
 * 3. EASY MAINTENANCE:
 *    ✅ Add new property to editor?
 *        → Update only save() and restore()
 *        → TWO places in ONE class
 *        → History doesn't need changes
 *    ✅ Single source of truth
 *
 * 4. SINGLE RESPONSIBILITY:
 *    ✅ TextEditor: Manages text and formatting
 *    ✅ EditorMemento: Stores state snapshot
 *    ✅ History: Manages undo/redo
 *    ✅ Each class has ONE job
 *
 * 5. REUSABILITY:
 *    ✅ Can use same History class for:
 *        - TextEditor
 *        - CodeEditor
 *        - ImageEditor
 *        - Any object that implements save/restore
 *
 * 6. EASY TESTING:
 *    ✅ Test TextEditor independently
 *    ✅ Test History independently
 *    ✅ Mock mementos easily
 *    ✅ Clear interfaces
 *
 * 7. FLEXIBILITY:
 *    ✅ Easy to add features:
 *        - Compress mementos
 *        - Add descriptions
 *        - Limit history size
 *        - Save to database
 *        - Add timestamps
 *    ✅ All without breaking existing code
 *
 * ============================================
 * ADDING NEW PROPERTY - EXAMPLE:
 * ============================================
 *
 * Want to add "alignment" property?
 *
 * In TextEditor class only:
 *
 * 1. Add property:
 *    private $alignment = 'left';
 *
 * 2. Update save():
 *    $state = [
 *        'text' => $this->text,
 *        'fontSize' => $this->fontSize,
 *        'fontColor' => $this->fontColor,
 *        'isBold' => $this->isBold,
 *        'isItalic' => $this->isItalic,
 *        'alignment' => $this->alignment, // ✅ Add here
 *    ];
 *
 * 3. Update restore():
 *    $this->alignment = $state['alignment']; // ✅ Add here
 *
 * That's it! Only ONE class, TWO methods!
 * History class doesn't need ANY changes!
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * Adding "alignment" property:
 *
 * BAD CODE:
 * ❌ Update TextEditor class
 * ❌ Update HistoryManager->save()
 * ❌ Update HistoryManager->undo()
 * ❌ Update HistoryManager->redo()
 * ❌ FOUR places, TWO classes
 *
 * GOOD CODE:
 * ✅ Update TextEditor->save()
 * ✅ Update TextEditor->restore()
 * ✅ TWO places, ONE class
 * ✅ History unchanged!
 *
 * ============================================
 * MEMENTO PATTERN BENEFITS:
 * ============================================
 *
 * ✅ Editor controls its own state
 * ✅ History doesn't know editor internals
 * ✅ Easy to add new properties
 * ✅ Easy to test
 * ✅ Reusable History class
 * ✅ Proper encapsulation
 * ✅ Loose coupling
 * ✅ Follows SOLID principles
 *
 * That's the power of Memento Pattern! 🚀
 */
