<?php

namespace DesignPattern\Command\GoodCode\ConcreteCommands;

use DesignPattern\Command\GoodCode\ConcreteClasses\Light;
use DesignPattern\Command\GoodCode\Contract\Command;

class TurnOnCommand implements Command
{
    private Light $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }
    public function execute() :void
    {
        $this->light->turnOn();
    }
}
