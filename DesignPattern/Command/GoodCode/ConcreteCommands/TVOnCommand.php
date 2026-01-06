<?php

namespace DesignPattern\Command\GoodCode\ConcreteCommands;

use DesignPattern\Command\GoodCode\ConcreteClasses\TV;
use DesignPattern\Command\GoodCode\Contract\Command;

class TVOnCommand implements Command
{

    private TV $tv ;

    public function __construct(TV $tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        $this->tv->turnTVOn();
    }
}
