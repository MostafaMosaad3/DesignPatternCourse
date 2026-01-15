<?php

namespace DesignPattern\Structural\Decorator\BadCode;

class Tea
{
    public function cost() :float
    {
        return 1.50 ;
    }

    public function description() :string
    {
        return 'Tea' ;
    }
}
