<?php

namespace Sayedsoft\ReferralUnilevel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\ReferralUnilevel\Skeleton\SkeletonClass
 */
class ReferralUnilevelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'referral-unilevel';
    }
}
