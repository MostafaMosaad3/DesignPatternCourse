<?php

namespace DesignPattern\Structural\Bridge\BadCode;

class YouTypeHDPlayer
{
    public function play(): string
    {
        return "Playing YouTube in HD";
    }
}

/**
 * ============================================
 * PROBLEMS:
 * ============================================
 *
 * 1. CLASS EXPLOSION:
 *    ❌ 3 providers × 3 qualities = 9 classes!
 *    ❌ Add Netflix? 3 more classes
 *    ❌ Add 8K quality? 4 more classes
 *    ❌ Quickly becomes unmanageable
 *
 * 2. CODE DUPLICATION:
 *    ❌ play() logic repeated in every class
 *    ❌ Similar code everywhere
 *
 * 3. HARD TO ADD PROVIDER:
 *    ❌ Add Netflix? Create 3 new classes
 *    ❌ NetflixHDPlayer, NetflixSDPlayer, Netflix4KPlayer
 *
 * 4. HARD TO ADD QUALITY:
 *    ❌ Add 8K? Create 4 new classes
 *    ❌ YouTube8K, Twitch8K, Vimeo8K, Netflix8K
 *
 * 5. INCONSISTENCY:
 *    ❌ Twitch doesn't support 4K
 *    ❌ But need class structure to match
 *    ❌ Or break pattern
 *
 * ============================================
 * SOLUTION: USE BRIDGE PATTERN!
 * ============================================
 */
