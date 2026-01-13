<?php

namespace DesignPattern\Structural\Bridge\GoodCode\ConcreteClasses;

use DesignPattern\Structural\Bridge\GoodCode\Contract\VideoAPI;

class YouTypeAPI implements VideoAPI
{
    public function playVideo(string $quality): string
    {
        return "Playing YouTube in ($quality)";
    }
}
