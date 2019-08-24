<?php


namespace AwesomeApplication\Infrastructure\SelfTrialBookingService;


use AwesomeApplication\Application\InternalException;
use AwesomeApplication\Application\SelfTrialBookingService\SelfTrial;
use AwesomeApplication\Application\SelfTrialBookingService\SelfTrialRepositoryInterface;

class SelfTrialRepositoryStupidMock implements SelfTrialRepositoryInterface
{

    /**
     * @param SelfTrial $selfTrial
     * @return mixed
     *
     * @throws InternalException
     */
    public function save(SelfTrial $selfTrial): void
    {
        echo 'SelfTrialRepositoryStupidMock: Saved SelfTrial for ' . $selfTrial->getEducationServiceId() . PHP_EOL;
    }

    /**
     * @param int $educationServiceId
     * @return SelfTrial|null
     *
     * @throws InternalException
     */
    public function getSelfTrialByEducationServiceId(int $educationServiceId): ?SelfTrial
    {
        echo 'SelfTrialRepositoryStupidMock: Found SelfTrial for ' . $educationServiceId . PHP_EOL;

        if ($educationServiceId === 1) {
            return SelfTrial::start(1);
        }

        if ($educationServiceId === 2) {
            $selfTrial = SelfTrial::start(1);
            $selfTrial->bookSlot('slot-2');
            return $selfTrial;
        }

        if ($educationServiceId === 3) {
            $selfTrial = SelfTrial::start(1);
            $selfTrial->bookSlot('slot-3');
            $selfTrial->cancel();
            return $selfTrial;
        }
    }
}
