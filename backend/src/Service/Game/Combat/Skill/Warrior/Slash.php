<?php

namespace App\Service\Game\Combat\Skill\Warrior;

use App\Service\Game\Character\Character;
use App\Service\Game\Combat\Skill\SkillInterface;

final class Slash implements SkillInterface
{
    public function getId(): string
    {
        return 'slash';
    }

    public function getManaCost(): int
    {
        return 10;
    }

    public function execute(Character $attacker, Character $defender): int
    {
        $attacker->getStats()->consumeMana($this->getManaCost());

        $damage = max(
            1,
            $attacker->getStats()->getAttack()
                - $defender->getStats()->getDefense()
        );

        $defender->getStats()->takeDamage($damage);

        return $damage;
    }
}
