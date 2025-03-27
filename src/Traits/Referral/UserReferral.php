<?php
namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use Exception;
use Illuminate\Database\Query\Expression;
use Sayedsoft\ReferralUnilevel\Helpers\ReferralCode;
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
        return $this->belongsTo(\Sayedsoft\ReferralUnilevel\Models\Referral\Referral::class, 'id', 'user_id');
    }

    /*
      @referral code 
    */
    public function initReferral($referral_code)
    {

        if (!empty($this->referral)) {
            throw (new Exception('User has Referral already'));
        }

        Referral::create([
            'user_id' => $this->id,
            'referral_id' => Referral::where('referral_code', $referral_code)->first()->user_id,
            'referral_code' => ReferralCode::generateCode(),
        ]);

    }



    public static function boot()
    {
        parent::boot();
    }



}
