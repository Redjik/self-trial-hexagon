<?php

namespace AwesomeApplication\Application\BookingService;

use AwesomeApplication\Application\InternalException;

interface BookingServiceInterface
{
    /**
     * @param int $educationServiceId
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     * @throws BadSlotTypeException
     */
    public function bookSlot(int $educationServiceId, string $slotId, string $reason): void;

    /**
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function cancelSlot(string $slotId, string $reason): void;


    public function getAvailableSlots();
}
