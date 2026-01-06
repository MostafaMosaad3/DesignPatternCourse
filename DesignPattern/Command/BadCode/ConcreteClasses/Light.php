<?php

namespace DesignPattern\Command\BadCode\ConcreteClasses;

class Light
{
    public $location ;
    public $isLocked = false ;

    public function __construct(string $location)
    {
        $this->location = $location ;
    }

    public function turnOn(): void
    {
        $this->isOn = true;
        echo "💡 {$this->location} light is ON\n";
    }

    public function turnOff(): void
    {
        $this->isOn = false;
        echo "💡 {$this->location} light is OFF\n";
    }

}
