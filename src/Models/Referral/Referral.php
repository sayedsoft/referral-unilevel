<?php
namespace Sayedsoft\ReferralUnilevel\Models\Referral;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\ReferralUnilevel\Traits\Referral\ChildTeam;
use Sayedsoft\ReferralUnilevel\Traits\Referral\Sponsors;

class Referral extends Model
{
    use HasFactory;
    use Sponsors;
    use ChildTeam;

    protected $appends = [
        'referral_link'
    ];

    protected $fillable = [
        'user_id',
        'referral_id',
        'referral_code',
        'team_count',
        'has_refferal'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }

    public function getReferralLinkAttribute () {
        return config('registerLink').'?code='.$this->referral_code;
    }

    
}
