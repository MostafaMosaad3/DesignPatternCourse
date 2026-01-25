<?php

namespace DesignPattern\Structural\FlyWeight\GoodCode;

/**
 * ============================================
 * PLAYER CLASS
 * ============================================
 */

class Player
{
    private int $health;
    private int $baseAttackPower;
    private int $weaponBonus;

    public function __construct()
    {
        $this->health = 200;
        $this->baseAttackPower = 30;
        $this->weaponBonus = 10;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getAttackPower(): int
    {
        return $this->baseAttackPower + $this->weaponBonus;
    }

    public function attack(Enemy $enemy): void
    {
        $enemy->takeDamage($this->getAttackPower());
    }

    public function changeWeapon(string $weapon): void
    {
        $this->weaponBonus = match($weapon) {
            'Knife' => 5,
            'Sword' => 10,
            'Axe' => 15,
            default => 10,
        };
    }
}
