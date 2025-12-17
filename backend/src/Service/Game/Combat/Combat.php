<?php

namespace App\Service\Game\Combat;

use App\Service\Game\Character\Character;
use App\Service\Game\Combat\Skill\SkillInterface;

final class Combat
{
    private Character $player;
    private Character $enemy;
    private string $turn; // PLAYER | ENEMY
    private int $turnCount = 1;

    public function __construct(Character $player, Character $enemy)
    {
        $this->player = $player;
        $this->enemy = $enemy;
        $this->turn = 'PLAYER';
    }

    public function playerAttack(): void
    {
        if ($this->turn !== 'PLAYER') {
            throw new \LogicException('Not player turn');
        }

        $damage = max(
            1,
            $this->player->getStats()->getAttack()
                - $this->enemy->getStats()->getDefense()
        );

        $this->enemy->getStats()->takeDamage($damage);

        $this->nextTurn();
    }

    private function nextTurn(): void
    {
        $this->turn = $this->turn === 'PLAYER' ? 'ENEMY' : 'PLAYER';
        $this->turnCount++;
    }

    public function isFinished(): bool
    {
        return !$this->player->isAlive() || !$this->enemy->isAlive();
    }

    public function getTurn(): string
    {
        return $this->turn;
    }

    public function getTurnCount(): int
    {
        return $this->turnCount;
    }

    public function getPlayer(): Character
    {
        return $this->player;
    }

    public function getEnemy(): Character
    {
        return $this->enemy;
    }

    public function playerUseSkill(SkillInterface $skill): array
    {
        if ($this->turn !== 'PLAYER') {
            throw new \LogicException('Not player turn');
        }

        $damage = $skill->execute($this->player, $this->enemy);

        $this->nextTurn();

        $enemyDamage = null;

        if (!$this->isFinished()) {
            $enemyDamage = $this->enemyAttack();
        }

        return [
            'player_damage' => $damage,
            'enemy_damage' => $enemyDamage,
        ];
    }

    private function enemyAttack(): int
    {
        $damage = max(
            1,
            $this->enemy->getStats()->getAttack()
                - $this->player->getStats()->getDefense()
        );

        $this->player->getStats()->takeDamage($damage);

        $this->nextTurn();

        return $damage;
    }

    public function toArray(): array
    {
        $status = 'IN_PROGRESS';
        if ($this->isFinished()) {
            $status = $this->player->isAlive() ? 'WON' : 'LOST';
        }

        return [
            'turn' => $this->turn,
            'turnCount' => $this->turnCount,
            'player' => [
                'hp' => $this->player->getStats()->getHp(),
                'mana' => $this->player->getStats()->getMana(),
            ],
            'enemy' => [
                'hp' => $this->enemy->getStats()->getHp(),
                'mana' => $this->enemy->getStats()->getMana(),
            ],
            'status' => $status,
        ];
    }
}
