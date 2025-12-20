<?php

namespace App\Entity;

use App\Entity\Player;
use App\Repository\CombatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CombatRepository::class)]
class Combat
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid', unique: true)]
    private string $id;

    #[ORM\ManyToOne(inversedBy: 'combats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Character $character;

    #[ORM\Column(length: 50)]
    private string $enemyCode;

    #[ORM\Column(length: 20)]
    private string $status;

    #[ORM\Column(nullable: true)]
    private ?array $state = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $endedAt = null;

    public function __construct(Character $character, string $enemyCode)
    {
        $this->id = Uuid::v7()->toRfc4122();
        $this->character = $character;
        $this->enemyCode = $enemyCode;
        $this->status = 'IN_PROGRESS';
        $this->startedAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCharacter(): Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;
        return $this;
    }

    public function getEnemyCode(): string
    {
        return $this->enemyCode;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getState(): ?array
    {
        return $this->state ?? [];
    }

    public function setState(?array $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function endCombat(string $status): self
    {
        $this->status = $status;
        $this->endedAt = new \DateTimeImmutable();
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'enemy' => $this->enemyCode,
            'state' => $this->state,
            'startedAt' => $this->startedAt?->format(DATE_ATOM),
            'endedAt' => $this->endedAt?->format(DATE_ATOM),
        ];
    }
}
