<?php


namespace AwesomeApplication\Infrastructure\OperatorsService;


use AwesomeApplication\Application\InternalException;
use AwesomeApplication\Application\OperatorsService\OperatorsServiceInterface;
use DateInterval;

class OperatorsServiceStupidMock implements OperatorsServiceInterface
{

    /**
     * @param int $educationServiceId
     * @param DateInterval $interval
     * @param string $reason
     *
     * @throws InternalException
     */
    public function holdCall(int $educationServiceId, DateInterval $interval, string $reason): void
    {
        echo 'OperatorsServiceStupidMock: Call hold for ' . $educationServiceId . ' due to ' . $reason . PHP_EOL;
    }


    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function disableCall(int $educationServiceId, string $reason): void
    {
        echo 'OperatorsServiceStupidMock: Call disabled for ' . $educationServiceId . ' due to ' . $reason . PHP_EOL;
    }

    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     */
    public function enableCall(int $educationServiceId, string $reason): void
    {
        echo 'OperatorsServiceStupidMock: Call enabled for ' . $educationServiceId . ' due to ' . $reason . PHP_EOL;
    }
}
