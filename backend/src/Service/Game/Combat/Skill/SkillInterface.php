<?php

namespace App\Service\Game\Combat\Skill;

use App\Service\Game\Character\Character;

interface SkillInterface
{
    public function getId(): string;
    public function getManaCost(): int;

    public function execute(
        Character $attacker,
        Character $defender
    ): int;
}
