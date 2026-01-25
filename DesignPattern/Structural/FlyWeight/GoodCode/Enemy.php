<?php

namespace DesignPattern\Structural\FlyWeight\GoodCode;

/**
 * ============================================
 * CONTEXT - Stores EXTRINSIC (Unique) Data
 * ============================================
 *
 * Maintains a reference to a flyweight and
 * stores extrinsic (context-specific) state.
 */

class Enemy
{
    private EnemyTypeFlyweight $type;  // Reference to shared flyweight

    // Extrinsic state (unique per enemy)
    private int $currentHealth;
    private int $positionX;
    private int $positionY;
    private int $weaponBonus;

    public function __construct(EnemyTypeFlyweight $type, int $x, int $y)
    {
        $this->type = $type;
        $this->positionX = $x;
        $this->positionY = $y;
        $this->currentHealth = $type->getBaseHealth();
        $this->weaponBonus = 5;
    }

    public function getTypeName(): string
    {
        return $this->type->getName();
    }

    public function getHealth(): int
    {
        return $this->currentHealth;
    }

    public function getAttackPower(): int
    {
        return $this->type->getBaseAttackPower() + $this->weaponBonus;
    }

    public function takeDamage(int $damage): void
    {
        $this->currentHealth -= $damage;
        if ($this->currentHealth < 0) {
            $this->currentHealth = 0;
        }
    }

    public function changeWeapon(string $weapon): void
    {
        $this->weaponBonus = match($weapon) {
            'Knife' => 5,
            'Sword' => 10,
            'Axe' => 15,
            default => 5,
        };
    }

    public function render(): void
    {
        // Delegates to flyweight, passing extrinsic state
        $this->type->render($this->positionX, $this->positionY);
    }
}
