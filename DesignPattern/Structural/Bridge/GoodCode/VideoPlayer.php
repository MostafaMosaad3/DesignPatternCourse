<?php

namespace DesignPattern\Structural\Bridge\GoodCode;



// ============================================
// ABSTRACTION: VIDEO PLAYER
// ============================================

use DesignPattern\Structural\Bridge\GoodCode\Contract\VideoAPI;

class VideoPlayer
{
    protected $api ; // implementation
    protected $quality ;

    public function __construct(VideoApi $api)
    {
        $this->api = $api;
    }

    public function setQuality($quality): void
    {
        $this->quality = $quality;
    }


    public function play(): string
    {
        return $this->api->playVideo($this->quality);
    }

}

/**
 * ============================================
 * ADVANTAGES:
 * ============================================
 *
 * 1. NO CLASS EXPLOSION:
 *    ✅ 3 providers + 1 player = 4 classes
 *    ✅ Bad code had 9 classes!
 *    ✅ Add provider? Just 1 class
 *    ✅ Add quality? Zero classes!
 *
 * 2. NO CODE DUPLICATION:
 *    ✅ play() logic in ONE place
 *    ✅ Each provider implements once
 *
 * 3. EASY TO ADD PROVIDER:
 *    ✅ Create one class: NetflixAPI
 *    ✅ Implement VideoAPI interface
 *    ✅ Done!
 *
 * 4. EASY TO ADD QUALITY:
 *    ✅ Just pass different quality string
 *    ✅ No new classes needed!
 *
 * 5. RUNTIME FLEXIBILITY:
 *    ✅ Can switch provider anytime
 *    ✅ Can change quality anytime
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * ADD NETFLIX:
 *
 * BAD CODE:
 * ❌ Create NetflixHDPlayer
 * ❌ Create NetflixSDPlayer
 * ❌ Create Netflix4KPlayer
 * ❌ 3 new classes
 *
 * GOOD CODE:
 * ✅ Create NetflixAPI
 * ✅ 1 new class
 *
 * ADD 8K QUALITY:
 *
 * BAD CODE:
 * ❌ Create YouTube8KPlayer
 * ❌ Create Twitch8KPlayer
 * ❌ Create Vimeo8KPlayer
 * ❌ Create Netflix8KPlayer
 * ❌ 4 new classes
 *
 * GOOD CODE:
 * ✅ Just use setQuality('8K')
 * ✅ 0 new classes
 *
 * TOTAL CLASSES:
 *
 * BAD CODE (3 providers × 3 qualities):
 * ❌ 9 classes
 *
 * GOOD CODE (3 providers + 1 player):
 * ✅ 4 classes
 *
 * That's the power of Bridge Pattern! 🚀
 */
