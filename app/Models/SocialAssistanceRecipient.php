<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistanceRecipient extends Model
{
    use HasFactory, SoftDeletes, UUID;

    protected $fillable = [
        'social_assistance_id',
        'head_of_family_id',
        'amount',
        'reason',
        'bank',
        'account_number',
        'proof', // bukti pembayaran
        'status',
    ];

    // 1 penerima bantuan sosial hanya memiliki 1 bantuan sosial
    public function socialAssistance()
    {
        return $this->belongsTo(SocialAssistance::class);
    }

    // 1 penerima bantuan sosial hanya memiliki 1 kepala keluarga
    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }
}
