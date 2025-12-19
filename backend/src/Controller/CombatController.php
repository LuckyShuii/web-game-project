<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use App\Repository\CombatRepository;
use App\Service\Game\Combat\CombatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/combat')]
final class CombatController extends AbstractController
{
    #[Route('/start/{characterId}', methods: ['POST'])]
    public function start(
        string $characterId,
        CharacterRepository $characterRepository,
        CombatService $combatService
    ): JsonResponse {
        $character = $characterRepository->find(
            Uuid::fromString($characterId)
        );

        if (!$character) {
            return $this->json(
                ['error' => 'Character not found'],
                404
            );
        }

        $combat = $combatService->startCombat($character);

        return $this->json([
            'combat_id' => (string) $combat->getId(),
            'enemy' => $combat->getEnemyCode(),
            'status' => $combat->getStatus(),
        ]);
    }

    #[Route('/{combatId}/action/{skill}', methods: ['POST'])]
    public function action(
        string $combatId,
        string $skill,
        CombatRepository $combatRepository,
        CombatService $combatService
    ): JsonResponse {
        $combat = $combatRepository->find($combatId);

        if (!$combat) {
            return $this->json(
                ['error' => 'Combat not found'],
                404
            );
        }

        if ($combat->getStatus() !== 'IN_PROGRESS') {
            return $this->json(
                ['error' => 'Combat already finished'],
                400
            );
        }

        $result = $combatService->play(
            $combat,
            $skill
        );

        return $this->json($result);
    }
}
