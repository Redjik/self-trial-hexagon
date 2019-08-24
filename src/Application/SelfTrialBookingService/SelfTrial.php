<?php

namespace AwesomeApplication\Application\SelfTrialBookingService;

class SelfTrial
{
    /**
     * @var int
     */
    private $educationServiceId;

    /**
     * @var SelfTrialStatus
     */
    private $status;

    /**
     * @var string
     */
    private $slotId;

    private function __construct(int $educationServiceId)
    {
        $this->educationServiceId = $educationServiceId;
    }

    public static function start(int $educationServiceId) : SelfTrial
    {
       $instance = new self($educationServiceId);
       $instance->status = SelfTrialStatus::STARTED();
       return $instance;
    }

    public function bookSlot(string $slotId): void
    {
        $this->slotId = $slotId;
        $this->status = SelfTrialStatus::BOOKED();
    }

    /**
     * @return int
     */
    public function getEducationServiceId(): int
    {
        return $this->educationServiceId;
    }

    /**
     * @return string
     */
    public function getSlotId(): string
    {
        return $this->slotId;
    }

    public function cancel()
    {
        $this->status = SelfTrialStatus::CANCELLED();
    }

    /**
     * @return SelfTrialStatus
     */
    public function getStatus(): SelfTrialStatus
    {
        return $this->status;
    }
}

