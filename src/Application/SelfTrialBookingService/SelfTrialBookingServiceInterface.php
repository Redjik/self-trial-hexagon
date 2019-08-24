<?php

namespace AwesomeApplication\Application\SelfTrialBookingService;

use AwesomeApplication\Application\InternalException;
use DomainException;

interface SelfTrialBookingServiceInterface
{
    /**
     * @param int $educationServiceId
     *
     * @throws InternalException
     * @throws DomainException
     */
    public function startSelfTrialProcess(int $educationServiceId): void;

    /**
     * @param int $educationServiceId
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function bookSlot(int $educationServiceId, string $slotId, string $reason): void;

    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     * @throws DomainException
     */
    public function cancelSelfTrial(int $educationServiceId, string $reason): void;
}