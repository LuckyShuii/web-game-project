<?php

namespace App\Service\Game\Combat\Skill;

use App\Service\Game\Combat\Skill\Warrior\HeavyStrike;
use App\Service\Game\Combat\Skill\Warrior\Slash;

final class SkillFactory
{
    public static function create(
        string $characterClass,
        string $skillId
    ): SkillInterface {
        return match ([$characterClass, $skillId]) {
            /**
             * Warrior Skills
             */
            ['Warrior', 'slash'] => new Slash(),
            ['Warrior', 'heavy_strike'] => new HeavyStrike(),

            default => throw new \InvalidArgumentException('Unknown skill'),
        };
    }
}
