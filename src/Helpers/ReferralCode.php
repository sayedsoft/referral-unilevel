<?php

namespace Sayedsoft\ReferralUnilevel\Helpers;

use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;

class ReferralCode
{
    // Build your next great package.

    static function  generateCode() {
        $number = mt_rand(1000000000, 9999999999);
        if (self::codeExists($number)) { return self::generateCode(); }
        return $number;
    }


    static function  codeExists($number) {
        return Referral::whereReferralCode($number)->exists();
    }


}
