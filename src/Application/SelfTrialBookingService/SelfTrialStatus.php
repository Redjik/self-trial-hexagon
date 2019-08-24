<?php

namespace AwesomeApplication\Application\SelfTrialBookingService;

use MyCLabs\Enum\Enum;

/**
 * Class SelfTrialStatus
 * @package AwesomeApplication\Application\TrialBookingService
 *
 * @method static static STARTED()
 * @method static static CANCELLED()
 * @method static static BOOKED()
 */
class SelfTrialStatus extends Enum
{
    const STARTED = 'started';
    const CANCELLED = 'cancelled';
    const BOOKED = 'booked';
}
