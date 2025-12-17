<?php

namespace App\Service\Game\Character\Exception;

final class InsufficientManaException extends \DomainException
{
    public function __construct(int $cost, int $currentMana)
    {
        parent::__construct(
            sprintf(
                'Not enough mana: required %d, available %d',
                $cost,
                $currentMana
            )
        );
    }
}
