<?php

namespace App\Controller;

use App\Service\Game\Character\Character;
use App\Service\Game\Character\Exception\InsufficientManaException;
use App\Service\Game\Character\Stats;
use App\Service\Game\Combat\Combat;
use App\Service\Game\Combat\Skill\SkillFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    #[Route('/test2/{skill}', methods: ['POST'])]
    public function fight(string $skill): JsonResponse
    {
        $player = new Character(
            'player-1',
            new Stats(maxHp: 100, attack: 15, defense: 5, mana: 30)
        );

        $enemy = new Character(
            'enemy-1',
            new Stats(maxHp: 80, attack: 10, defense: 3, mana: 0)
        );

        $combat = new Combat($player, $enemy);

        try {
            $skillInstance = SkillFactory::create(
                $player->getClass(),
                $skill
            );

            $combat->playerUseSkill($skillInstance);

            return $this->json($combat->toArray());
        } catch (InsufficientManaException $e) {
            return $this->json(
                ['error' => $e->getMessage()],
                400
            );
        }
    }
}
