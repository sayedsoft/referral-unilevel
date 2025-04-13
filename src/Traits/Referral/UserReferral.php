<?php
namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use Exception;
use Illuminate\Database\Query\Expression;
use Sayedsoft\ReferralUnilevel\Helpers\ReferralCode;
use Sayedsoft\ReferralUnilevel\Jobs\NewChildJob;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

trait UserReferral
{

    public function initializeUserReferralTrait()
    {
        $this->appends[] = 'referral_code';
    }

    public function referral()
    {
        return $this->belongsTo(Referral::class, 'id', 'user_id');
    }


    private function _getUserSponsors($user_id, $team, $level)
    {
        $sponsor = Referral::whereUserId($user_id)->with('user')->first() ?? null;
        $level = $level + 1;
        if (isset($sponsor->user_id) && $sponsor != null && $sponsor->user_id != 1) {
            $team[$level] = $sponsor;
        } else {
            return $team;
        }

        return $this->_getUserSponsors($sponsor->referral_id, $team, $level, '');
    }

    private function setSponsor($referralId)
    {
        $sponsors = $this->_getUserSponsors($referralId, [], 0);

        foreach ($sponsors as $level => $sponsor) {
            $sponsor->team_count += 1;
            $sponsor->save();
            ReferralSponsor::create([
                'user_id' => $this->id,
                'sponsor_id' => $sponsor->user->id,
                'level' => $level
            ]);
        }
    }

    /*
      @referral code 
    */
    public function initReferral($referral_code)
    {

        if (!empty($this->referral)) {
            throw (new Exception('User has Referral already'));
        }

        $referral = Referral::where('referral_code', $referral_code)->first();

        Referral::create([
            'user_id' => $this->id,
            'referral_id' => $referral->user_id,
            'referral_code' => ReferralCode::generateCode(),
        ]);

        $this->setSponsor($referral);

    }



    public static function boot()
    {
        parent::boot();
    }



}
