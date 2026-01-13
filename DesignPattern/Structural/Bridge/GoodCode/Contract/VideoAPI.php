<?php

namespace DesignPattern\Structural\Bridge\GoodCode\Contract;

/**
 * BENEFITS:
 * ✅ Only N + M classes (not N × M)
 * ✅ No code duplication
 * ✅ Easy to add provider
 * ✅ Easy to add quality
 */


interface VideoAPI
{
    public function playVideo(string $quality) :string ;
}
