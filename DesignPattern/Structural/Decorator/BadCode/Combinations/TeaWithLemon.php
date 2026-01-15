<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class TeaWithLemon
{
    public function cost(): float
    {
        return 1.50 + 0.15;
    }

    public function description(): string
    {
        return "Tea with Lemon";
    }
}
