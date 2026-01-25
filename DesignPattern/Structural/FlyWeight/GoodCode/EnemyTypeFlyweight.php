<?php

namespace DesignPattern\Structural\FlyWeight\GoodCode;

interface EnemyTypeFlyweight
{
    public function getName(): string;
    public function getBaseHealth(): int;
    public function getBaseAttackPower(): int;
    public function getSprite(): string;
    public function render(int $x, int $y): void; // Operation using extrinsic state
}
