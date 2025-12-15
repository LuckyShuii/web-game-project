<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`game_character`')]
class Character
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player;

    #[ORM\Column(length: 20)]
    private string $class;

    #[ORM\Column(length: 20)]
    private string $race;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, Combat>
     */
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: Combat::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $combats;

    public function __construct(Player $player, string $class, string $race)
    {
        $this->id = Uuid::v7();
        $this->player = $player;
        $this->class = $class;
        $this->race = $race;
        $this->createdAt = new \DateTimeImmutable();
        $this->combats = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function getRace(): string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return Collection<int, Combat>
     */
    public function getCombats(): Collection
    {
        return $this->combats;
    }

    public function addCombat(Combat $combat): self
    {
        if (!$this->combats->contains($combat)) {
            $this->combats->add($combat);
            $combat->setCharacter($this);
        }

        return $this;
    }

    public function removeCombat(Combat $combat): self
    {
        if ($this->combats->removeElement($combat) && $combat->getCharacter() === $this) {
            $combat->setCharacter(null);
        }

        return $this;
    }
}
