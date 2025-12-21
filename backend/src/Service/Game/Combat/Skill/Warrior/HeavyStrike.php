<?php

namespace App\Service\Game\Combat\Skill\Warrior;

use App\Service\Game\Combat\Skill\SkillInterface;
use App\Service\Game\Character\Character;

final class HeavyStrike implements SkillInterface
{
    public function getId(): string
    {
        return 'heavy_strike';
    }

    public function getManaCost(): int
    {
        return 15;
    }

    public function execute(Character $attacker, Character $defender): int
    {
        $attacker->getStats()->consumeMana($this->getManaCost());

        $baseDamage = $attacker->getStats()->getAttack() * 2;
        $damage = max(1, $baseDamage - $defender->getStats()->getDefense());

        $defender->getStats()->takeDamage($damage);

        return $damage;
    }
}
