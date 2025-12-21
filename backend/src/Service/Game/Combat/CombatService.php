<?php

namespace App\Service\Game\Combat;

use App\Entity\Character;
use App\Entity\Combat as CombatEntity;
use App\Repository\CombatRepository;
use App\Service\Game\Combat\Skill\SkillFactory;
use App\Service\Game\Combat\CombatStateMapper;
use Ramsey\Uuid\Uuid;

final class CombatService
{
    public function __construct(
        private CombatRepository $combatRepository
    ) {}

    public function startCombat(Character $character): CombatEntity
    {
        $state = [
            'turn' => 'PLAYER',
            'turnCount' => 1,
            'player' => [
                'hp' => 100,
                'mana' => 100,
                'maxMana' => 100,
            ],
            'enemy' => [
                'code' => 'orc',
                'hp' => 80,
            ],
        ];

        $combat = new CombatEntity(
            $character,
            'orc'
        );

        $combat->setState($state);

        $this->combatRepository->save($combat, true);

        return $combat;
    }

    public function play(
        CombatEntity $entity,
        string $skillId
    ): array {
        $combat = CombatStateMapper::fromState(
            $entity->getState()
        );

        $skill = SkillFactory::create(
            $combat->getPlayer()->getClass(),
            $skillId
        );

        $combat->playerUseSkill($skill);

        $entity->setState(
            CombatStateMapper::toState($combat)
        );

        if ($combat->isFinished()) {
            $entity->endCombat(
                $combat->getPlayer()->isAlive()
                    ? 'WON'
                    : 'LOST'
            );
        }

        $this->combatRepository->save($entity, true);

        return $combat->toArray();
    }
}
