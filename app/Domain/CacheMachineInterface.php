<?php

namespace App\Domain;

/**
 * Interface CacheMachineInterface
 * @package App\Domain
 */
interface CacheMachineInterface
{
    /**
     * @param $availableNotes
     * @param $withdrawalAmount
     * @return mixed
     */
    public function handle($availableNotes, $withdrawalAmount);
}
