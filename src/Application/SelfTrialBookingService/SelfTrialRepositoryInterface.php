<?php

namespace AwesomeApplication\Application\SelfTrialBookingService;

use AwesomeApplication\Application\InternalException;

interface SelfTrialRepositoryInterface
{
    /**
     * @param SelfTrial $selfTrial
     * @return mixed
     *
     * @throws InternalException
     */
    public function save(SelfTrial $selfTrial): void;

    /**
     * @param int $educationServiceId
     * @return SelfTrial|null
     *
     * @throws InternalException
     */
    public function getSelfTrialByEducationServiceId(int $educationServiceId): ?SelfTrial;
}
