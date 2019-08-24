<?php

namespace AwesomeApplication\Application\SelfTrialBookingService;

use AwesomeApplication\Application\BookingService\BadSlotTypeException;
use AwesomeApplication\Application\BookingService\BookingServiceInterface;
use AwesomeApplication\Application\InternalException;
use AwesomeApplication\Application\OperatorsService\OperatorsServiceInterface;
use DateInterval;
use DomainException;
use Psr\Log\LoggerAwareTrait;

class SelfTrialBookingService implements SelfTrialBookingServiceInterface
{
    use LoggerAwareTrait;

    const HOLD_CALL_INTERVAL = 'PT1H';

    /**
     * @var OperatorsServiceInterface
     */
    private $operatorsService;

    /**
     * @var SelfTrialRepositoryInterface
     */
    private $selfTrialRepository;

    /**
     * @var BookingServiceInterface
     */
    private $bookingService;

    public function __construct(
        OperatorsServiceInterface $operatorsService,
        BookingServiceInterface $bookingService,
        SelfTrialRepositoryInterface $selfTrialRepository
    )
    {
        $this->operatorsService = $operatorsService;
        $this->bookingService = $bookingService;
        $this->selfTrialRepository = $selfTrialRepository;
    }

    /**
     * @param int $educationServiceId
     *
     * @throws InternalException
     */
    public function startSelfTrialProcess(int $educationServiceId): void
    {
        try {
            $this->operatorsService->holdCall(
                $educationServiceId,
                new DateInterval(self::HOLD_CALL_INTERVAL),
                'self_trial'
            );

            $selfTrial = SelfTrial::start($educationServiceId);

            $this->selfTrialRepository->save($selfTrial);
        } catch (InternalException $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);
            throw $e;
        } catch (\Exception $e){
            $this->logger->error($e->getMessage(), ['exception' => $e]);
            throw new InternalException($e);
        } finally {
            $this->logger->info('SelfTrialBookingService::startSelfTrialProcess', [
                'result' => isset($e),
                'educationServiceId' => $educationServiceId,
                'status' => isset($selfTrial) ? $selfTrial->getStatus()->getValue() : null
            ]);
        }
    }

    /**
     * @param int $educationServiceId
     * @param string $slotId
     * @param string $reason
     *
     * @throws InternalException
     * @throws SelfTrialNotFoundException
     * @throws BadSlotTypeException
     */
    public function bookSlot(int $educationServiceId, string $slotId, string $reason): void
    {
        try {
            $selfTrial = $this
                ->selfTrialRepository
                ->getSelfTrialByEducationServiceId($educationServiceId);

            if (is_null($selfTrial)) {
                throw new SelfTrialNotFoundException('No self trial found for es ' . $educationServiceId);
            }

            $this->bookingService->bookSlot($educationServiceId, $slotId, $reason);
            $this->operatorsService->disableCall($educationServiceId, $reason);

            $selfTrial->bookSlot($slotId);
            $this->selfTrialRepository->save($selfTrial);
        } catch (InternalException $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);
            throw $e;
        } finally {
            $this->logger->info('SelfTrialBookingService::startSelfTrialProcess', [
                'result' => isset($e),
                'educationServiceId' => $educationServiceId,
                'slotId' => $slotId,
                'reason' => $reason,
                'status' => isset($selfTrial) ? $selfTrial->getStatus()->getValue() : null
            ]);
        }
    }

    /**
     * @param int $educationServiceId
     * @param string $reason
     *
     * @throws InternalException
     * @throws SelfTrialNotFoundException
     */
    public function cancelSelfTrial(int $educationServiceId, string $reason): void
    {
        try {
            $selfTrial = $this
                ->selfTrialRepository
                ->getSelfTrialByEducationServiceId($educationServiceId);

            if (is_null($selfTrial)) {
                throw new SelfTrialNotFoundException('No self trial found for es ' . $educationServiceId);
            }

            $this->bookingService->cancelSlot($selfTrial->getSlotId(), $reason);
            $this->operatorsService->enableCall($educationServiceId, $reason);

            $selfTrial->cancel();
            $this->selfTrialRepository->save($selfTrial);
        } catch (InternalException $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);
            throw $e;
        } finally {
            $this->logger->info('SelfTrialBookingService::startSelfTrialProcess', [
                'result' => isset($e),
                'educationServiceId' => $educationServiceId,
                'reason' => $reason,
                'status' => isset($selfTrial) ? $selfTrial->getStatus()->getValue() : null
            ]);
        }
    }
}
