<?php

namespace App\Service\Game\Character;

final class CharacterTemplate
{
    public function __construct(
        public readonly int $baseHp,
        public readonly int $baseAttack,
        public readonly int $baseDefense,
        public readonly int $baseMana,
        public readonly int $baseMaxMana
    ) {}
}
