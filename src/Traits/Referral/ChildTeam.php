<?php
namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;

trait ChildTeam
{

    function getDirectChildsAttribute() {
        return Referral::whereReferralId($this->id)->with('user')->get();
    }

}
 