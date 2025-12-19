<?php

namespace App\Service\Game\Character;

use App\Service\Game\Character\Exception\InsufficientManaException;

final class Stats
{
    private int $hp;
    private int $maxHp;
    private int $attack;
    private int $defense;
    private int $mana;
    private int $maxMana;

    public function __construct(
        int $maxHp,
        int $attack,
        int $defense,
        int $mana,
        int $maxMana
    ) {
        $this->maxHp = $maxHp;
        $this->hp = $maxHp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->mana = $mana;
        $this->maxMana = $maxMana;
    }

    public function takeDamage(int $amount): void
    {
        $this->hp = max(0, $this->hp - $amount);
    }

    public function hasMana(int $cost): bool
    {
        return $this->mana >= $cost;
    }

    public function restoreMana(int $amount): void
    {
        $this->mana = min(
            $this->mana + $amount,
            $this->maxMana
        );
    }

    public function consumeMana(int $cost): void
    {
        if (!$this->hasMana($cost)) {
            throw new InsufficientManaException($cost, $this->mana);
        }

        $this->mana -= $cost;
    }

    public function isDead(): bool
    {
        return $this->hp <= 0;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getMaxHp(): int
    {
        return $this->maxHp;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function getMana(): int
    {
        return $this->mana;
    }

    public function getMaxMana(): int
    {
        return $this->maxMana;
    }
}
