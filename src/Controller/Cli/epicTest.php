<?php

use AwesomeApplication\Application\SelfTrialBookingService\SelfTrialBookingService;
use AwesomeApplication\Infrastructure\BookingService\BookingServiceStupidMock;
use AwesomeApplication\Infrastructure\OperatorsService\OperatorsServiceStupidMock;
use AwesomeApplication\Infrastructure\SelfTrialBookingService\SelfTrialRepositoryStupidMock;

include_once __DIR__ . '/../../../vendor/autoload.php';

$bookingService = new SelfTrialBookingService(
    new OperatorsServiceStupidMock(),
    new BookingServiceStupidMock(),
    new SelfTrialRepositoryStupidMock()
);
$bookingService->setLogger(new \Psr\Log\NullLogger());



echo 'Starting self trial' . PHP_EOL;
$bookingService->startSelfTrialProcess(1);

echo '[:::::::::::::::::::::::::]' . PHP_EOL;

echo 'Book slot' . PHP_EOL;
$bookingService->bookSlot(1, 'slot-1', 'api_call_from_user_book');

echo '[:::::::::::::::::::::::::]' . PHP_EOL;
echo 'Cancel slot' . PHP_EOL;
$bookingService->cancelSelfTrial(2, 'api_call_from_user_cancel');