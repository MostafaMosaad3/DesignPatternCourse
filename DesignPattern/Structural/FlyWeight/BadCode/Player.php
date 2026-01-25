<?php

namespace DesignPattern\Structural\FlyWeight\BadCode;

/**
 * ============================================
 * PLAYER CLASS - Similar Problems
 * ============================================
 */

class Player
{
    private string $name;
    private int $health;
    private int $baseAttackPower;
    private string $currentWeapon;
    private int $weaponBonus;
    private int $positionX;
    private int $positionY;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->health = 200;
        $this->baseAttackPower = 30;
        $this->currentWeapon = 'Sword';
        $this->weaponBonus = 10;
        $this->positionX = 0;
        $this->positionY = 0;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getAttackPower(): int
    {
        return $this->baseAttackPower + $this->weaponBonus;
    }

    public function changeWeapon(string $weapon): void
    {
        $this->currentWeapon = $weapon;

        // ❌ Duplicate weapon logic (same as in Enemy!)
        switch ($weapon) {
            case 'Knife':
                $this->weaponBonus = 5;
                break;
            case 'Sword':
                $this->weaponBonus = 10;
                break;
            case 'Axe':
                $this->weaponBonus = 15;
                break;
            case 'Bow':
                $this->weaponBonus = 8;
                break;
        }
    }

    public function takeDamage(int $damage): void
    {
        $this->health -= $damage;
        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function attack(Enemy $enemy): void
    {
        $damage = $this->getAttackPower();
        $enemy->takeDamage($damage);
        echo "Player attacks {$enemy->getType()} enemy for {$damage} damage!\n";
    }
}
