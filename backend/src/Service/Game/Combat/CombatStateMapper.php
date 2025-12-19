<?php

namespace App\Service\Game\Combat;

use App\Service\Game\Character\Character;
use App\Service\Game\Character\CharacterFactory;
use App\Service\Game\Character\Stats;

final class CombatStateMapper
{
    public static function fromState(array $state): Combat
    {
        $player = CharacterFactory::createPlayer($state);
        $enemy = CharacterFactory::createEnemy($state['enemy']);

        $combat = new Combat($player, $enemy);
        $combat->setTurn($state['turn']);
        $combat->setTurnCount($state['turnCount']);

        return $combat;
    }

    public static function toState(Combat $combat): array
    {
        return [
            'turn' => $combat->getTurn(),
            'turnCount' => $combat->getTurnCount(),
            'player' => [
                'hp' => $combat->getPlayer()->getStats()->getHp(),
                'mana' => $combat->getPlayer()->getStats()->getMana(),
                'maxMana' => $combat->getPlayer()->getStats()->getMaxMana(),
            ],
            'enemy' => [
                'code' => $combat->getEnemy()->getId(),
                'hp' => $combat->getEnemy()->getStats()->getHp(),
            ],
        ];
    }
}
