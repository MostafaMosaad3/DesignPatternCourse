<?php

namespace DesignPattern\Structural\FlyWeight\BadCode;

/**
 * ============================================
 * BAD CODE: WITHOUT FLYWEIGHT PATTERN
 * ============================================
 *
 * SCENARIO:
 * You're developing a game with a single player and enemies.
 * Both have common attributes like health bar, weapon, and attack power.
 * There are two types of enemies (Weak, Strong), each type has
 * different attack power and health bar. Weapons can be changed
 * from both sides (player, enemies) and some of them provide
 * extra attack power points.
 *
 * PROBLEMS WITH THIS CODE:
 * ❌ Creates separate object for EVERY enemy
 * ❌ Duplicates shared data (type, base stats) in every object
 * ❌ Wastes massive amounts of memory
 * ❌ 1000 enemies = 1000 objects with duplicate data
 * ❌ Same weapon data stored in multiple enemies
 * ❌ Inefficient for large numbers of similar objects
 * ❌ Poor performance with many game entities
 * ❌ Memory usage grows linearly with enemy count
 *
 * REAL WORLD IMPACT:
 * - 100 weak enemies: Each stores "Weak", 50 health, 10 attack
 * - 100 strong enemies: Each stores "Strong", 100 health, 20 attack
 * - Total: 200 objects, each with duplicate intrinsic data
 * - Memory waste: Storing same data 200 times!
 * - With 10,000 enemies: Game slows down, high memory usage
 *
 * ============================================
 */

/**
 * ============================================
 * ENEMY CLASS - Stores EVERYTHING
 * ============================================
 *
 * This class stores both intrinsic (shared) and extrinsic (unique) data
 * in every single enemy object.
 *
 * PROBLEMS:
 * ❌ Every enemy stores its own type name
 * ❌ Every enemy stores base health/attack
 * ❌ Duplicate data across all enemies of same type
 * ❌ Memory inefficient
 */


class Enemy
{
    // ❌ INTRINSIC DATA (Should be shared!)
    // This data is THE SAME for all enemies of the same type
    private string $type;              // "Weak" or "Strong" - duplicated!
    private int $baseHealth;           // Same for all weak/strong - duplicated!
    private int $baseAttackPower;      // Same for all weak/strong - duplicated!
    private string $sprite;            // Image path - duplicated!
    private string $soundEffect;       // Sound file - duplicated!

    // ✅ EXTRINSIC DATA (Unique to each enemy)
    // This data is DIFFERENT for each enemy instance
    private int $currentHealth;        // Changes per enemy
    private int $positionX;            // Unique position
    private int $positionY;            // Unique position
    private string $currentWeapon;     // May vary per enemy
    private int $weaponBonus;          // Based on weapon

    /**
     * Constructor - Creates a complete enemy object
     *
     * PROBLEM: Every enemy stores ALL this data, even shared data!
     * If you create 1000 weak enemies, you store "Weak", 50, 10, "weak.png"
     * 1000 TIMES! That's incredibly wasteful!
     *
     * @param string $type Enemy type (Weak or Strong)
     */

    public function __construct(string $type, int $x, int $y)
    {
        $this->type = $type;
        $this->positionX = $x;
        $this->positionY = $y;

        // ❌ PROBLEM: Setting intrinsic data for EVERY enemy
        // This data is the SAME for all enemies of this type!
        if ($type === 'Weak') {
            $this->baseHealth = 50;
            $this->baseAttackPower = 10;
            $this->sprite = 'assets/enemies/weak_enemy.png';
            $this->soundEffect = 'sounds/weak_attack.mp3';
            $this->currentWeapon = 'Knife';
            $this->weaponBonus = 5;
        } else { // Strong
            $this->baseHealth = 100;
            $this->baseAttackPower = 20;
            $this->sprite = 'assets/enemies/strong_enemy.png';
            $this->soundEffect = 'sounds/strong_attack.mp3';
            $this->currentWeapon = 'Sword';
            $this->weaponBonus = 10;
        }

        $this->currentHealth = $this->baseHealth;
    }

    /**
     * Get enemy type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get current health
     */
    public function getHealth(): int
    {
        return $this->currentHealth;
    }

    /**
     * Get total attack power (base + weapon bonus)
     */
    public function getAttackPower(): int
    {
        return $this->baseAttackPower + $this->weaponBonus;
    }

    /**
     * Change weapon
     *
     * PROBLEM: Each enemy stores weapon data separately
     */
    public function changeWeapon(string $weapon): void
    {
        $this->currentWeapon = $weapon;

        // ❌ Duplicate weapon logic in every enemy
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

    /**
     * Take damage
     */
    public function takeDamage(int $damage): void
    {
        $this->currentHealth -= $damage;
        if ($this->currentHealth < 0) {
            $this->currentHealth = 0;
        }
    }

    /**
     * Render enemy
     *
     * PROBLEM: Every enemy loads its sprite separately
     */
    public function render(): string
    {
        // ❌ Each enemy has its own sprite path stored
        return "Rendering {$this->type} enemy at ({$this->positionX}, {$this->positionY}) " .
            "with sprite: {$this->sprite}, Health: {$this->currentHealth}/{$this->baseHealth}";
    }

    /**
     * Play attack sound
     */
    public function playAttackSound(): string
    {
        // ❌ Each enemy stores sound file path
        return "Playing sound: {$this->soundEffect}";
    }

    /**
     * Get memory usage of this object
     */
    public function getMemoryUsage(): int
    {
        // Approximate memory per enemy object
        $typeSize = strlen($this->type);
        $spriteSize = strlen($this->sprite);
        $soundSize = strlen($this->soundEffect);
        $weaponSize = strlen($this->currentWeapon);
        $intSize = 4; // bytes per integer

        return $typeSize + $spriteSize + $soundSize + $weaponSize + ($intSize * 6);
    }
}
