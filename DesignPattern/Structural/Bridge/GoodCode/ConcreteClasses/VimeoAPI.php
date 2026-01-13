<?php

namespace DesignPattern\Structural\Bridge\GoodCode\ConcreteClasses;

use DesignPattern\Structural\Bridge\GoodCode\Contract\VideoAPI;

class VimeoAPI implements VideoAPI
{

    public function playVideo(string $quality): string
    {
        return "Playing Vimeo in ($quality)";
    }
}
