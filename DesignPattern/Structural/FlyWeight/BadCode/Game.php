<?php

namespace DesignPattern\Structural\FlyWeight\BadCode;

/**
 * ============================================
 * GAME CLASS - Creates Many Enemies
 * ============================================
 */

class Game
{
    private Player $player;
    private array $enemies = [];

    public function __construct()
    {
        $this->player = new Player("Hero");
    }

    /**
     * Spawn enemies
     *
     * PROBLEM: Creates 100 separate objects
     * Each object stores duplicate intrinsic data!
     */
    public function spawnEnemies(): void
    {
        echo "Spawning enemies...\n";

        // ❌ Create 50 weak enemies
        // Each stores: "Weak", 50, 10, "weak.png", "weak_attack.mp3"
        for ($i = 0; $i < 50; $i++) {
            $this->enemies[] = new Enemy('Weak', rand(0, 800), rand(0, 600));
        }

        // ❌ Create 50 strong enemies
        // Each stores: "Strong", 100, 20, "strong.png", "strong_attack.mp3"
        for ($i = 0; $i < 50; $i++) {
            $this->enemies[] = new Enemy('Strong', rand(0, 800), rand(0, 600));
        }

        echo "Spawned " . count($this->enemies) . " enemies\n";
    }

    /**
     * Calculate total memory usage
     */
    public function calculateMemoryUsage(): void
    {
        $totalMemory = 0;

        foreach ($this->enemies as $enemy) {
            $totalMemory += $enemy->getMemoryUsage();
        }

        echo "\n❌ BAD CODE - Memory Usage:\n";
        echo "Total enemies: " . count($this->enemies) . "\n";
        echo "Approximate memory: " . $totalMemory . " bytes\n";
        echo "Average per enemy: " . ($totalMemory / count($this->enemies)) . " bytes\n";

        // Show duplicate data problem
        $weakCount = 0;
        $strongCount = 0;

        foreach ($this->enemies as $enemy) {
            if ($enemy->getType() === 'Weak') {
                $weakCount++;
            } else {
                $strongCount++;
            }
        }

        echo "\n❌ DUPLICATE DATA PROBLEM:\n";
        echo "Weak enemies: {$weakCount} (each stores 'Weak', 50, 10, sprite, sound)\n";
        echo "Strong enemies: {$strongCount} (each stores 'Strong', 100, 20, sprite, sound)\n";
        echo "Same data stored {$weakCount} + {$strongCount} = " . count($this->enemies) . " times!\n";
    }

    /**
     * Render all enemies
     */
    public function renderGame(): void
    {
        echo "\nRendering game...\n";

        // ❌ Each enemy renders itself with duplicate sprite loading
        foreach ($this->enemies as $enemy) {
            echo $enemy->render() . "\n";
        }
    }

    /**
     * Simulate battle
     */
    public function simulateBattle(): void
    {
        echo "\n=== Battle Simulation ===\n";
        echo "Player health: {$this->player->getHealth()}\n";
        echo "Player attack: {$this->player->getAttackPower()}\n";

        // Attack first 3 enemies
        for ($i = 0; $i < 3 && $i < count($this->enemies); $i++) {
            $enemy = $this->enemies[$i];
            echo "\nEnemy {$i}: {$enemy->getType()} - Health: {$enemy->getHealth()}, Attack: {$enemy->getAttackPower()}\n";
            $this->player->attack($enemy);
            echo "Enemy health after attack: {$enemy->getHealth()}\n";
        }
    }
}

/**
 * ============================================
 * PROBLEMS ANALYSIS
 * ============================================
 *
 * MEMORY WASTE CALCULATION:
 * ──────────────────────────────────
 *
 * Weak Enemy (50 instances):
 * - type: "Weak" (4 bytes) × 50 = 200 bytes
 * - baseHealth: 50 (4 bytes) × 50 = 200 bytes
 * - baseAttackPower: 10 (4 bytes) × 50 = 200 bytes
 * - sprite: "assets/enemies/weak_enemy.png" (30 bytes) × 50 = 1500 bytes
 * - soundEffect: "sounds/weak_attack.mp3" (24 bytes) × 50 = 1200 bytes
 *
 * Strong Enemy (50 instances):
 * - type: "Strong" (6 bytes) × 50 = 300 bytes
 * - baseHealth: 100 (4 bytes) × 50 = 200 bytes
 * - baseAttackPower: 20 (4 bytes) × 50 = 200 bytes
 * - sprite: "assets/enemies/strong_enemy.png" (32 bytes) × 50 = 1600 bytes
 * - soundEffect: "sounds/strong_attack.mp3" (26 bytes) × 50 = 1300 bytes
 *
 * TOTAL DUPLICATE DATA: ~6,900 bytes for just 100 enemies!
 *
 * With 10,000 enemies:
 * - Duplicate data: ~690,000 bytes (690 KB)
 * - Most of this is THE SAME DATA repeated!
 *
 * ============================================
 * WHY THIS IS BAD DESIGN
 * ============================================
 *
 * 1. MASSIVE MEMORY WASTE:
 *    ❌ Stores same type info 1000× for 1000 enemies
 *    ❌ Stores same sprite path 1000× for 1000 enemies
 *    ❌ Stores same stats 1000× for 1000 enemies
 *
 * 2. POOR SCALABILITY:
 *    ❌ 100 enemies = OK
 *    ❌ 10,000 enemies = Memory problems!
 *    ❌ 100,000 enemies = Game crashes!
 *
 * 3. INEFFICIENT OBJECT CREATION:
 *    ❌ Creating object is slow when done 10,000 times
 *    ❌ Each object initialization duplicates work
 *
 * 4. CODE DUPLICATION:
 *    ❌ Weapon logic duplicated in Enemy and Player
 *    ❌ Type-specific logic in constructor
 *    ❌ Hard to maintain
 *
 * 5. PERFORMANCE ISSUES:
 *    ❌ More objects = more memory allocation
 *    ❌ More memory = worse cache performance
 *    ❌ Slower rendering with many objects
 *
 * 6. MAINTENANCE PROBLEMS:
 *    ❌ Change weak enemy stats? Must update constructor
 *    ❌ Add new enemy type? Modify constructor again
 *    ❌ Violates Open/Closed Principle
 *
 * ============================================
 * WHAT SHOULD BE DONE INSTEAD?
 * ============================================
 *
 * USE FLYWEIGHT PATTERN:
 * ✅ Share intrinsic data (type, base stats, sprites)
 * ✅ Store unique data separately (position, current health)
 * ✅ Create only 2 flyweights (Weak type, Strong type)
 * ✅ 10,000 enemies share 2 flyweight objects!
 * ✅ Memory reduced by 99%+
 * ✅ Faster object creation
 * ✅ Better performance
 *
 * See the GOOD CODE file for the solution!
 * ============================================
 */

