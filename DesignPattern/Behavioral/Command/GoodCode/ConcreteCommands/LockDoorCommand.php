<?php

namespace DesignPattern\Command\GoodCode\ConcreteCommands;

use DesignPattern\Command\GoodCode\ConcreteClasses\Door;
use DesignPattern\Command\GoodCode\Contract\Command;

class LockDoorCommand implements Command
{
    private Door $door;

    public function __construct(Door $door)
    {
        $this->door = $door;
    }

    public function execute()
    {
        $this->door->lock();
    }
}
