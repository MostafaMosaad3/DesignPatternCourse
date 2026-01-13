<?php

namespace DesignPattern\Memento\BadCode\Services;

class HistoryManager
{
    private $history ;
    private $currentIndex = 1 ;


    /**
     * ❌ BAD: Directly accesses editor's properties
     * ❌ BAD: Knows about editor's internal structure
     * ❌ BAD: If editor adds new property, this breaks
     */


    public function save(TextEditor $editor) :void
    {
        // Remove any redo history when saving new state
        if ($this->currentIndex < count($this->history) - 1) {
            array_splice($this->history, $this->currentIndex, 1);

            // ❌ PROBLEM: Manually copying each property
            // If TextEditor adds new property, we must update here!
            $state = [
                'text' => $editor->text,
                'fontSize' => $editor->fontSize,
                'fontColor' => $editor->fontColor,
                'isBold' => $editor->isBold,
                'isItalic' => $editor->isItalic,
            ];

            $this->history[] = $state;
            $this->currentIndex++;
        }
    }

    /**
     * ❌ BAD: Directly modifies editor's properties
     * ❌ BAD: Breaks encapsulation
     */

    public function undo(TextEditor $editor) :void
    {
        if($this->currentIndex <=0)
        {
            return ;
        }

        $this->currentIndex--;
        $state = $this->history[$this->currentIndex];

        // ❌ PROBLEM: Directly setting properties
        $editor->text = $state['text'];
        $editor->fontSize = $state['fontSize'];
        $editor->fontColor = $state['fontColor'];
        $editor->isBold = $state['isBold'];
        $editor->isItalic = $state['isItalic'];
    }

    /**
     * ❌ BAD: Same problems as undo
     */

    public function redo(TextEditor $editor) :void
    {
        if($this->currentIndex >= count($this->history) -1 )
        {
            return ;
        }

        $this->currentIndex++ ;
        $state = $this->history[$this->currentIndex];

        // ❌ PROBLEM: Directly setting properties
        $editor->text = $state['text'];
        $editor->fontSize = $state['fontSize'];
        $editor->fontColor = $state['fontColor'];
        $editor->isBold = $state['isBold'];
        $editor->isItalic = $state['isItalic'];
    }

    /**
     * ============================================
     * PROBLEMS SUMMARY:
     * ============================================
     *
     * 1. BROKEN ENCAPSULATION:
     *    ❌ Editor's properties are PUBLIC
     *    ❌ Anyone can modify: $editor->text = "hack"
     *    ❌ No control over state changes
     *    ❌ Internal structure exposed
     *
     * 2. TIGHT COUPLING:
     *    ❌ HistoryManager knows TextEditor's structure
     *    ❌ Must manually list all properties
     *    ❌ If TextEditor changes, HistoryManager breaks
     *    ❌ Cannot reuse HistoryManager for other classes
     *
     * 3. MAINTENANCE NIGHTMARE:
     *    ❌ Add new property to TextEditor?
     *        → Must update save() method
     *        → Must update undo() method
     *        → Must update redo() method
     *    ❌ Three places to change for each new property!
     *    ❌ Easy to forget and cause bugs
     *
     * 4. VIOLATES SINGLE RESPONSIBILITY:
     *    ❌ HistoryManager does TWO things:
     *        1. Manages history
     *        2. Knows how to save/restore editor state
     *    ❌ TextEditor can't control how it's saved
     *
     * 5. TESTING DIFFICULTIES:
     *    ❌ Can't test HistoryManager without TextEditor
     *    ❌ Can't mock editor state easily
     *    ❌ Tightly coupled makes unit testing hard
     *
     * 6. NO FLEXIBILITY:
     *    ❌ What if different editors need different save logic?
     *    ❌ What if you want to compress state?
     *    ❌ What if you want to add metadata?
     *    ❌ All hardcoded in HistoryManager
     *
     * 7. SCALABILITY ISSUES:
     *    ❌ Want to add CodeEditor, ImageEditor?
     *    ❌ Need separate HistoryManager for each
     *    ❌ Cannot reuse history logic
     *    ❌ Lots of code duplication
     *
     * 8. SECURITY RISK:
     *    ❌ Public properties can be modified anywhere
     *    ❌ No validation on state changes
     *    ❌ History might save invalid states
     *
     * 9. EXAMPLE SCENARIO - ADDING NEW FEATURE:
     *
     *    Let's say we want to add "alignment" property:
     *
     *    In TextEditor:
     *    public $alignment = 'left'; // Add this
     *
     *    In HistoryManager->save():
     *    $state = [
     *        'text' => $editor->text,
     *        'fontSize' => $editor->fontSize,
     *        'fontColor' => $editor->fontColor,
     *        'isBold' => $editor->isBold,
     *        'isItalic' => $editor->isItalic,
     *        'alignment' => $editor->alignment, // ❌ Must add
     *    ];
     *
     *    In HistoryManager->undo():
     *    $editor->alignment = $state['alignment']; // ❌ Must add
     *
     *    In HistoryManager->redo():
     *    $editor->alignment = $state['alignment']; // ❌ Must add
     *
     *    😱 THREE places to update for ONE new property!
     *
     * 10. REAL-WORLD IMPACT:
     *     ❌ Developer adds property, forgets to update history
     *     ❌ Undo doesn't restore new property
     *     ❌ Bug reported
     *     ❌ Time wasted debugging
     *     ❌ User frustration
     *
     * ============================================
     * SOLUTION: USE MEMENTO PATTERN!
     * ============================================
     *
     * With Memento Pattern:
     * ✅ Editor controls its own state
     * ✅ History doesn't know editor internals
     * ✅ Add new property? Only update Editor
     * ✅ History automatically handles it
     * ✅ Loose coupling
     * ✅ Easy to maintain
     * ✅ Easy to test
     * ✅ Secure encapsulation
     *
     * See GOOD CODE for proper implementation!
     */
}
