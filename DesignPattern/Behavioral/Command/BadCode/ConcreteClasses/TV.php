<?php

namespace DesignPattern\Command\BadCode\ConcreteClasses ;

class TV
{
    public $location ;
    public $isOn = false ;

    public function __construct(string $location)
    {
        $this->location = $location ;
    }

    public function turnTVOn(): void
    {
        $this->isOn = true;
        echo "📺 {$this->location} TV is ON\n";
    }

    public function turnTVOff(): void
    {
        $this->isOn = false;
        echo "📺 {$this->location} TV is OFF\n";
    }

}
