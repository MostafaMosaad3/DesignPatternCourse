<?php

namespace DesignPattern\Structural\FlyWeight\GoodCode;

/**
 * ============================================
 * FLYWEIGHT FACTORY - Manages Flyweights
 * ============================================
 *
 * Creates and manages flyweight objects.
 * Ensures flyweights are shared properly.
 */

class EnemyTypeFactory
{
    private static array $types = [];

    public static function getType(string $typeName): EnemyType
    {
        if (!isset(self::$types[$typeName])) {
            if ($typeName === 'Weak') {
                self::$types[$typeName] = new EnemyType(
                    'Weak',
                    50,
                    10,
                    'weak_enemy.png'
                );
            } elseif ($typeName === 'Strong') {
                self::$types[$typeName] = new EnemyType(
                    'Strong',
                    100,
                    20,
                    'strong_enemy.png'
                );
            }
        }

        return self::$types[$typeName];
    }

}
