<?php

namespace DesignPattern\Structural\Bridge\GoodCode\ConcreteClasses;

use DesignPattern\Structural\Bridge\GoodCode\Contract\VideoAPI;

class TwitchAPI implements VideoAPI
{

    public function playVideo(string $quality): string
    {
        return "Playing Twitch in ($quality)";
    }
}
