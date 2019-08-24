<?php


namespace AwesomeApplication\Infrastructure\BookingService;


use AwesomeApplication\Application\BookingService\BadSlotTypeException;
use AwesomeApplication\Application\BookingService\BookingServiceInterface;
use AwesomeApplication\Application\InternalException;

class BookingServiceStupidMock implements BookingServiceInterface
{

    /**
     * @param int $educationServiceId
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     * @throws BadSlotTypeException
     */
    public function bookSlot(int $educationServiceId, string $slotId, string $reason): void
    {
        echo 'BookingServiceStupidMock: Slot ' . $slotId . ' booked for ' . $educationServiceId . ' due to ' . $reason . PHP_EOL;
    }

    /**
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function cancelSlot(string $slotId, string $reason): void
    {
        echo 'BookingServiceStupidMock: Slot ' . $slotId . ' cancelled due to ' . $reason . PHP_EOL;
    }

    public function getAvailableSlots()
    {
        // TODO: Implement getAvailableSlots() method.
    }
}
