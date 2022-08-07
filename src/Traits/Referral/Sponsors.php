<?php
namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;

trait Sponsors
{
     
     public function getSponsorsAttribute() {
        return $this->getUserSponsors($this->referral_id,[],0);
     }

     public function getUserSponsors ($user_id,$team,$level) {
        $sponsor           = Referral::whereUserId($user_id)->with('user')->first() ?? null;
        $level             = $level + 1;
        if (isset($sponsor->user_id) && $sponsor != null && $sponsor->user_id != 1) {
          $team[$level]   = $sponsor;
        } else { return $team; }
        
        return $this->getUserSponsors($sponsor->referral_id,$team,$level,'');
    }

    
    
}
