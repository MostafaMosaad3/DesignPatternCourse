<?php

namespace DesignPattern\Structural\FlyWeight\GoodCode;

use MongoDB\BSON\Type;

/**
 * ============================================
 * CONCRETE FLYWEIGHT - Stores INTRINSIC Data
 * ============================================
 *
 * Implements the Flyweight interface and stores
 * intrinsic (shared) state. Must be sharable.
 */
class EnemyType implements EnemyTypeFlyweight
{
    // Intrinsic state (shared data)
    private string $name;
    private int $baseHealth;
    private int $baseAttackPower;
    private string $sprite;

    public function __construct(
        string $name,
        int $baseHealth,
        int $baseAttackPower,
        string $sprite
    ) {
        $this->name = $name;
        $this->baseHealth = $baseHealth;
        $this->baseAttackPower = $baseAttackPower;
        $this->sprite = $sprite;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBaseHealth(): int
    {
        return $this->baseHealth;
    }

    public function getBaseAttackPower(): int
    {
        return $this->baseAttackPower;
    }

    public function getSprite(): string
    {
        return $this->sprite;
    }

    /**
     * Operation that accepts extrinsic state (position)
     * and combines it with intrinsic state (sprite)
     */
    public function render(int $x, int $y): void
    {
        echo "Rendering {$this->sprite} at position ({$x}, {$y})\n";
    }
}
