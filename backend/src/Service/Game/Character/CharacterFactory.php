<?php

namespace App\Service\Game\Character;

final class CharacterFactory
{
    public static function createPlayer(array $state): Character
    {
        // Base commune à tous les joueurs (V1)
        $template = new CharacterTemplate(
            baseHp: 100,
            baseAttack: 10,
            baseDefense: 5,
            baseMana: 50,
            baseMaxMana: 50
        );

        $stats = new Stats(
            maxHp: $template->baseHp,
            attack: $template->baseAttack,
            defense: $template->baseDefense,
            mana: $state['player']['mana'],
            maxMana: $state['player']['maxMana']
        );

        $player = new Character('player', $stats);

        $player->getStats()->takeDamage(
            $template->baseHp - $state['player']['hp']
        );

        return $player;
    }

    public static function createEnemy(
        array $enemyState
    ): Character {
        if (!isset($enemyState['code'])) {
            throw new \LogicException('Enemy code missing from combat state');
        }

        $template = match ($enemyState['code']) {
            'orc' => new CharacterTemplate(80, 12, 4, 0, 0),
            'goblin' => new CharacterTemplate(60, 8, 2, 0, 0),
            default => throw new \InvalidArgumentException('Unknown enemy'),
        };

        $stats = new Stats(
            maxHp: $template->baseHp,
            attack: $template->baseAttack,
            defense: $template->baseDefense,
            mana: 0,
            maxMana: 0
        );

        $enemy = new Character($enemyState['code'], $stats);

        $enemy->getStats()->takeDamage(
            $template->baseHp - $enemyState['hp']
        );

        return $enemy;
    }
}
