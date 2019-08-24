<?php

namespace AwesomeApplication\Application\OperatorsService;
use AwesomeApplication\Application\InternalException;
use DateInterval;

interface OperatorsServiceInterface
{
    /**
     * @param int $educationServiceId
     * @param DateInterval $interval
     * @param string $reason
     *
     * @throws InternalException
     */
    public function holdCall(int $educationServiceId, DateInterval $interval, string $reason): void;

    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function disableCall(int $educationServiceId, string $reason): void;

    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function enableCall(int $educationServiceId, string $reason): void;
}
