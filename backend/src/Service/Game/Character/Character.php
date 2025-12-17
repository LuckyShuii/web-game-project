<?php

namespace App\Service\Game\Character;

final class Character
{
    private string $id;
    private Stats  $stats;
    // private Class  $class;
    // private Race   $race;

    public function __construct(string $id, Stats $stats)
    {
        $this->id = $id;
        $this->stats = $stats;
    }

    public function getStats(): Stats
    {
        return $this->stats;
    }

    public function getClass(): string
    {
        // return $this->class;
        return 'Warrior';
    }

    public function getRace(): string
    {
        // return $this->race
        return 'Human';
    }

    public function isAlive(): bool
    {
        return !$this->stats->isDead();
    }
}
