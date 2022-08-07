<?php
namespace Sayedsoft\ReferralUnilevel\Models\Referral;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralSponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sponsor_id',
        'level'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id','id')->with('referral');
    }

    public function sponsor()
    {
        return $this->belongsTo(\App\Models\User::class,'sponsor_id','id');
    }

}
